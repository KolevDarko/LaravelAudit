<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembershipChangesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('membership_changes', function($table){
			$table->increments('id');
			$table->timestamp('occured_at');
			$table->unsignedInteger('target_subject_id');
			$table->string('target_subject_type');
			$table->string('description');
			$table->string('membership_event_type'); // Added or Removed
			$table->string('membership_group_subject_type'); // The group being ADDED to or REMOVED from.
			$table->string('membership_group_subject_id');
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
		Schema::drop('membership_changes');
	}

}
