<?php

class Membership_changes_record extends Eloquent{
	protected $table = 'membership_changes';

/*
Fields to populate: 
	occured_at:timestamp
	target_subject_id:int
	target_subject_type:varchar
	description:varchar
	membership_event_type: varchar
	membership_group_subject_type: varchar
	membership_group_subject_id: varchar
	transaction_id: int
*/

	public function transaction(){
		$this->belongsTo('Transaction_record', 'id', 'transaction_id');
	}

	// validation function that will get called on every creation and update
	public function isValid(){

        return Validator::make(
            $this->toArray(),
            array(
            	'occured_at'		-> 'required',
                'target_subject_id'  => 'required',
                'membership_event_type'   => 'required',
                'membership_group_subject_id'	=> 'required',
                'transaction_id' => 'required|exists:transaction_records,id'
            )
        )->passes();
    }

}