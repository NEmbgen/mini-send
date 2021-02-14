<?php

namespace App\Http\Controllers;

use App\Mail\ContentMail;
use App\Models\UserMail;
use App\Models\UserMailAttachment;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;

class UserMailController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $query = UserMail::where('sender_id', auth()->user()->id);

        if ($request->has('q') && $request->get('q') !== null) {
            $q = $request->get('q');
            $query->where('subject', 'LIKE', '%' . $q . '%');
            $query->orWhere('to', 'LIKE', '%' . $q . '%');
            $query->orWhereHas('sender', function ($query) use ($q) {
                $query->where('first_name', 'LIKE', '%' . $q . '%')
                    ->orWhere('last_name', 'LIKE', '%' . $q . '%')
                    ->orWhere('email', 'LIKE', '%' . $q . '%');
            });
        }

        $query->orderByDesc('created_at');

//        $query->with('sender');
        $query->select(['to', 'created_at', 'subject', 'status', 'id']);
        $query->with('attachments:id,user_mail_id');


        return response()->json($query->get());
    }

    /**
     * @param UserMail $mail
     * @return Application|ResponseFactory|JsonResponse|Response
     */
    public function show(UserMail $mail)
    {
        $mail['sender'] = $mail->sender;
        $mail['attachments'] = $mail->attachments;
        if (auth()->user()->id === $mail->sender_id) {
            return response()->json($mail);
        } else {
            return response(['error' => 'Not allowed'], 403);
        }
    }

    /**
     * @param Request $request
     * @return Application|ResponseFactory|JsonResponse|Response
     */
    public function send(Request $request)
    {
        $userMail = new UserMail();
        $userMail->fill($request->all());
        $userMail->sender_id = auth()->user()->id;
        $userMail->status = 'POSTED';
        $userMail->save();

        if (sizeof($request->allFiles()) > 0) {
            foreach ($request->allFiles() as $file) {
                $attachment = new UserMailAttachment();
                $attachment->user_mail_id = $userMail->id;
                $attachment->file_size = $file->getSize();
                $attachment->file_name = time() . '_' . $file->getClientOriginalName();
                $attachment->mime_type = mime_content_type($file->getPathname());
                $temp = $file->move(public_path() . '/attachments/', $attachment->file_name);
                $attachment->path = $temp->getPathname();
                $attachment->download_url = asset('attachments/' . $temp->getFilename());
                $attachment->save();
            }
        }

        Mail::to(['email' => $userMail->to])->queue(new ContentMail($userMail));
        $userMail->status = 'SENT';
        $userMail->sent_at = Carbon::now();
        $userMail->save();

        $userMail['attachments'] = $userMail->attachments;

        return response()->json($userMail);
    }
}
