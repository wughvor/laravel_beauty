<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNursesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('nurses', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->unnullable();
			$table->decimal('price', 10, 2);
			$table->tinyinteger('total')->default(1);
			$table->text('info');
			$table->timestamps();

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('nurses');
	}

}
