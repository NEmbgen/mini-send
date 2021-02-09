<?php

namespace App\Http\Controllers;

use App\Mail\ContentMail;
use App\Models\UserMail;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserMailController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $query = UserMail::query();

        if ($request->has('q') && $request->get('q') !== null) {
            $q = $request->get('q');
            $query->where('subject', 'LIKE', '%' . $q . '%');
            $query->orWhere('to', 'LIKE', '%' . $q . '%');
            $query->orWhereHas('sender', function ($query) use ($q) {
                $query->orWhere('first_name', 'LIKE', '%' . $q . '%')
                    ->orWhere('last_name', 'LIKE', '%' . $q . '%')
                    ->orWhere('email', 'LIKE', '%' . $q . '%');
            });
        }

        $query->with('sender')->limit(10);

        return response()->json($query->get());
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function send(Request $request): JsonResponse
    {
        $userMail = new UserMail();
        $userMail->fill($request->all());
        $userMail->save();

        Mail::to($userMail->to)->queue(new ContentMail($userMail));

        if (Mail::failures()) {
            return response()->json(Mail::failures());
        }

        return response()->json($request->all());
    }

    /**
     * @param UserMail $mail
     * @return JsonResponse
     */
    public function show(UserMail $mail): JsonResponse
    {
        return response()->json($mail);
    }
}
