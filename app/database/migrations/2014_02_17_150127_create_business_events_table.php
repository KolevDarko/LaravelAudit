<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessEventsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('business_events', function($table){
			$table->increments('id');
			$table->timestamp('occured_at');
			$table->unsignedInteger('target_subject_id');
			$table->string('target_subject_type');
			$table->string('description');
			$table->string('business_class');
			$table->string('business_action');
			$table->unsignedInteger('transaction_id')->references('id')->on('transaction_records');
			
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
