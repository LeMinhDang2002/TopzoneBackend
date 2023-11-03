<?php

namespace App\Http\Controllers;
use App\Repositories\PostRepository;
use App\Repositories\CategoryPostRepository;
use App\Repositories\ImagesRepository;
use App\Repositories\UserRepository;
use App\Repositories\PositionRepository;
use App\Repositories\AuthorizationRepository;
use App\Repositories\NotificationRepository;
use App\Repositories\StreamNotificationRepository;
use App\Repositories\MessageRepository;
use App\Repositories\StreamMessageRepository;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Post;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $postRepository;
    protected $categoryPostRepository;
    protected $imagesRepository;
    protected $userRepository;
    protected $positionRepository;
    protected $authorizationRepository;
    protected $notificationRepository;
    protected $streamNotificationRepository;
    protected $messageRepository;
    protected $streamMessageRepository;
    public function __construct(PostRepository $postRepository, 
                                CategoryPostRepository $categoryPostRepository, 
                                ImagesRepository $imagesRepository, 
                                UserRepository $userRepository,
                                PositionRepository $positionRepository,
                                AuthorizationRepository $authorizationRepository,
                                NotificationRepository $notificationRepository,
                                StreamNotificationRepository $streamNotificationRepository,
                                MessageRepository $messageRepository,
                                StreamMessageRepository $streamMessageRepository)
    {
        $this->postRepository = $postRepository;
        $this->categoryPostRepository = $categoryPostRepository;
        $this->imagesRepository = $imagesRepository;
        $this->userRepository = $userRepository;
        $this->positionRepository = $positionRepository;
        $this->authorizationRepository = $authorizationRepository;
        $this->notificationRepository = $notificationRepository;
        $this->streamNotificationRepository = $streamNotificationRepository;
        $this->messageRepository = $messageRepository;
        $this->streamMessageRepository = $streamMessageRepository;
    }
    

    public function getPosts(Request $request){
        $this->checkNotification($request);
        $posts = $this->postRepository->findAll();
        $categoryPosts = $this->categoryPostRepository->findAll();
        $posts = $this->postRepository->findAll();
        foreach($posts as $post){
            $thumbnail = $this->imagesRepository->getImageUrl($post->thumbnail);
            $typePost = $this->categoryPostRepository->getTypeCategory($post->categoryid);
            $postCreator = $this->userRepository->findById($post->user_id);
            $post['LinkThumbnail'] = $thumbnail;
            $post['CategoryName'] = $typePost->category_name;
            if($postCreator != null){
                $post['PostCreator'] = $postCreator->firstname.' '.$postCreator->lastname;
            }
        }
        $notifications = $this->getNotifications($request);
        $messages = $this->getMessages($request);
        return view('Dashboard.Post.Post')->with('posts', $posts)
                                            ->with('notifications', $notifications)
                                            ->with('messages', $messages);
    }
    public function getAddPost(Request $request){
        $category = $this->categoryPostRepository->findAll();
        $notifications = $this->getNotifications($request);
        $messages = $this->getMessages($request);
        // dd($category);
        return view('Dashboard.Post.AddPost')->with('categories', $category)
                                            ->with('notifications', $notifications)
                                            ->with('messages', $messages);
    }
    public function postAddPost(Request $request){
        $user = Auth::user();
        $authorizations = $this->authorizationRepository->findByUserId($user->id);
        $count = 0;
        foreach($authorizations as $authorization){
            if($request->user()->can('createPost', $authorization)){
                $thumbnail = $request->file('files');
                $imageName = $thumbnail->getClientOriginalName();
                // $path = $image->storeAs('app/public', $imageName);
                $path = $thumbnail->move(public_path('storage'), $imageName);
                $post = [
                    'title' => $request->title,
                    'categoryid' => $request->category_select,
                    'url' => $request->URL,
                    'thumbnail' =>$imageName,
                    'user_id' => $user->id,
                ];
                $this->postRepository->create($post);
                $notification = [
                    'userid' => $request->user()->id,
                    'position_detail_id' => 3,
                    'content' => $request->user()->firstname.' '.$request->user()->lastname.' '.'đã tạo bài viết'.' '.'"'.$request->title.'"',
                    'URL' => 'getPosts',
                ];
                $notification_created = $this->notificationRepository->create($notification);
                $admins = $this->userRepository->findAdmins();
                foreach($admins as $admin){
                    $streamNotification = [
                        'notificationid' => $notification_created->id,
                        'userid_src' => $request->user()->id,
                        'userid_dest' => $admin->id,
                        'status' => 0,
                    ];
                    $this->streamNotificationRepository->create($streamNotification);
                }
                $count = $count + 1;
            }
        }
        if($count ==0){
            toast('Bạn không có quyền tạo bài viết','error', 'top-right')->showCloseButton();
        }
        else{
            toast('Tạo bài viết thành công','success', 'top-right')->showCloseButton();
        }
        return back();
    }
    public function getUpdatePost(Request $request, $id){
        $user = Auth::user();
        $post = $this->postRepository->findById($id);
        $authorizations = $this->authorizationRepository->findByUserId($user->id);
        $count = 0;
        foreach($authorizations as $authorization)
        {
            if($request->user()->can('viewUpdatePost', $authorization)){
                if($request->user()->can('view', $post)){
                    $category = $this->categoryPostRepository->findAll();
                    $thumbnail = $this->imagesRepository->getImageUrl($post->thumbnail);
                    $post['LinkThumbnail'] = $thumbnail;
                    $notifications = $this->getNotifications($request);
                    $messages = $this->getMessages($request);
                    return view('Dashboard.Post.UpdatePost')->with('post', $post)->with('categories', $category)
                                                            ->with('notifications', $notifications)
                                                            ->with('messages', $messages);
                }
            }
        }
        if($count == 0){
            toast('Bạn không có quyền chỉnh sửa bài viết','warning','top-right')->showCloseButton();
        }
        return back();
    }
    public function postUpdatePost(Request $request, $id){
        $post = $this->postRepository->findById($id);
        if($request->user()->can('update', $post)){
            if($request->file('files') == null){
                $post_update = [
                    'title' => $request->title,
                    'url' => $request->URL,
                    'categoryid' =>$request->category_select,
                ];
            }
            else{
                $filePathOld = public_path('storage/' . $post->thumbnail);
                if (file_exists($filePathOld)) {
                    unlink($filePathOld);
                }

                $thumbnail = $request->file('files');
                $imageName = $thumbnail->getClientOriginalName();
                // $path = $image->storeAs('app/public', $imageName);
                $path = $thumbnail->move(public_path('storage'), $imageName);

                $post_update = [
                    'title' => $request->title,
                    'url' => $request->URL,
                    'categoryid' => $request->category_select,
                    'thumbnail' => $imageName,
                ];
            }
            $this->postRepository->update($post, $post_update);
            $notification = [
                'userid' => $request->user()->id,
                'position_detail_id' => 3,
                'content' => $request->user()->firstname.' '.$request->user()->lastname.' '.'đã cập nhật bài viết'.' '.'"'.$post->title.'"',
                'URL' => 'getPosts',
            ];
            $notification_created = $this->notificationRepository->create($notification);
            $admins = $this->userRepository->findAdmins();
                foreach($admins as $admin){
                    $streamNotification = [
                        'notificationid' => $notification_created->id,
                        'userid_src' => $request->user()->id,
                        'userid_dest' => $admin->id,
                        'status' => 0,
                    ];
                    $this->streamNotificationRepository->create($streamNotification);
                }
            toast('Cập nhật bài viết thành công','success', 'top-right')->showCloseButton();
            return redirect()->route('getPosts');
        }
        return back();
    }
    public function deletePost(Request $request, $id){
        $user = Auth::user();
        $authorizations = $this->authorizationRepository->findByUserId($user->id);
        $post = $this->postRepository->findById($id);
        foreach($authorizations as $authorization){
            if($request->user()->can('canDeletePost', $authorization)){
                if($request->user()->can('delete', $post)){
                    $filePathOld = public_path('storage/' . $post->thumbnail);
                    if (file_exists($filePathOld)) {
                        unlink($filePathOld);
                    }
                    $this->postRepository->delete($post);
                    $notification = [
                        'userid' => $request->user()->id,
                        'position_detail_id' => 3,
                        'content' => $request->user()->firstname.' '.$request->user()->lastname.' '.'đã xóa bài viết'.' '.'"'.$post->title.'"',
                        'URL' => 'getPosts',
                    ];
                    $notification_created = $this->notificationRepository->create($notification);
                    $admins = $this->userRepository->findAdmins();
                    foreach($admins as $admin){
                        if($request->user()->id != $admin->id){
                            $streamNotification = [
                                'notificationid' => $notification_created->id,
                                'userid_src' => $request->user()->id,
                                'userid_dest' => $admin->id,
                                'status' => 0,
                            ];
                            $this->streamNotificationRepository->create($streamNotification);
                        }
                    }
                    if($request->user()->isAdministrator()){
                        $streamNotification = [
                            'notificationid' => $notification_created->id,
                            'userid_src' => $request->user()->id,
                            'userid_dest' => $post->user_id,
                            'status' => 0,
                        ];
                    }
                    $this->streamNotificationRepository->create($streamNotification);
                    toast('Xóa bài viết thành công','success', 'top-right')->showCloseButton();
                    return back();
                }
            }
        }
        toast('Bạn không có quyền xóa bài viết','warning','top-right')->showCloseButton();
        return back();
    }
}
