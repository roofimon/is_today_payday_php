<?php
require_once 'Payday.php';
class HumanResource{
	public $currentDate;
  public $payday;
	function __construct(Payday $payday, DateTime $currentDate){
    $this->payday = $payday;
		$this->currentDate = $currentDate;
	}
	
	function salaryIsPaid(){
    $currentDate = $this->currentDate->format('j');
    if($this->payday->getDate() === $currentDate) {
      return "You are rich man";
    }else if($this->payday->getDate() === $currentDate+1){
      return "Tomorrow dude";
    }else if($this->payday->getDate() > $currentDate){
      return $this->payday->getDate()-$currentDate." days left";
    }
  }
}

class HumanResourceSpecification extends PHPUnit_Framework_TestCase {
	function testTodayIsPayDay(){
		$expected = "You are rich man";
    $payday = new Payday(new DateTime(2014-8-25));
	  $mockCurrentDate = $this->getMock('DateTime', array('format'));
		$mockCurrentDate->expects($this->once())
		                 ->method('format')
										 ->with($this->equalTo('j'))
										 ->will($this->returnValue(25));

		$humanResource = new HumanResource($payday, $mockCurrentDate);
		$actual = $humanResource->salaryIsPaid();
		$this->assertEquals($expected, $actual);
	}

	function testTomorrowIsPayDay(){
		$expected = "Tomorrow dude";
    $payday = new Payday(new DateTime(2014-8-25));
	  $mockCurrentDate = $this->getMock('DateTime', array('format'));
		$mockCurrentDate->expects($this->once())
		                 ->method('format')
										 ->with($this->equalTo('j'))
										 ->will($this->returnValue(24));

		$humanResource = new HumanResource($payday, $mockCurrentDate);
		$actual = $humanResource->salaryIsPaid();
		$this->assertEquals($expected, $actual);
	}
	
	function test22DaysLeft(){
		$expected = "22 days left";
	  $mockCurrentDate = $this->getMock('DateTime', array('format'));
    $payday = new Payday(new DateTime(2014-8-25));
		$mockCurrentDate->expects($this->any())
		                 ->method('format')									 
                     ->with($this->equalTo('j'))
										 ->will($this->returnValue("3"));
		$humanResource = new HumanResource($payday, $mockCurrentDate);
		$actual = $humanResource->salaryIsPaid();
		$this->assertEquals($expected, $actual);
	}
}
