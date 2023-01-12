<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function showProfile()
    {
        return view('pages.settings.profile');
    }

    public function saveProfile(Request $request){
        $user=auth()->user();
        try{
            if($request->pass){
                $user=User::find($user->id);
                $user->update([
                    'name'=>$request->name,
                    'password'=>bcrypt($request->pass),
                ]);

                return back()->with('success','Updated profile successfully');
            }
            else{
                $user=User::find($user->id);
                $user->update([
                    'name'=>$request->name,
                ]);
                return back()->with('success','Updated profile successfully');
            }
        }
        catch(\Exception $e){
            return back()->with('error', $e->getMessage());
        }
    }

    public function showAdmin()
    {
        return view('pages.settings.user-management');
    }

    public function newUser(Request $request)
    {
        if($request->password != $request->password_confirmation){
            return back()->with('error','Passwords do not match.');
        }

        try{
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'access' => $request->access,
                'status' => 'active'
            ]);
            return back()->with('success','User created successfully');
        }
        catch (\Exception $e){
            return back()->with('error',$e->getMessage());
        }

    }

}
