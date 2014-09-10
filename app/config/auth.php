<?php
/*
	|--------------------------------------------------------------------------
	|Pay particular attention to the view specified by email ⇒ email.request it 
	|tells Laravel to load the file app/views/email/request.blade.php 
	|instead of the default app/views/emails/auth/re- minder.blade.php.
	|
	*/

return [
  "driver"   => "eloquent",
  "model"    => "User",
  "reminder" => [
    "email"  => "email/request",
    "table"  => "token",
    "expire" => 60
  ]
];
