<?php

class Property_changes_record extends Eloquent{
	protected $table = 'property_value_changes';

	public function lyfe_cycle_event(){
		$this->belongsTo('Life_cycle_record', 'id', 'life_cycle_event_id');
	}
}