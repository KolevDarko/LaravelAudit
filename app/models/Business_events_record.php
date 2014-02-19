<?php

class Business_events_record extends Eloquent{
	protected $table = 'business_events';

/*
Fields to populate: 
	occured_at: timestamp
	target_subject_id: int
	target_subject_type: varchar
	description: varchar
	business_class: varchar
	business_action: varchar
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
            	'occured_at'		=> 'required',
                'target_subject_id'  => 'required',
                'business_action'   => 'required',
                'transaction_id' => 'required|exists:transaction_records,id'
                
            )
        )->passes();
    }


}