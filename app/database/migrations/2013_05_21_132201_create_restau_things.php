<?php

use Illuminate\Database\Migrations\Migration;

class CreateRestauThings extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		$this->down();
		Schema::create('restaurant', function($table){
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->string('nom');
			$table->string('categorie');
			$table->string('adresse');
			$table->string('logo');
			$table->timestamps();
		});

		Schema::create('menu', function($table){
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->integer('id_restaurant');
			$table->string('libelle');
			$table->float('prix',5, 2);
		});

		Schema::create('user', function($table){
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->string('pseudo');
		});

		Schema::create('manger', function($table){
			$table->engine = 'InnoDB';
			$table->integer('id_user');
			$table->integer('id_restaurant');
			$table->integer('id_menu');
			$table->timestamps();
		});

		/*Schema::create('vouloir', function($table){
			$table->engine = 'InnoDB';
			$table->integer('id_user');
			$table->integer('id_restaurant');
			$table->boolean('interesse');
			$table->date('create_at');
			$table->unique(array('create_at','id_user','id_restaurant'));
		});*/
		$restau = new Restaurant();
		$mesRestaurants = $restau->initialisation();
		$user = new User();
		$allUser = $user->addUsers();
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('restaurant');
		Schema::dropIfExists('menu');
		Schema::dropIfExists('categorie');
		Schema::dropIfExists('user');
		Schema::dropIfExists('manger');
		//Schema::dropIfExists('vouloir');
	}

}