<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\ApiController;
use App\Mail\UserCreated;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UsersController extends ApiController
{
    public function index()
    {
        $users = User::all();
        return $this->showAll($users);
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|min:5',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed'
        ];
        $this->validate($request, $rules);

        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        $data['verified'] = User::UNVERIFIED_USER;
        $data['verification_token'] = User::generateVerificationCode();
        $data['admin'] = User::REGULAR_USER;

        $user = User::create($data);
        return $this->showOne($user, 201);
    }

    public function show(User $user)
    {
        return $this->showOne($user);
    }

    public function update(Request $request, User $user)
    {
        $rules = [
            'name' => 'min:5',
            'email' => 'email|unique:users',
            'password' => 'min:8|confirmed',
            'admin' => 'in:'. User::REGULAR_USER . ',' . User::ADMIN_USER
        ];
        $this->validate($request, $rules);

        if($request->has('name')) {
            $user->name = $request->name;
        }
        if($request->has('email')) {
            $user->verified = User::UNVERIFIED_USER;
            $user->verification_token = User::generateVerificationCode();
            $user->email = $request->email;
        }
        if($request->has('password')) {
            $user->password = bcrypt($request->password);
        }
        if($request->has('admin')) {
            if(! $user->isVerified()) {
                return response()->json(['error' => 'Only verified users can be admin!', 'code' => 409], 409);
            }
            $user->admin = $request->admin;
        }
        if(! $user->isDirty()) {
            return response()->json(['error' => 'You need to specify some differnet value to update', 'code' => 422], 422);
        }

        $user->save();

        return response()->json(['data' => $user], 200);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['data' => $user], 200);
    }

    public function verify(string $token)
    {
        $user = User::where('verification_token', $token)->firstOrFail();

        $user->verified = User::VERIFIED_USER;
        $user->verification_token = null;

        $user->save();

        return $this->showMessage("User Account has been verified successfully!");
    }

    public function resend(User $user)
    {
        if ($user->isVerified()) {
            return $this->errorResponse('User is already verified!', 409);
        }

        retry(5, function() use($user) {
            Mail::to($user)->send(new UserCreated($user));
        });
        return $this->showMessage("A verification email has been sent to your registered email!");
    }

}
