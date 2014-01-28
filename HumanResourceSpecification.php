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
		$day = $this->currentDate->format('j');
		if($this->payday->getDate() === $day) {
			return "You are rich man";
		}else if(24 === $day){
			return "Tomorrow dude";
		}else if(1 === $day){
			return "24 days left";
		}else {
      $weekDay = $this->currentDate->format('j-w');
      if(("23-5" === $weekDay)||("1-4" === $weekDay)){
        return "22 days left";
      }else if(("24-5" === $weekDay)||("1-3" === $weekDay)){
        return "23 days left";
      }
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
/*	
	function testTomorrowIsPayDay(){
		$expected = "Tomorrow dude";
	  $mockCurrentDate = $this->getMock('DateTime', array('format'));
		$mockCurrentDate->expects($this->once())
		                 ->method('format')
										 ->with($this->equalTo('j'))
										 ->will($this->returnValue(24));
		$humanResource = new HumanResource($mockCurrentDate);
		$actual = $humanResource->salaryIsPaid();
		$this->assertEquals($expected, $actual);
	}
	
	function test23isFriday(){
		$expected = "22 days left";
	  $mockCurrentDate = $this->getMock('DateTime', array('format'));
		$mockCurrentDate->expects($this->any())
		                 ->method('format')									 
										 ->will($this->returnValue("23-5"));
		$humanResource = new HumanResource($mockCurrentDate);
		$actual = $humanResource->salaryIsPaid();
		$this->assertEquals($expected, $actual);
	}
	
	function test24isFriday(){
		$expected = "23 days left";
	  $mockCurrentDate = $this->getMock('DateTime', array('format'));
		$mockCurrentDate->expects($this->any())
		                 ->method('format')									 
										 ->will($this->returnValue("24-5"));
		$humanResource = new HumanResource($mockCurrentDate);
		$actual = $humanResource->salaryIsPaid();
		$this->assertEquals($expected, $actual);
	}
	
	function test1isToday(){
		$expected = "24 days left";
	  $mockCurrentDate = $this->getMock('DateTime', array('format'));
		$mockCurrentDate->expects($this->any())
		                 ->method('format')									 
										 ->will($this->returnValue(1));
		$humanResource = new HumanResource($mockCurrentDate);
		$actual = $humanResource->salaryIsPaid();
		$this->assertEquals($expected, $actual);
	}
	
	function test1isTodayAnd23Friday(){
		$expected = "22 days left";
	  $mockCurrentDate = $this->getMock('DateTime', array('format'));
		$mockCurrentDate->expects($this->any())
		                 ->method('format')									 
										 ->will($this->returnValue('1-4'));
		$humanResource = new HumanResource($mockCurrentDate);
		$actual = $humanResource->salaryIsPaid();
		$this->assertEquals($expected, $actual);
	}
	
	function test1isTodayAnd24Friday(){
		$expected = "23 days left";
	  $mockCurrentDate = $this->getMock('DateTime', array('format'));
		$mockCurrentDate->expects($this->any())
		                 ->method('format')									 
										 ->will($this->returnValue('1-3'));
		$humanResource = new HumanResource($mockCurrentDate);
		$actual = $humanResource->salaryIsPaid();
		$this->assertEquals($expected, $actual);
	}
 */
}
