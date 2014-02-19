<?php

class Session_record extends Eloquent {
	protected $table = 'session_records';
/*
Fields to populate: 
	started_at: timestamp
	ended_at: timestamp
	subject_id: int
	subject_type: varchar
	subject_address: varchar
*/
	public function transactions(){
					// imeto na tabelata     foreign key   local key
		$this->hasMany('Transaction_record', 'session_id', 'id');
	}
}