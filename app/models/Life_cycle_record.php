<?php

class Life_cycle_record extends Eloquent{
	protected $table = 'Life_cycle_events';

/*
Fields to populate: 
	occured_at:timestamp
	target_subject_id:int
	target_subject_type:varchar
	description:varchar
	life_cycle_event_type: varchar
	transaction_id: int
*/

	public function property_value_changes(){
		$this->hasMany('Property_changes_record', 'life_cycle_id', 'id');
	}

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
                'life_cycle_event_type'   => 'required',
                'transaction_id' => 'required|exists:transaction_records,id'
            )
        )->passes();
    }

}