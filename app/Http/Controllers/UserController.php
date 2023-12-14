<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = new User();

    }

    public function show()
    {
        $user = $this->user->getAllUser();
        return view('backend.user.listuser', compact('user'));

    }

    public function update(Request $request)
    {
        $user = $this->user->editUser($request);
        if ($user) {
            return redirect()->route('listuser')->with('success', "Update role success!");
        } else {
            return redirect()->route('listuser')->with('error', "Update role fail!");
        }

    }

    public function destroy(Request $request)
    {
        $user = $this->user->deleteUser($request);
        if ($user) {
            return redirect()->route('listuser')->with('success', "Delete user success!");
        } else {
            return redirect()->route('listuser')->with('error', "Delete user fail!");
        }
    }
    public function getSearchUser(Request $request){
        $keyword = $request->input('search');
        if($keyword ==null){
        return redirect()->route('listuser')->with('error','Please enter the keyword you want to search for!');
        }
        else{

         $search = User::where('name', 'like', '%' . $keyword . '%')
                  ->orWhere('email', 'like', '%' . $keyword . '%')
                  ->orWhere('phone', 'like',  $keyword  );
          if ($search->count() == 0) {
             return redirect()->route('listuser')->with('error', 'The order information you are looking for does not exist!');
          } else {
             $user = $search->paginate(8);
          return view('backend.user.listuser', ['user' => $user]);
         }
        }
        }
}
