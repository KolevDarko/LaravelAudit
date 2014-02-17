<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConsumptionEventsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// A record of a resource being consumed in total or in part.
		Schema::create('consumption_events', function($table){
			$table->increments('id');
			$table->timestamp('occured_at');
			$table->unsignedInteger('target_subject_id');
			$table->string('target_subject_type');
			$table->string('description')->nullable();
			$table->float('ammount_consumed'); // kolkava frakcija e konzumirana
			$table->unsignedInteger('scale');	// kolku e celoto
			$table->unsignedInteger('transaction_id')->references('id')->on('transactions_records');
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
		Scheme::drop('consumption_events');
	}

}
