<?php

class Audit{
	
	protected $sessionRecord = '';
	protected $transactionRecords = array();
	protected $lifeCycleEvents = array();
	protected $propertyValueChanges = array();

	public static function createSessionRecord($userId, $userType){

		$sessionRecord = new Session_record();
		$sessionRecord->subject_id = $userId;
		$sessionRecord->subject_type = $userType;
		$sessionRecord->subject_address =  $_SERVER['REMOTE_ADDR'];
		$sessionRecord->started_at = date('Y-m-d H:i:s');
		$sessionRecord->save();
	}

	public static function closeSessionRecord(){
		$this->sessionRecord->ended_at = date('Y-m-d H:i:s');
		$this->sessionRecord->save();
	}

	function createTransactionRecord(){

		
	}

	function lifeCycleEvent(){

	}

	function updatePropertyValue($old, $new){}

	function deletePropertyValue(){}
	function createPropertyValue(){}

	function businessEvent(){}
	function consumptionEvent(){}

	function membershipEvent(){}




}