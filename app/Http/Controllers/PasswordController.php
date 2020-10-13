<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function viewFormChangePassword(){
        return view('auth.change_password');
    }
    public function changePassword(Request $request)
    {
        $password = User::find(auth::id());
        if ($request->password == $request->confirm_password) {
            $password->password = Hash::make($request['new_password']);
            $password->save();
            return redirect('viewExploreEvents');
        }
    }
}
