<?php

class Transaction_record extends Eloquent {
	protected $table = 'transaction_record';
/*
Fields to populate: 
	started_at: timestamp
	ended_at: timestamp
	session_id: int
*/
	public function session(){
		$this->belongsTo('Session_record', 'id', 'session_id');
	}

	public function life_cycle_events(){
		$this->hasMany('Life_cycle_record', 'transaction_id', 'id');
	}

	public function business_events(){
		$this->hasMany('Business_events_record', 'transaction_id', 'id');

	}

	public function consumption_events(){
		$this->hasMany('Consumption_events_record', 'transaction_id', 'id');
	}

	public function membership_events(){
		$this->hasMany('Membership_changes_record', 'transaction_id', 'id');
	}

	
}	
