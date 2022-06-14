<?php

namespace App\Http\Controllers;

use app\Models\Master\User\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use PhpParser\Node\Stmt\TryCatch;

class GoogleController extends Controller
{
    public function redirectToGoogle(){
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(){
        try {
            $user = Socialite::driver('google')->user() ;
            //dd($user);
            $finduser = User::where('google_id',$user->getId())->first();
            if($finduser){
                Auth::login($finduser);
                return redirect()->intended('index');
            }else{
                $newUser = User::create([
                    'name' => $user->getName(),
                    'username' => $user->getEmail(),
                    'email' => $user->getEmail() ,
                    'google_id' => $user->getId(),
                    'password' => bcrypt('12345678')
                ]);

                Auth::login($newUser);
                return redirect()->intended('index');
            }

        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
