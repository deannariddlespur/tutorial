<?php
//The login action is what glues the authentication logic to the views we have created. If you have
Route::any("/", [
  "as"   => "user/login",
  "uses" => "UserController@loginAction"
]);

Route::group(["before" => "auth"], function() {

  Route::any("/profile", [
    "as"   => "user/profile",
    "uses" => "UserController@profile"
  ]);

  Route::any("/logout", [
    "as"   => "user/logout",
    "uses" => "UserController@logout"
  ]);

});

Route::any("/request", [
  "as"   => "user/request",
  "uses" => "UserController@request"
]);

Route::any("/reset/{token}", [
  "as"   => "user/reset",
  "uses" => "UserController@reset"
]);
