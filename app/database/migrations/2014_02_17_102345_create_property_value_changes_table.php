<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertyValueChangesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// A record of a change in a property value.
		Schema::create('property_value_changes', function($table){
			$table->increments('id');
			$table->string('property_type');
			$table->string('property_name');
			$table->boolean('new_value_specified');
			$table->boolean('old_value_specified');
			$table->string('new_value');
			$table->string('old_value');
			$table->unsignedInteger('life_cycle_audit_event')->references('id')->on('lyfe_cycle_events');
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
		Schema::drop('property_value_changes');
	}

}
