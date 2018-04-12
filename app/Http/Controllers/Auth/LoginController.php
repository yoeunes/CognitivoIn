<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
  /*
  |--------------------------------------------------------------------------
  | Login Controller
  |--------------------------------------------------------------------------
  |
  | This controller handles authenticating users for the application and
  | redirecting them to your home screen. The controller uses a trait
  | to conveniently provide its functionality to your applications.
  |
  */

  use AuthenticatesUsers;

  /**
  * Where to redirect users after login.
  *
  * @var string
  */
  protected $redirectTo = '/';

  /**
  * Create a new controller instance.
  *
  * @return void
  */
  public function __construct()
  {
      $this->middleware('guest')->except('logout');
  }

  public function redirectToGoogle()
  {
      return Socialite::driver('google')->redirect();
  }

  public function handleGoogleCallback()
  {
      try {
          $user = Socialite::driver('google')->user();
      } catch (Exception $e) {
          return redirect('/login');
      }
      $createdUser = $this->createUser($user);
      Auth::login($createdUser,true);

      return redirect()->route('/');
  }

  public function createUser($user)
  {
      $user_google = User::where('google_id', $user->id)->first();

      if ($user_google)
      {
          return $user_google;
      }

      $profile       = new Profile;
      $profile->slug = $user->name;
      $profile->name = $user->name;
      $profile->save();

      return User::create([
          'profile_id' => $profile->id,
          'google_id'  => $user->id,
          'name'       => $user->name,
          'email'      => $user->email,
      ]);
      # code...
  }

}
