<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSessionRecordsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('session_records', function($table){
			$table->increments('id');
			$table->timestamp('started_at');
			$table->timestamp('ended_at');
			$table->unsignedInteger('subject_id');
			$table->string('subject_type');
			$table->string('subject_address')->nullable();

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('session_records');
	}

}
