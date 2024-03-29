<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\DeviceResource;
use App\Models\Device;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function get_me(Request $request)
    {
        $data = [
            'device'=> new DeviceResource($request->device),
        ];
        return $data;
    }
    public function login(Request $request)
    {

        //  toDo: Check the user completely

        $validator = Validator::make($request->all(), [
            'username' => 'required|max:64',
            'password' => 'required|max:64',
            'unique_info' => 'required|max:64',
            'device_info' => 'required',
        ]);
        if ($validator->fails())
            return response()->error(400, 'Authentication information is incomplete', $validator->messages()->getMessages());
        else {
            $user = User::where('username', $request->username)->first();
            if ($user && Hash::check($request->password, $user->password)) {
                $dev = Device::where(['unique_info' =>  $request->unique_info, 'user_id' => $user->id])->first();
                $token = Str::random(64);

                if ($dev) {
                    $count = $dev->update(['token_hash' => Hash::make($token)]);
                } else {
                    $count = Device::create([
                        'user_id' => $user->id,
                        'token_hash' => Hash::make($token),
                        'unique_info' => $request->unique_info,
                        'device_info' => json_encode($request->device_info),
                    ]);
                }

                if ($count)
                    return response()->success('The token was generated', ['token' => $token]);
                else
                    return response()->error(500, 'The operation was not performed correctly');
            }
            else
                return response()->error(404, 'The authentication information used is incorrect');
        }
    }

}
