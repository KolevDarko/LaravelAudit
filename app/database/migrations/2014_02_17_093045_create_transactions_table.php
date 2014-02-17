<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('transaction_records', function($table){
			$table->increments('id');
			$table->timestamp('started_at');
			$table->timestamp('ended_at');
			$table->unsignedInteger('session_id')->references('id')->on('session_records');
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
		Schema::drop('transaction_records');
	}

}
