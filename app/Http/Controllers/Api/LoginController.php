<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SessionUser;
use Auth;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $dataCheckLogin = ['email' => $request->email, 'password' => $request->password];

        if (auth()->attempt($dataCheckLogin)) {
            $checkTokenExisted = SessionUser::where('user_id', auth()->id())->first();
            if (empty($checkTokenExisted)) {
                $userSession = SessionUser::create([
                    "token" => Str::random(40),
                    "refresh_token" => Str::random(40),
                    "token_expired" => date('Y-m-d H:i:s', strtotime('+30 day')),
                    "refresh_token_expired" => date('Y-m-d H:i:s', strtotime('+360 day')),
                    "user_id" => auth()->id()
                ]);
            } else {
                $userSession = $checkTokenExisted;
            }
            return response()->json([
                'code' => "200",
                'data' => $userSession
            ], 200);
        } else {
            return response()->json([
                'code' => "401",
                'message' => "error"
            ], 401);
        }
    }

    public function refreshToken(Request $request)
    {
        $token = $request->header('token');
        $checkTokenIsValid = SessionUser::where('token', $token)->first();

        if (!empty($checkTokenIsValid)) {
            if ($checkTokenIsValid->token_expired < date('Y-m-d H:i:s')) {
                $checkTokenIsValid->update([
                    "token" => Str::random(40),
                    "refresh_token" => Str::random(40),
                    "token_expired" => date('Y-m-d H:i:s', strtotime('+30 day')),
                    "refresh_token_expired" => date('Y-m-d H:i:s', strtotime('+360 day')),
                ]);
                $dataSession = SessionUser::find($checkTokenIsValid->id);
                return response()->json([
                    'code' => "200",
                    'data' => $dataSession,
                    'time' => time(),
                    'message' => 'refresh token success'
                ], 200);
            } else {
                return response()->json([
                    'code' => "200",
                    'message' => "token is still valid"
                ], 200);
            }
        } else {
            return response()->json([
                'code' => "401",
                'message' => 'refresh token failed'
            ], 401);
        }
    }

    public function deleteToken(Request $request)
    {
        $token = $request->header('token');
        $checkTokenIsValid = SessionUser::where('token', $token)->first();

        if (!empty($checkTokenIsValid)) {
            $checkTokenIsValid->delete();
            return response()->json([
                'code' => "200",
                'message' => "delete token success"
            ], 200);
        } else {
            return response()->json([
                'code' => "401",
                'message' => 'delete token failed'
            ], 401);
        }
    }
}
