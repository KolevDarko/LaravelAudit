<?php

class AuditTest extends TestCase {

	var $sesija;

	 public function setUp()
	 {
	 	parent::setUp();
	 	
	 	$this->sesija = new Audit();

	 }

	public function testSessionRecord()
	{
  		Request::shouldReceive('server')->with("REMOTE_ADDR")->andReturn('1.2.3.4');
			
  		// $this->assertTrue($this->sesija->createSessionRecord(3,'Opis'));
  		$this->sesija->createSessionRecord(3, 'Opis');
  		$this->assertNotNull($this->sesija->sessionRecord);

  		$this->assertEquals(3,$this->sesija->sessionRecord->subject_id);
  		$this->assertEquals('Opis',$this->sesija->sessionRecord->subject_type);
  		$this->assertEquals('1.2.3.4',$this->sesija->sessionRecord->subject_address);
  		$this->assertEquals(date('Y-m-d H:i:s'),$this->sesija->sessionRecord->started_at);

  		$this->assertTrue($this->sesija->closeSessionRecord());
  		$this->assertNull($this->sesija->sessionRecord);
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