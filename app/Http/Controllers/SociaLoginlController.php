<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Socialite;

class SociaLoginlController extends Controller
{
  /**
  * Redirect the user to the GitHub authentication page.
  *
  * @return \Illuminate\Http\Response
  */
  public function redirectToProvider($provider)
  {
    return Socialite::driver($provider)->redirect();
  }

  /**
  * Obtain the user information from GitHub.
  *
  * @return \Illuminate\Http\Response
  */
  public function handleProviderCallback($provider)
  {
    $user = Socialite::driver($provider)->user();
    return $user;
    // $user->token;
  }
}
