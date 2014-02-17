<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLifeCycleEventsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void	 
	 */
	public function up()
	{
		Schema::create('lyfe_cycle_events', function($table){
			$table->increments('id');
			$table->timestamp('occured_at');
			$table->string('target_subject_type');
			$table->unsignedInteger('target_subject_id');
			$table->string('description')->nullable();
			$table->string('life_cycle_event_type');
			$table->unsignedInteger('transaction_id')->references('id')->on('transaction_records');
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
		Schema::drop('life_cycle_events');
	}
}
