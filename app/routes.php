<?php
//The login action is what glues the authentication logic to the views we have created. If you have


 Route::group(["before"=>"guest"],function() 
{


    Route::any("/request", [
        "as"   => "user/request",
        "uses" => "UserController@requestAction"
]);
    Route::any("/reset", [
        "as"   => "user/reset",
        "uses" => "UserController@resetAction"
]); });
Route::group(["before"=>"auth"],function() {
 	Route::any("/profile", [
	Route::any("/", [
    "as"   => "user/login",
    "uses" => "UserController@loginAction"
]);


        "as"   => "user/profile",
        "uses" => "UserController@profileAction"
    ]);
    Route::any("/logout", [
        "as"   => "user/logout",
        "uses" => "UserController@logoutAction"
	]);
});