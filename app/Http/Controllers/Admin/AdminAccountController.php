<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminAccountController extends Controller
{
    public function general(){
        return view('admin.account', [
            'user' => Auth::user()
        ]);
    }

    public function update(Request $request){
        $validated = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'mobile' => 'size:10',
            'intro' => 'max:255',
        ]);

        $user = User::find(Auth::user()->id);

        $user->first_name = $validated['first_name'];
        $user->last_name = $validated['last_name'];

        $request->whenHas('mobile', function ($input) use ($user){
            $user->mobile = $input;
        });
        $request->whenHas('intro', function ($input) use ($user){
            $user->intro = $input;
        });
       
        $user->save();

        return redirect()->route('admin.account')->with('status', 'profile updated');
    }

    public function updatePwd(Request $request){
        $validated = $request->validateWithBag('pwdError',[
            'old' => 'required',
            'password' => 'required|confirmed|min:6|different:old',
        ]);

        $user = User::find(Auth::user()->id);
        
        if (Hash::check($request->old, $user->password)) { 
           $user->password = Hash::make($request->password);
           $user->save();
        
           return redirect()->route('admin.account')->with('pwdStatus', 'password changed!');

        
        } else {
            return redirect()->route('admin.account')->withErrors('incorrect old password', 'pwdError');
        }
    }
}
