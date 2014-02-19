<?php

class Consumption_events_record extends Eloquent{
	protected $table = 'consumption_events';

/*
Fields to populate: 
	occured_at:timestamp
	target_subject_id:int
	target_subject_type:varchar
	description:varchar
	ammount_consumed: float
	scale: int
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
                'business_action'   => 'required',
                'ammount_consumed'	=> 'required',
                'transaction_id' => 'required|exists:transaction_records,id'
            )
        )->passes();
    }



}