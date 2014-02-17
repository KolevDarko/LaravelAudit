<?php

class Consumption_events_record extends Eloquent{
	protected $table = 'consumption_events';

	public function transaction(){
		$this->belongsTo('Transaction_record', 'id', 'transaction_id');
	}
}