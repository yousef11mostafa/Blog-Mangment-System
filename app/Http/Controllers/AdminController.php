<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
Use App\Models\User;
Use App\Models\Post;
Use App\Models\Comment;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminController extends Controller
{
    //
    use ApiResponse;
    public function __construct(){

         $this->middleware('Role:admin');

    }
    public function indexUsers(){
       return $this->successResponse(data:User::paginate(10));
    }
    public function indexPosts(){
       return $this->successResponse(data:Post::paginate(10));
    }
    public function indexComments(){
       return $this->successResponse(data:Comment::paginate(10));
    }



    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            // Add other fields as needed
        ]);

        $user->update($validatedData);

        return response()->json(['message' => 'User updated successfully']);
    }


    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }


    public function approvePost($postId)
    {
        $post = Post::findOrFail($postId);
        $post->update(['status' => 'published']);

        return $this->successResponse(message:'Post approved successfully');
    }


    public function assignRole(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        $role = $request->input('role');
        $user->syncRoles([$role]);

        return $this->successResponse(message:'Role assigned successfully');
    }

    public function indexRoles($userId){
          return User::find($userId)->roles;
    }
    public function indexPermissions($userId){
          return User::find($userId)->getAllPermissions();
    }

    public function updatePermissions(Request $request, $roleId)
{

    $role = Role::findOrFail($roleId);
    $permissions = $request->input('permissions');

    $role->syncPermissions($permissions);

    return $this->successResponse(message:'Permissions updated successfully');
}



}
