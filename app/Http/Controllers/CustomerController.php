<?php

namespace App\Http\Controllers;
use App\Repositories\CustomerRepository;
use App\Repositories\PositionRepository;
use App\Repositories\NotificationRepository;
use App\Repositories\UserRepository;
use App\Repositories\StreamNotificationRepository;
use App\Repositories\MessageRepository;
use App\Repositories\StreamMessageRepository;

use Illuminate\Http\Request;

class CustomerController extends Controller
{

    protected $customerRepository;
    protected $positionRepository;
    protected $userRepository;
    protected $notificationRepository;
    protected $streamNotificationRepository;
    protected $messageRepository;
    protected $streamMessageRepository;
    public function __construct(CustomerRepository $customerRepository,
                                PositionRepository $positionRepository,
                                UserRepository $userRepository, 
                                NotificationRepository $notificationRepository,
                                StreamNotificationRepository $streamNotificationRepository,
                                MessageRepository $messageRepository,
                                StreamMessageRepository $streamMessageRepository)
    {
        $this->customerRepository = $customerRepository;
        $this->positionRepository = $positionRepository;
        $this->userRepository = $userRepository;
        $this->notificationRepository = $notificationRepository;
        $this->streamNotificationRepository = $streamNotificationRepository;
        $this->messageRepository = $messageRepository;
        $this->streamMessageRepository = $streamMessageRepository;
    }

    public function getCustomers(Request $request){
        $positions = $this->positionRepository->findByUserId($request->user()->id);
        foreach($positions as $position){
            if($request->user()->can('viewPageCustomers', $position)){
                $this->checkNotification($request);
                $notifications = $this->getNotifications($request);
                $messages = $this->getMessages($request);
                $customers = $this->customerRepository->findAll();
                return view('Dashboard.Customer.Customer')->with('notifications', $notifications)
                                                            ->with('messages', $messages)
                                                            ->with('customers', $customers);
            }
        }
        toast('Bạn không có quyền cho trang khách hàng','error', 'top-right')->showCloseButton();
        return back();
    }
    public function getCustomerDetail(Request $request){
        $positions = $this->positionRepository->findByUserId($request->user()->id);
        foreach($positions as $position){
            if($request->user()->can('viewPageCustomers', $position)){
                $this->checkNotification($request);
                $notifications = $this->getNotifications($request);
                $messages = $this->getMessages($request);
                $customers = $this->customerRepository->findAll();
                return view('Dashboard.Customer.CustomerDetail')->with('notifications', $notifications)
                                                            ->with('messages', $messages)
                                                            ->with('customers', $customers);
            }
        }
        toast('Bạn không có quyền cho trang khách hàng','error', 'top-right')->showCloseButton();
        return back();
    }
}
