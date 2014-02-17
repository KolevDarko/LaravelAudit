<?php

class Business_events_record extends Eloquent{
	protected $table = 'business_events';

	public function transaction(){
		$this->belongsTo('Transaction_record', 'id', 'transaction_id');
	}
}