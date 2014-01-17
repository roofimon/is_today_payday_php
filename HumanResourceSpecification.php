<?php
class HumanResource{
	public $date;
	function __construct($date){
		$this->date=$date;
	}
	function salaryIsPaid(){
		if($this->date==25){
			return "You are rich man";	
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
}