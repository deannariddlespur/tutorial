<?php
/*
	|--------------------------------------------------------------------------
 
     |The first thing we’ve done is to declare a new MessageBag instance. We do this because the view will still check for the errors MessageBag, whether or 
     |not it has been saved to the session. If it is, however, in the session; we overwrite the 
     new instance we created with the stored instance.
     |We then add it to the $data array so that it is passed to the view, and can be rendered.
     |If the validation fails; we save the username to the $data array, along with the validation errors,
     |and we redirect back to the same route (also using the withInput() method to store our data to the session
*/
use Illuminate\Support\MessageBag;

class UserController
  extends Controller
{
  public function loginAction()
  {
     $errors = new MessageBag();
     
     if ($old = Input::old("errors"))
     {
     	$errors = $old;
     }
     $data = [
        "errors" => $errors
    ];
    
    if (Input::server("REQUEST_METHOD") == "POST")
    {
      $validator = Validator::make(Input::all(), [
         "username" => "required",
         "password" => "required"
    ]);
    
    if ($validator->passes())
    {
       $credentials = [
          "username" => Input::get("username"),
          "password" => Input::get("password")
    ];
    
    if ( Auth::attempt($credentials))
    {
        return Redirect::route("user/profile");
    }
    }
    
    
    
     
        $data["errors"] = new MessageBag([
          "password" => [
              "Username and/or password invalid."
              ]
        ]);
        
        $data["username"] = Input::get("username");
        
        return Redirect::route("user/login")
           ->withInput($data);
    }


  return View::make("user/login",$data);
    }
}
    public function requestAction()
	{
	 $data = [
		 "requested" => Input::old("requested")
	];

		 if (Input::server("REQUEST_METHOD") == "POST") 
		 {


$validator = Validator::make(Input::all(), [
    "email" => "required"
]);
if ($validator->passes()) {
    $credentials = [
        "email" => Input::get("email")
    ];
    Password::remind($credentials,
    
    
    function($message, $user) {
        $message->from("chris@example.com");
    }
);
	$data["requested"] = true;
	
	return Redirect::route("user/request")
	 ->withInput($data);

	} 
}
	return View::make("user/request", $data); 
}   
 public function resetAction()

{
 $token = "?token=" . Input::get("token"); 
 $errors = new MessageBag();

	if ($old = Input::old("errors")) 8{

    $errors = $old;
	}
		$data = [
    		"token"  => $token,
    "		errors" => $errors
];



	if (Input::server("REQUEST_METHOD") == "POST") 
	{
		$validator = Validator::make(Input::all(), [

 			"email" => "required|email", 
 			 "password" => "required|min:6",
   				"password_confirmation" => "same:password",
                   "token"               => "exists:token,token" 
 ]);

  if ($validator->passes()) 
  {
		$credentials = [

                "email" => Input::get("email")
            ];
		Password::reset($credentials,
				 function($user, $password) {
                    $user->password = Hash::make($password);
                    $user->save();
                    
                    Auth::login($user);
					return Redirect::route("user/profile"); 
			}
		);
 }
        $data["email"] = Input::get("email");
        $data["errors"] = $validator->errors();
		return Redirect::to(URL::route("user/reset") . $token) 
		->withInput($data);
}
	return View::make("user/reset", $data);
 }
***********************************
    if ($this->isPostRequest()) {
      $validator = $this->getLoginValidator();

      if ($validator->passes()) {
        $credentials = $this->getLoginCredentials();

        if (Auth::attempt($credentials)) {
          return Redirect::route("user/profile");
        }

        return Redirect::back()->withErrors([
          "password" => ["Credentials invalid."]
        ]);
      } else {
        return Redirect::back()
          ->withInput()
          ->withErrors($validator);
      }
    }

    return View::make("user/login");
  }

  protected function isPostRequest()
  {
    return Input::server("REQUEST_METHOD") == "POST";
  }

  protected function getLoginValidator()
  {
    return Validator::make(Input::all(), [
      "username" => "required",
      "password" => "required"
    ]);
  }

  protected function getLoginCredentials()
  {
    return [
      "username" => Input::get("username"),
      "password" => Input::get("password")
    ];
  }

  public function profile()
  {
    return View::make("user/profile");
  }

  public function request()
  {
    if ($this->isPostRequest()) {
      $response = $this->getPasswordRemindResponse();

      if ($this->isInvalidUser($response)) {
        return Redirect::back()
          ->withInput()
          ->with("error", Lang::get($response));
      }

      return Redirect::back()
        ->with("status", Lang::get($response));
    }

    return View::make("user/request");
  }

  protected function getPasswordRemindResponse()
  {
    return Password::remind(Input::only("email"));
  }

  protected function isInvalidUser($response)
  {
    return $response === Password::INVALID_USER;
  }

  public function reset($token)
  {
    if ($this->isPostRequest()) {
      $credentials = Input::only(
        "email",
        "password",
        "password_confirmation"
      ) + compact("token");

      $response = $this->resetPassword($credentials);

      if ($response === Password::PASSWORD_RESET) {
        return Redirect::route("user/profile");
      }

      return Redirect::back()
        ->withInput()
        ->with("error", Lang::get($response));
    }

    return View::make("user/reset", compact("token"));
  }

  protected function resetPassword($credentials)
  {
    return Password::reset($credentials, function($user, $pass) {
      $user->password = Hash::make($pass);
      $user->save();
    });
  }

  public function logoutAction()
  {
    Auth::logout();

    return Redirect::route("user/login");
  }
}

