<?php

namespace App\Http\Controllers;
use App\Repositories\StreamMessageRepository;
use App\Repositories\MessageRepository;

use Illuminate\Http\Request;

class StreamMessageController extends Controller
{
    protected $streamMessageRepository;
    protected $messageRepository;

    public function __construct(MessageRepository $messageRepository,
                                StreamMessageRepository $streamMessageRepository)
    {
        $this->streamMessageRepository = $streamMessageRepository;
        $this->messageRepository = $messageRepository;
    }
    public function postUpdateMessage(Request $request, $id){
        $streamMessage = $this->streamMessageRepository->findById($id);
        if($streamMessage->status == 0){
            $streamMessage_update = [
                'status' => 1,
            ];
            $this->streamMessageRepository->update($streamMessage, $streamMessage_update);
        }
        return response()->json(['message' => 'success'], 200);
    }

    public function postAcceptAuthorization(Request $request){
        $streamMessage = $this->streamMessageRepository->findById($request->id);
        $this->streamMessageRepository->delete($streamMessage);
        $message= [
            'userid' => $request->user()->id,
            'content' => $request->user()->firstname.' '.$request->user()->lastname.' '.'đã chấp nhận yêu cầu quyền'.' '.$request->main_content,
        ];
        $new_message = $this->messageRepository->create($message);
        $new_streamMessage = [
            'message_id' => $new_message->id,
            'userid_src' => $request->user()->id,
            'userid_dest' => $request->userid,
            'status' => 0,
        ];
        $this->streamMessageRepository->create($new_streamMessage);
        toast('Xác nhận thành công','success', 'top-right')->showCloseButton();
        return redirect()->route('getAllUser');
    }

    public function postRefuseAuthorization(Request $request){
        $streamMessage = $this->streamMessageRepository->findById($request->id);
        $this->streamMessageRepository->delete($streamMessage);
        $message= [
            'userid' => $request->user()->id,
            'content' => $request->user()->firstname.' '.$request->user()->lastname.' '.'đã từ chối yêu cầu quyền'.' '.$request->main_content,
        ];
        $new_message = $this->messageRepository->create($message);
        $new_streamMessage = [
            'message_id' => $new_message->id,
            'userid_src' => $request->user()->id,
            'userid_dest' => $request->userid,
            'status' => 0,
        ];
        $this->streamMessageRepository->create($new_streamMessage);
        toast('Từ chối thành công','success', 'top-right')->showCloseButton();
        return back();
    }
}
