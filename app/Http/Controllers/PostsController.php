<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Post;
use App\Http\Requests\PostRequest;

class PostsController extends Controller
{
    //
    public function index( $id){

        Gate::authorize('view',Post::find($id));
        $post=Post::find($id);
        return response()->json($post);
    }
    public function create(PostRequest $request){

        Gate::authorize('create',Post::class);

        $validated=$request->validated();
        $validated['user_id']=auth()->user()->id;

        Post::create($validated);

        return response()->json(['message'=>'post_created_successfully']);
    }

    public function update(PostRequest $request,$id){

         Gate::authorize('update',Post::find($id));

         $validated=$request->validated();
         $validated['user_id']=auth()->user()->id;

         $post=Post::find($id);
         $post->update($validated);

         return response()->json(['message'=>'post_created_successfully']);
    }

    public function delete(Request $request,$id){
        Gate::authorize('delete',Post::find($id));
        Post::find($id)->delete();
        return response()->json(['message'=>'post_deleted_successfully']);
    }
}
