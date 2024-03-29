<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
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
    public function index()
    {
        //
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
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }


}
