<?php

namespace App\Http\Controllers;

use App\Models\UserMail;
use Illuminate\Http\JsonResponse;

class UserMailStatisticsController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function outboxStatus(): JsonResponse
    {
        $status = UserMail::where('sender_id', auth()->user()->id)->get()->groupBy('status')->toArray();
        $status = array_map(function ($s) {
            return sizeof($s);
        }, $status);
        return response()->json($status);
    }

    /**
     * @return JsonResponse
     */
    public function sentAmount(): JsonResponse
    {
        $count = UserMail::where('sender_id', auth()->user()->id)->where('status', 'SENT')->get()->count();
        return response()->json($count);
    }

    /**
     * @return JsonResponse
     */
    public function leadingRecipient(): JsonResponse
    {
        $count = UserMail::where('sender_id', auth()->user()->id)->select('to')
            ->selectRaw('COUNT(*) AS count')
            ->groupBy('to')
            ->orderByRaw('count DESC')
            ->limit(1)
            ->first();
        return response()->json($count);
    }
}
