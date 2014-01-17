<?php
class HumanResource{
	public $date;
	public $weekDay;
	function __construct($date,$weekDay=false){
		$this->date=$date;
		if(false !== $weekDay) {
			$this->weekDay = $weekDay;	
		}
	}
	function salaryIsPaid(){
		if($this->date==25){
			return "You are rich man";	
		}else if($this->date == 23 && $this->weekDay == "Friday") {
			return "22 days left";
		}
		return "Tomorrow dude";
	}
}

class HumanResourceSpecification extends PHPUnit_Framework_TestCase {
	function testTodayIsPayDay(){
		$expected = "You are rich man";
		$date=25;
		$humanResource = new HumanResource($date);
		$actual = $humanResource->salaryIsPaid();
		$this->assertEquals($expected, $actual);
	}
	
	function testTomorrowIsPayDay(){
		$expected = "Tomorrow dude";
		$date=24;
		$humanResource = new HumanResource($date);
		$actual = $humanResource->salaryIsPaid();
		$this->assertEquals($expected, $actual);
	}
	
	function test23isFriday(){
		$expected = "22 days left";
		$date=23;
		$weekDay = "Friday";
		$humanResource = new HumanResource($date, $weekDay);
		$actual = $humanResource->salaryIsPaid();
		$this->assertEquals($expected, $actual);
	}
}