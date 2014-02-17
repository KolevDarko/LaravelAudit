<?php

class Membership_changes_record extends Eloquent{
	protected $table = 'membership_changes';

	public function transaction(){
		$this->belongsTo('Transaction_record', 'id', 'transaction_id');
	}
}