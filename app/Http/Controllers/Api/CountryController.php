<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SessionUser;
use Illuminate\Http\Request;
use App\Models\Country;

class CountryController extends Controller
{
    public function index(Request $request)
    {
        $token = $request->header('token');
        $checkTokenIsValid = SessionUser::where('token', $token)->first();
 
        if (empty($token)) {
            return response()->json([
                'code' => 401, 'message' => 'Token không được gửi từ header'
            ], 401);
        } elseif (empty($checkTokenIsValid)) {
            return response()->json([
                'code' => 401, 'message' => 'Token không hợp lệ'
            ], 401);
        } else {
            $country = Country::all();
            return response()->json([
                'code' => 200,
                'data' => $country
            ], 200);
        }
    }
}
