<?php

class Transaction_record extends Eloquent {
	
	protected $table = 'transaction_record';

	public function session(){
		$this->belongsTo('Session_record', 'id', 'session_id');
	}

	public function life_cycle_events(){
		$this->hasMany('Life_cycle_record', 'transaction_id', 'id');
	}
}