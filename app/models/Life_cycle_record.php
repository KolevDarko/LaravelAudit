<?php

class Life_cycle_record extends Eloquent{
	protected $table = 'Life_cycle_events';

	public function property_value_changes(){
		$this->hasMany('Property_changes_record', 'life_cycle_id', 'id');
	}

	public function transaction(){
		$this->belongsTo('Transaction_record', 'id', 'transaction_id');
	}
}