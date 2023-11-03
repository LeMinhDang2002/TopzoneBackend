<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Repositories\NotificationRepository;
use App\Repositories\UserRepository;
use App\Repositories\StreamNotificationRepository;
use App\Repositories\MessageRepository;
use App\Repositories\StreamMessageRepository;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected $userRepository;
    protected $notificationRepository;
    protected $streamNotificationRepository;
    protected $messageRepository;
    protected $streamMessageRepository;
    public function __construct(UserRepository $userRepository, 
                                NotificationRepository $notificationRepository,
                                StreamNotificationRepository $streamNotificationRepository,
                                MessageRepository $messageRepository,
                                StreamMessageRepository $streamMessageRepository)
    {
        $this->userRepository = $userRepository;
        $this->notificationRepository = $notificationRepository;
        $this->streamNotificationRepository = $streamNotificationRepository;
        $this->messageRepository = $messageRepository;
        $this->streamMessageRepository = $streamMessageRepository;
    }

    public function getAllNotification(){
        $notifications = $this->notificationRepository->findNotification();
        foreach($notifications as $notification){
            $user = $this->userRepository->findById($notification->userid);
            $notification['thumbnail'] = $user->thumbnail;
        }
        return $notifications;
    }
    public function getNotificationForPostCreator(){
        $notifications = $this->notificationRepository->findForPostCreator();
        foreach($notifications as $notification){
            $user = $this->userRepository->findById($notification->userid);
            $notification['thumbnail'] = $user->thumbnail;
        }
        return $notifications;
    }
    public function getMessages(Request $request){
        $messages = [];

        $streamMessages = $this->streamMessageRepository->findByUserIdDest($request->user()->id);
        foreach($streamMessages as $streamMessage){
            $message = $this->messageRepository->findById($streamMessage->message_id);
            $user = $this->userRepository->findById($message->userid);
            $message['thumbnail'] = $user->thumbnail; 
            $message['status'] = $streamMessage->status;
            $message['stream_message_id'] = $streamMessage->id;
            $messages[] = $message;
        }
        return $messages;
    }
    public function getNotifications(Request $request){
        $notifications = [];

        $streamNotifications = $this->streamNotificationRepository->findByUserIdDest($request->user()->id);
        foreach($streamNotifications as $streamNotification){
            $notification = $this->notificationRepository->findById($streamNotification->notificationid);
            $user = $this->userRepository->findById($notification->userid);
            $notification['thumbnail'] = $user->thumbnail; 
            $notification['status'] = $streamNotification->status;
            $notification['stream_notification_id'] = $streamNotification->id;
            $notifications[] = $notification;
        }
        return $notifications;
    }
    public function checkNotification(Request $request){
        if($request->has('seem')){
            $streamNotification = $this->streamNotificationRepository->findById($request->input('seem'));
            if($streamNotification->status == 0){
                $streamNotification_update = [
                    'status' => 1,
                ];
                $this->streamNotificationRepository->update($streamNotification, $streamNotification_update);
            }
        }
    }
}
