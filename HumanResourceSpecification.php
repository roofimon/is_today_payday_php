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
    $actualPaydate = $this->payday->getDate();
    $actualPayday = $this->payday->getDay();
    $tomorrow = $currentDate+1;

    if($actualPaydate === $currentDate) {
      return "You are rich man";
    }else if($actualPaydate === $tomorrow){
      return "Tomorrow dude";
    }else if($actualPaydate > $currentDate){
      return $actualPaydate-$currentDate." days left and ".$actualPayday." ".$actualPaydate." is payday";
    }else{
      return "already paid dude.";
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
    $expected = "22 days left and Thursday 25 is payday";
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

  function test3DaysLeftAndFridayIsPayday(){
    $expected = "3 days left and Friday 23 is payday";
    $mockCurrentDate = $this->getMock('DateTime', array('format'));
    $payday = new Payday(new DateTime(2014-5-25));
    $mockCurrentDate->expects($this->any())
                    ->method('format')
                    ->with($this->equalTo('j'))
                    ->will($this->returnValue("20"));
    $humanResource = new HumanResource($payday, $mockCurrentDate);
    $actual = $humanResource->salaryIsPaid();
    $this->assertEquals($expected, $actual);
  }

  function testAlreadyPaidForThisMonth() {
    $expected = "already paid dude.";
    $mockCurrentDate = $this->getMock('DateTime', array('format'));
    $payday = new Payday(new DateTime(2014-5-25));
    $mockCurrentDate->expects($this->any())
                    ->method('format')
                    ->with($this->equalTo('j'))
                    ->will($this->returnValue("26"));
    $humanResource = new HumanResource($payday, $mockCurrentDate);
    $actual = $humanResource->salaryIsPaid();
    $this->assertEquals($expected, $actual);
  }
}
