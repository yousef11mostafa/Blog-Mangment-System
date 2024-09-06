<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponse;
use Illuminate\Http\Request;
Use App\Models\Post;


class FrontController extends Controller
{
    //
    use ApiResponse;
    public function index(){


        $posts=Post::with(['user','comments.user'])->orderBy('id', 'desc')->paginate(10);

        return $this->successResponse(data:$posts);
    }
}
