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
}
