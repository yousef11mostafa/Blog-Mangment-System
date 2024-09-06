<?php

namespace App\Http\Controllers;
Use App\Models\Comment;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use App\Traits\ApiResponse;

class CommentsController extends Controller
{
    //
    use ApiResponse;

    public function index( $id){
        // Gate::authorize('view',Comment::find($id));
        $comment=Comment::find($id);
        return response()->json($comment);
    }
    public function create(CommentRequest $request){
        Gate::authorize('create',Comment::class);

        $validated=$request->validated();
        $validated['user_id']=auth()->user()->id;

       Comment::create($validated);

        return $this->successResponse(message:'post_created_successfull');
    }

    public function update(CommentRequest $request, $id ){

         $comment=Comment::find($id);

         Gate::authorize('update',$comment);

         $validated=$request->validated();
         $validated['post_id']=$comment->post->id;
         $validated['user_id']=auth()->user()->id;

         $comment->update($validated);

         return $this->successResponse(message:'post_updated_successfull');
    }

    public function delete(Request $request,$id){
        $comment=Comment::find($id);
 
        // return $userofcomment->id;
        Gate::authorize('delete',$comment);
        $comment->delete();
        return $this->successResponse(message:'post_deleted_successfull');
    }
}
