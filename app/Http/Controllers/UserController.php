<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Traits\ApiResponse;
use App\Http\Requests\ProfileRequest;
use App\Http\Resources\getroles;


class UserController extends Controller
{

    use ApiResponse;

    public function index(){

        $userData = User::with('posts.comments.user')->find(auth()->user()->id);
        return $this->successResponse(data:$userData);

    }

    public function updateProfile(ProfileRequest $request)
    {
        $validatedData = $request->validated();

        $user = User::find(auth()->user()->id);

        $user->update($validatedData);

        return $this->successResponse(message:"Profile updated successfully");
    }

    public function changePassword(Request $request)
    {

        $user=User::find(auth()->user()->id);
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return $this->successResponse(message:"Current password does not match");
        }

       $user->update(['password' => bcrypt($request->new_password)]);

       return $this->successResponse(message:"password updated successfully");
    }


    public function getroles(Request $request)
    {
        return  getroles::collection(User::find(auth()->user()->id)->roles);
    }
}
