<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class GithubAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('github')->redirect();
    }

    public function callback(){

        try {

            $githubUser=Socialite::driver('github')->user();

            $user=User::where('email',$githubUser->email)->first();

            if ($user)
            {

                auth()->loginUsingId($user->id);

            }
            else
            {
                $newUser=User::create([

                    'name'=>$githubUser->name,

                    'email'=>$githubUser->email,

                    'password' => bcrypt(\Str::random(20)),
                ]);

                auth()->LoginUsingId($newUser->id);
            }


            return redirect('/');

        }catch (\Exception $e)
        {
            //TODO show Error MAssage

            return 'Error';
        }
    }
}

