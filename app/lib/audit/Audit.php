<?php

class Audit{
	
	public  $sessionRecord;
	public  $transactionRecord;
	public  $lifeCycleEvent;
	public  $propertyRecord;
	public  $businessEvent;
	public  $membershipEvent;
	public  $consumptionEvent;

	public $object = null;

	function __construct(){	
	  $this->sessionRecord = null;
	  $this->transactionRecord = null;
	  $this->lifeCycleEvent = null;
	  $this->propertyRecord = null;
	  $this->businessEvent = null;
	  $this->membershipEvent = null;
	  $this->consumptionEvent = null;	
	}

	
//---- Session record 
	/**
	 * Create a new Session record.
	 *
	 * @param integer $userId
	 * @param mixed  $userType
	 *
	 * @return bool
	 */
	public function createSessionRecord($userId, $userType){
		// nekje da zacuvuva poradi not null constraint vo sqlite
		$this->sessionRecord = new Session_record();
		$this->sessionRecord->subject_id = $userId;
		$this->sessionRecord->subject_type = $userType;
		// $this->sessionRecord->subject_address =  $adress;
		$this->sessionRecord->subject_address =  Request::server('REMOTE_ADDR');
		$this->sessionRecord->started_at = date('Y-m-d H:i:s');
		$this->sessionRecord->ended_at = date('Y-m-d H:i:s');		
		$result = $this->sessionRecord->save();
		return $result;
	}
	/**
	* Close the Session record, write the end time.
	* @return bool
	*/
	public function closeSessionRecord(){
		$this->sessionRecord->ended_at = date('Y-m-d H:i:s');
		$result = $this->sessionRecord->save();
		$this->sessionRecord = null;
		return $result;
	}

//------ Transaction record
	/**
	 * Create a Transaction record.
	 * @return bool
	 */
	public function createTransactionRecord(){
		if(!is_null($this->sessionRecord)){
			$this->transactionRecord = new Transaction_record();
			$this->transactionRecord->started_at = date('Y-m-d H:i:s');;
			$this->transactionRecord->ended_at = date('Y-m-d H:i:s');

			$this->transactionRecord->session_id = $this->sessionRecord->id;
			$result = $this->transactionRecord->save();
			return $result;
		}else{
			return false;
		}
	}

	/**
	 * Close the Transaction record, write the end time.
	 * @return bool
	 */
	public function endTransactionRecord(){
		$this->transactionRecord->ended_at = date('Y-m-d H:i:s');
		$result = $this->transactionRecord->save();
		$this->transactionRecord = null;
		return $result;
	}
//------- Life Cycle Event record
	/**
	 * Create a Life Cycle Event record
	 * @param integer $subject_id The id of the subject affected
	 * @param mixed $subject_type The type of the subject affected
	 * @param string $event_type Create,Read,Update,Delete
	 * @param mixed $description Some description if needed
	 * @return bool
	 */
	public function createLifeCycleEvent($subject_id, $subject_type, $event_type, $description=''){
		// transaction record must be created beforehand
		if(!is_null($this->transactionRecord)){			
			$this->lifeCycleEvent = new Life_cycle_record();
			$this->lifeCycleEvent->transaction_id = $this->transactionRecord->id;
			$this->lifeCycleEvent->occured_at = date('Y-m-d H:i:s');
			$this->lifeCycleEvent->target_subject_id = $subject_id;
			$this->lifeCycleEvent->target_subject_type = $subject_type;
			$this->lifeCycleEvent->life_cycle_event_type = $event_type;
			$this->lifeCycleEvent->description = $description;
			$result = $this->lifeCycleEvent->save();
			return $result;
		}else{
			return false;
		}
	}
//-------- Property Value Change record
	/**
	 * Updated existing Property Value
	 * @param string $property_name The name of the property being updated.
	 * @param string $property_type The type of the property being updated.
	 * @param mixed $old_value The old value of the property.
	 * @param mixed $new_value The new value of the property.
	 * @return bool
	 */
	public function updatePropertyValue($property_name, $property_type, $old_value, $new_value){
		if(!is_null($this->lifeCycleEvent)){
			$this->propertyRecord = new Property_changes_record();
			$this->propertyRecord->property_type = $property_type;
			$this->propertyRecord->property_name = $property_name;
			
			$this->propertyRecord->new_value_specified = true;
			$this->propertyRecord->old_value_specified = true;

			$this->propertyRecord->new_value = $new_value;
			$this->propertyRecord->old_value = $old_value;

			$this->propertyRecord->life_cycle_event_id = $this->lifeCycleEvent->id;
			$result = $this->propertyRecord->save();
			return $result;
		}else{
			return false;
		}

	}
	/**
	 * Deleted Property Value
	 * @param string $property_name The name of the deleted property.
	 * @param string $property_type The type of the deleted property.
	 * @param mixed $old_value The old value of the deleted property.
	 * @return bool
	 */
	function deletePropertyValue($property_name, $property_type, $old_value){
		if(!is_null($this->lifeCycleEvent)){
			$this->propertyRecord = new Property_changes_record();
			$this->propertyRecord->property_type = $property_type;
			$this->propertyRecord->property_name = $property_name;
			
			$this->propertyRecord->new_value_specified = false;
			$this->propertyRecord->old_value_specified = true;

			$this->propertyRecord->new_value = '';
			$this->propertyRecord->old_value = $old_value;

			$this->propertyRecord->life_cycle_event_id = $this->lifeCycleEvent->id;
			$result = $this->propertyRecord->save();
			return $result;
		}else{
			return false;
		}
	}
	/**
	 * Created New Property
	 * @param string $property_name The name of the property.
	 * @param string $property_type The type of the property.
	 * @param mixed $new_value The value of the property.
	 * @return bool
	 */
	function createPropertyValue($property_name, $property_type, $new_value){
		if(!is_null($this->lifeCycleEvent)){
			$this->propertyRecord = new Property_changes_record();
			$this->propertyRecord->property_type = $property_type;
			$this->propertyRecord->property_name = $property_name;
			
			$this->propertyRecord->new_value_specified = true;
			$this->propertyRecord->old_value_specified = false;

			$this->propertyRecord->new_value = $new_value;
			$this->propertyRecord->old_value = '';

			$this->propertyRecord->life_cycle_event_id = $this->lifeCycleEvent->id;
			$result = $this->propertyRecord->save();
			return $result;
		}else{
			return false;
		}
	}
//-------- Business Event record
	/**
	 * Record of Business Event
	 * @param integer $target_subject_id The id of the affected subject
	 * @param string $target_subject_type The type of the affected subject
	 * @param mixed $description Description of the event
	 * @param mixes $business_class In which business class is this event
	 * @param mixed $business_action Which business action occured
	 * @return bool
	 */
	function createBusinessEvent($target_subject_id, $target_subject_type, $description, $business_class='', $business_action=''){
		// transaction record must be created beforehand
		if(!is_null($this->transactionRecord)){			
			$this->businessEvent = new Business_events_record();
			$this->businessEvent->transaction_id = $this->transactionRecord->id;
			$this->businessEvent->occured_at = date('Y-m-d H:i:s');
			$this->businessEvent->target_subject_id = $target_subject_id;
			$this->businessEvent->target_subject_type = $target_subject_type;
			$result = $this->businessEvent->save();
			return $result;
		}else{
			return false;
		}
	}
//---------- Consumption event record
	/**
	 * Description
	 * @param type $target_subject_id 
	 * @param type $target_subject_type 
	 * @param type $ammount_consumed 
	 * @param type $scale 
	 * @param type $description 
	 * @return type
	 */
	function createConsumptionEvent($target_subject_id, $target_subject_type, $ammount_consumed, $scale, $description){
		if(!is_null($this->transactionRecord)){
			$this->consumptionEvent = new Consumption_events_record();
			$this->consumptionEvent->occured_at = date('Y-m-d H:i:s');
			$this->consumptionEvent->target_subject_id = $target_subject_id;
			$this->consumptionEvent->target_subject_type = $target_subject_type;
			$this->consumptionEvent->description = $description;
			$this->consumptionEvent->ammount_consumed = $ammount_consumed;
			$this->consumptionEvent->scale = $scale;
			$this->consumptionEvent->transaction_id = $this->transactionRecord->id;
			$result = $this->consumptionEvent->save();
			return $result;
		}else{
			return false;
		}
	}
	/**
	 * Create Membership Changed Record
	 * @param integer $target_subject_id The id of the subject
	 * @param string $target_subject_type The type of the subject
	 * @param mixed $description Description of the event
	 * @param string $membership_event_type The type of the event: Added or Deleted
	 * @param string $membership_group_subject_type The type of the group
	 * @param integer $membership_group_subject_id The id of the group
	 * @return bool
	 */
	public function createMembershipEvent($target_subject_id, $target_subject_type, $description, $membership_event_type, $membership_group_subject_type, $membership_group_subject_id){
		if(!is_null($this->transactionRecord)){
			$this->membershipEvent = new Membership_changes_record();
			$this->membershipEvent->transaction_id = $this->transactionRecord->id;
			$this->membershipEvent->occured_at = date('Y-m-d H:i:s');
			$this->membershipEvent->target_subject_id = $target_subject_id;
			$this->membershipEvent->target_subject_type = $target_subject_type;
			$this->membershipEvent->description = $description;
			$this->membershipEvent->membership_event_type = $membership_event_type;
			$this->membershipEvent->membership_group_subject_type = $membership_group_subject_type;
			$this->membershipEvent->membership_group_subject_id = $membership_group_subject_id;
			$result = $this->membershipEvent->save();
			return $result;
		}else{
			return false;
		}
	}


}