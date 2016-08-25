<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use DB;

class ZizacoController extends Controller
{
    public function index()
    {
    	DB::transaction(function () {
	    	$owner = new Role();
	    	$owner->name = 'owner';
	    	$owner->display_name = 'Project Owner';
	    	$owner->description = 'User is the owner of a given project';
	    	$owner->save();

	    	$admin = new Role();
	    	$admin->name = 'admin';
	    	$admin->display_name = 'User Administrator';
	    	$admin->description = 'User is allowed to manage and edit other users';
	    	$admin->save();

	    	$user = User::where('name', '=', 'huang')->first();
	    	$user->attachRole($admin);

	    	$createPost = new Permission();
			$createPost->name         = 'create-post';
			$createPost->display_name = 'Create Posts'; // optional
			// Allow a user to...
			$createPost->description  = 'create new blog posts'; // optional
			$createPost->save();

			$editUser = new Permission();
			$editUser->name         = 'edit-user';
			$editUser->display_name = 'Edit Users'; // optional
			// Allow a user to...
			$editUser->description  = 'edit existing users'; // optional
			$editUser->save();

			$admin->attachPermission($createPost);
			// equivalent to $admin->perms()->sync(array($createPost->id));

			$owner->attachPermissions(array($createPost, $editUser));
			// equivalent to $owner->perms()->sync(array($createPost->id, $editUser->id));
		});
    }
}
