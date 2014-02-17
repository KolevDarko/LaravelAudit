<?php

class Session_record extends Eloquent {
	protected $table = 'session_records';
	
	public function transactions(){
					// imeto na tabelata     foreign key   local key
		$this->hasMany('Transaction_record', 'session_id', 'id');
	}
}