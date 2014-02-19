<?php

class Property_changes_record extends Eloquent{
	protected $table = 'property_value_changes';
/*
Fields to populate: 
	property_type: varchar
	property_name: varchar
	new_value_specified: boolean
	old_value_specified: boolean
	new_value: varchar
	old_value: varchar
	life_cycle_event_id: int
*/
	public function lyfe_cycle_event(){
		$this->belongsTo('Life_cycle_record', 'id', 'life_cycle_event_id');
	}
}