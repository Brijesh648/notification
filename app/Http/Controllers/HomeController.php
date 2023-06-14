<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function saveToken(Request $request)
    {
            User::insert(['fcm_token' => $request->token]);
            return response()->json([
                'success' => true
            ]);
     
    }

    public function sendNotification(Request $request)
    {
        $firebaseToken = User::whereNotNull('fcm_token')->pluck('fcm_token')->all();
        $SERVER_API_KEY = 'AAAA4hnxc3A:APA91bHPhO1MjN2nCXcFnTI24NgXLF1yh7Rv6bWKMv8CdRs0wjHtKR2V0_wlornD9O-NgMYn7iCJwnyQiighkuwXkvsx0UkNRmP6h7tmpV0kU1q6bwfJ5s0GVXc0j24SPco-jCrND_7r';

        $data = [
            "registration_ids" => $firebaseToken,
            "notification" => [
                "title" => $request->title,
                "body" => $request->body,
                // "click_action" => "https://google.com"
            ],
        ];

        $dataString = json_encode($data);

        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);
    }

}
