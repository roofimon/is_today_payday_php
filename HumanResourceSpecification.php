<?php
class HumanResource{
	public $currentDate;
	function __construct(DateTime $currentDate){
		$this->currentDate = $currentDate;
	}
	
	function salaryIsPaid(){
		$day = $this->currentDate->format('j');
		if(25 == $day) {
			return "You are rich man";
		}else if(24 == $day){
			return "Tomorrow dude";
		}
	}
}

class HumanResourceSpecification extends PHPUnit_Framework_TestCase {
	function testTodayIsPayDay(){
		$expected = "You are rich man";
	  $mockCurrentDate = $this->getMock('DateTime', array('format'));
		$mockCurrentDate->expects($this->once())
		                 ->method('format')
										 ->with($this->equalTo('j'))
										 ->will($this->returnValue(25));
		$humanResource = new HumanResource($mockCurrentDate);
		$actual = $humanResource->salaryIsPaid();
		$this->assertEquals($expected, $actual);
	}
	
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
	/*
	function test23isFriday(){
		$expected = "22 days left";
		$date=23;
		$weekDay = "Friday";
		$humanResource = new HumanResource($date, $weekDay);
		$actual = $humanResource->salaryIsPaid();
		$this->assertEquals($expected, $actual);
	}*/
}