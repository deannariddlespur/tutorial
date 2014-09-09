<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration {


	public function up()
	{
		Schema::create("user", function(Blueprint $table)
		{
			$table->incerments("id");
			
			$table
			   ->string("username")
			   ->nullable()
			   ->default(null);
			$table
			  	->string("password")
			  	->nullable()
			  	->default(null);
			  
			  $table
			  	  ->srting("email")
			  	  ->nullable()
			  	  ->default(null);
			  	  
			  $table
			      ->dateTime("created_at")
			      ->nullable()
			  	  ->default(null);
			      
			    $table
			      ->dateTime("updated_at")
			      ->nullable()
			  	  ->default(null);   
			  	  
			  	  
			});
			
			 
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schems::dropIfExists("user");
	}

}
