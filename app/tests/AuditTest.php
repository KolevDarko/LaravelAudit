<?php

class AuditTest extends TestCase {


	public function testCreateSessionRecord()
	{
		// set up

  		Request::shouldReceive('server')->with("REMOTE_ADDR")->andReturn('1.2.3.4');
  		$sesija = new Audit();
  		
		//test

  		
  		$this->assertTrue($sesija->createSessionRecord(3,'Opis'));
  		$this->assertNotNull($sesija->sessionRecord);

  		$this->assertEquals(3,$sesija->sessionRecord->subject_id);
  		$this->assertEquals('Opis',$sesija->sessionRecord->subject_type);
  		$this->assertEquals('127.0.0.1',$sesija->sessionRecord->subject_address);
  		$this->assertEquals(date('Y-m-d H:i:s'),$sesija->sessionRecord->started_at); 
	}

	// public function testCreateTransactionRecord(){
	// 	$sesija = new Audit();
 //  		$sesija->createSessionRecord(3,'Opis','Kocani');
 //  		$this->action()
 //  		$this->action('GET',"", [], [], [], ["REMOTE_ADDR"=>'1.2.3.4'])
 //  		$this->assertTrue($sesija->createTransactionRecord());
 //  		$this->assertNotNull($sesija->transactionRecord);

	// }
}