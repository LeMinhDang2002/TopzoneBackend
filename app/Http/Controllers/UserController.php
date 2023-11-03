<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Repositories\AuthorizationRepository;
use App\Repositories\AuthorizationDetailRepository;
use App\Repositories\PositionRepository;
use App\Repositories\PositionDetailRepository;
use App\Repositories\NotificationRepository;
use App\Repositories\StreamNotificationRepository;
use App\Repositories\MessageRepository;
use App\Repositories\StreamMessageRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Validation\Rules\Password;
use Session;
use App\Models\User;
use DB;
use Validator;

class UserController extends Controller
{
    protected $userRepository;
    protected $authorizationRepository;
    protected $authorizationDetailRepository;
    protected $positionRepository;
    protected $positionDetailRepository;
    protected $notificationRepository;
    protected $streamNotificationRepository;
    protected $messageRepository;
    protected $streamMessageRepository;

    public function __construct(UserRepository $userRepository, 
                                AuthorizationRepository $authorizationRepository, 
                                AuthorizationDetailRepository $authorizationDetailRepository,
                                PositionRepository $positionRepository, 
                                PositionDetailRepository $positionDetailRepository,
                                NotificationRepository $notificationRepository,
                                StreamNotificationRepository $streamNotificationRepository,
                                MessageRepository $messageRepository,
                                StreamMessageRepository $streamMessageRepository)
    {
        $this->userRepository = $userRepository;
        $this->positionRepository = $positionRepository;
        $this->positionDetailRepository = $positionDetailRepository;
        $this->authorizationRepository = $authorizationRepository;
        $this->authorizationDetailRepository = $authorizationDetailRepository;
        $this->notificationRepository = $notificationRepository;
        $this->streamNotificationRepository = $streamNotificationRepository;
        $this->messageRepository = $messageRepository;
        $this->streamMessageRepository = $streamMessageRepository;
    }
    public function getLogin(){
        return view('Login');
    }
    public function getHome(Request $request){
        $notifications = $this->getNotifications($request);
        $messages = $this->getMessages($request);
        // dd($notifications[0]->URL);
        return view('Dashboard.dashboard')->with('notifications', $notifications)
                                        ->with('messages', $messages);
    }
    public function postLogin(Request $request): RedirectResponse{
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        // dd(Auth::attempt($credentials));
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->route('getHome');
        }
 
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
    public function getAllUser(Request $request){
        if($request->user()->can('view', $request->user())){
            $users = $this->userRepository->findAll();
            $authorizationdetails = $this->authorizationDetailRepository->findAll();
            $positiondetails = $this->positionDetailRepository->findAll();
            foreach($users as $user){
                $positions = $this->positionRepository->findByUserId($user->id);
                $authorizations = $this->authorizationRepository->findByUserId($user->id);
                $user['positions'] = $positions;
                $user['authorizations'] = $authorizations;
            }
            $notifications = $this->getNotifications($request);
            $messages = $this->getMessages($request);
            return view('Dashboard.User.User')->with('users', $users)->with('authorizationdetails', $authorizationdetails)
                                                                    ->with('positionDetails', $positiondetails)
                                                                    ->with('notifications', $notifications)
                                                                    ->with('messages', $messages);
        }
        toast('Bạn không có quyền vào trang Users','warning','top-right')->showCloseButton();
        return back();
    }
    public function updateUser(Request $request, $id){
        $user = $this->userRepository->findById($id);
        $listPositions = $request->positions;
        $listAuthorizations = $request->authorizations;
        
        $positions = $this->positionRepository->findByUserId($id);
        if(!empty($listPositions)){
            foreach($positions as $position){
                if(!$this->positionRepository->checkRequestPosition($position->position_detail_id, $listPositions)){
                    $pos = $this->positionRepository->findById($position->id);
                    $this->positionRepository->delete($pos);
                }
            }
            foreach($listPositions as $listpos){
                if(!$this->positionRepository->checkDBPosition(json_decode($listpos), $positions)){
                    $position = [
                        'userid' => $user->id,
                        'position_detail_id' => json_decode($listpos),
                    ];
                    $this->positionRepository->create($position);
                }
            }
        }
        else{
            foreach($positions as $position){
                $this->positionRepository->delete($position);
            }
        }

        $authorizations = $this->authorizationRepository->findByUserId($id);
        if(!empty($listAuthorizations)){
            foreach($authorizations as $authorization){
                if(!$this->authorizationRepository->checkRequestAuth($authorization->authorid, $listAuthorizations)){
                    $auth = $this->authorizationRepository->findById($authorization->id);
                    $this->authorizationRepository->delete($auth);
                }
            }
            foreach($listAuthorizations as $listAuth){
                if(!$this->authorizationRepository->checkDBAuth(json_decode($listAuth), $authorizations))
                {
                    $authorization = [
                        'userid' => $user->id,
                        'authorid' => json_decode($listAuth),
                    ];
                    $this->authorizationRepository->create($authorization);
                }
            }
        }
        else{
            foreach($authorizations as $authorization){
                $this->authorizationRepository->delete($authorization);
            }
        }
        toast('Cập nhật User thành công','success','top-right')->showCloseButton();
        return response()->json('success', 200);
    }

    public function getAddUser(Request $request){
        if($request->user()->can('view', $request->user())){
            $positiondetails = $this->positionDetailRepository->findAll();
            $notifications = $this->getNotifications($request);
            $messages = $this->getMessages($request);
            return view('Dashboard.User.AddUser')->with('positiondetails', $positiondetails)
                                                ->with('notifications', $notifications)
                                                ->with('messages', $messages);
        }
        toast('Bạn không có quyền tạo tài khoản','warning','top-right')->showCloseButton();
        return redirect()->route('getHome');
    }
    public function postAddUser(Request $request){
        $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'phone' => ['required', 'string', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        if($request->user()->can('view', $request->user())){
            $thumbnail = $request->file('files');
            $imageName = $thumbnail->getClientOriginalName();
            // $path = $image->storeAs('app/public', $imageName);
            $path = $thumbnail->move(public_path('storage'), $imageName);

            $user = [
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'phone' => $request->phone,
                'type_user' => 'user',
                'position' => $request->position,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'thumbnail' => $imageName,
            ];
            $user_created = $this->userRepository->create($user);
            $position = [
                'userid' => $user_created->id,
                'position_detail_id' => $request->position,
            ];
            $this->positionRepository->create($position);
            toast('Tạo tài khoản thành công','success','top-right')->showCloseButton();
            return redirect()->route('getAllUser');
        }
        toast('Bạn không có quyền tạo tài khoản','warning','top-right')->showCloseButton();
        return redirect()->route('getHome');
    }
    public function deleteUser(Request $request, $id){
        if($request->user()->can('delete', $request->user())){
            DB::beginTransaction();
            try {
                $user_delete = $this->userRepository->findById($id);
                $positions = $this->positionRepository->findByUserId($user_delete->id);
                $authorizations = $this->authorizationRepository->findByUserId($user_delete->id);

                $this->userRepository->delete($user_delete);
                foreach($positions as $position){
                    $this->positionRepository->delete($position);
                }
                foreach($authorizations as $authorization){
                    $this->authorizationRepository->delete($authorization);
                }
                DB::commit();
                $filePathOld = public_path('storage/' . $user_delete->thumbnail);
                if (file_exists($filePathOld)) {
                    unlink($filePathOld);
                }
                toast('Xóa tài khoản thành công','success','top-right')->showCloseButton();
                return back();
            } catch (Exception $e) {
                DB::rollBack();
                throw new Exception($e->getMessage());
            }
        }
        toast('Bạn không có quyền xóa tài khoản','warning','top-right')->showCloseButton();
        return back();
    }

    public function getUpdateUser(Request $request, $id){
        $user = $this->userRepository->findById($id);
        if($request->user()->can('canUpdate', $user)){
            $notifications = $this->getNotifications($request);
            $messages = $this->getMessages($request);

            $authorizationdetails = $this->authorizationDetailRepository->findAll();
            return view('Dashboard.User.UpdateUser')->with('user', $user)
                                                    ->with('notifications', $notifications)
                                                    ->with('authorizationdetails', $authorizationdetails)
                                                    ->with('messages', $messages);
        }
        toast('Bạn không có quyền cho tài khoản này','warning','top-right')->showCloseButton();
        return back();
    }

    public function postRequestAuthorization(Request $request, $id){
        $authorization = $this->authorizationDetailRepository->findById($request->position);
        $admins = $this->userRepository->findAdmins();
        $message = [
            'userid' => $request->user()->id,
            'content' => $request->user()->firstname.' '.$request->user()->lastname.' '.'đã yêu cầu cấp quyền'.' '.$authorization->name_author,
            'main_content' => $authorization->name_author,
        ];
        $message_created = $this->messageRepository->create($message);
        foreach($admins as $admin){
            $streamMessage = [
                'message_id' => $message_created->id,
                'userid_src' => $request->user()->id,
                'userid_dest' => $admin->id,
                'status' => 0,
            ];
            $this->streamMessageRepository->create($streamMessage);
        }
        toast('Yêu cầu đã được gửi thành công','success','top-right')->showCloseButton();
        return back();
    }

    public function postUpdateUser(Request $request, $id){
        $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
        ]);
        $user = $this->userRepository->findById($id);
        if($request->user()->can('canUpdate', $user)){
            $user_update = [
                'id' => $user->id,
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'email' => $request->email,
                'phone' => $request->phone,
            ];
            if(!$this->userRepository->checkEmail($user_update) && !$this->userRepository->checkPhone($user_update))
            {
                if($request->hasFile('files')){
                    $thumbnail = $request->file('files');
                    $imageName = $thumbnail->getClientOriginalName();
                    // $path = $image->storeAs('app/public', $imageName);
                    $path = $thumbnail->move(public_path('storage'), $imageName);
                    $user_update['thumbnail'] = $imageName;

                    $filePathOld = public_path('storage/' . $user->thumbnail);
                    if (file_exists($filePathOld)) {
                        unlink($filePathOld);
                    }
                }
                $this->userRepository->update($user, $user_update);
                toast('Cập nhật tài khoản thành công','success','top-right')->showCloseButton();
                return back();
            }
            else{
                toast('Vui lòng kiểm tra lại Email hoặc Số điện thoại đã tồn tại','warning','top-right')->showCloseButton();
                return back();
            }
        }
        toast('Bạn không có quyền cho tài khoản này','warning','top-right')->showCloseButton();
        return back();
    }
    public function postUpdatePasswordUser(Request $request, $id){
        $user = $this->userRepository->findById($id);
        if($request->user()->can('canUpdate', $user)){
            $validated = $request->validateWithBag('updatePassword', [
                'current_password' => ['required', 'current_password'],
                'password' => ['required', Password::defaults(), 'confirmed'],
            ]);

            $request->user()->update([
                'password' => Hash::make($validated['password']),
            ]);

            toast('Cập nhật password thành công','success','top-right')->showCloseButton();
            return back()->with('status', 'password-updated');
        }
        toast('Bạn không có quyền cho tài khoản này','warning','top-right')->showCloseButton();
        return back();
    }
}
