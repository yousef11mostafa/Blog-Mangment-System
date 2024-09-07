<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class TestController extends Controller
{
    //

    public function index(){

        // $user=User::find(45);


        // $user->assignRole('admin');
        // return $user->getAllPermissions();

        // return User::find(1)->getAllPermissions();
        return User::find(48)->roles;
    }
}
