<?php
class Payday{
  private $payWeekday;
  private $paydate;
  function __construct(DateTime $payday){
    $this->payday = $payday;
    $weekday = $this->payday->format('w'); 
    $this->paydate = 25;
    if($weekday == 1){
      $this->payWeekday =  "Monday";
    }else if($weekday == 2){
      $this->payWeekday = "Tuesday";
    }else if($weekday == 3){
      $this->payWeekday = "Wednesday";
    }else if($weekday == 4){
      $this->payWeekday = "Thursday";
    }else if($weekday == 5){
      $this->payWeekday = "Friday";
    }else if($weekday == 6){
      $this->payWeekday =  "Friday";
      $this->paydate = 24;
    }else if($weekday == 0){
      $this->payWeekday =  "Friday";
      $this->paydate = 23;
    }
  }

  function getDay(){
    return $this->payWeekday;
  }

  function getDate(){
    return $this->paydate;
  }
}

class PaydaySpecification extends PHPUnit_Framework_TestCase{
  function testPaydayIsOnMondayWorkingDay(){
    $expected = "Monday,25";
    $payday = new DateTime('2014-8-25');
    $actualPayday = new Payday($payday);
    $day  = $actualPayday->getDay();
    $date = $actualPayday->getDate();
    $this->assertEquals($expected, $day.','.$date);
  }
  function testPaydayIsOnTuesdayWorkingDay(){
    $expected = "Tuesday,25";
    $payday = new DateTime('2014-2-25');
    $actualPayday = new Payday($payday);
    $day  = $actualPayday->getDay();
    $date = $actualPayday->getDate();
    $this->assertEquals($expected, $day.','.$date);
  }
  function testPaydayIsOnWednesdayWorkingDay(){
    $expected = "Wednesday,25";
    $payday = new DateTime('2014-6-25');
    $actualPayday = new Payday($payday);
    $day  = $actualPayday->getDay();
    $date = $actualPayday->getDate();
    $this->assertEquals($expected, $day.','.$date);
  }
  function testPaydayIsOnthursdayWorkingDay(){
    $expected = "Thursday,25";
    $payday = new DateTime('2014-9-25');
    $actualPayday = new Payday($payday);
    $day  = $actualPayday->getDay();
    $date = $actualPayday->getDate();
    $this->assertEquals($expected, $day.','.$date);
  }
  function testPaydayIsOnFridayWorkingDay(){
    $expected = "Friday,25";
    $payday = new DateTime('2014-7-25');
    $actualPayday = new Payday($payday);
    $day  = $actualPayday->getDay();
    $date = $actualPayday->getDate();
    $this->assertEquals($expected, $day.','.$date);
  }
  function testPaydayIsOnSaturdaySoActualPaydayShouldShiftToFriday(){
    $expected = "Friday,24";
    $payday = new DateTime('2014-1-25');
    $actualPayday = new Payday($payday);
    $day  = $actualPayday->getDay();
    $date = $actualPayday->getDate();
    $this->assertEquals($expected, $day.','.$date);
  }
  function testPaydayIsOnSundaySoActualPaydayShouldShiftToFriday(){
    $expected = "Friday,23";
    $payday = new DateTime('2014-5-25');
    $actualPayday = new Payday($payday);
    $day  = $actualPayday->getDay();
    $date = $actualPayday->getDate();
    $this->assertEquals($expected, $day.','.$date);
  }
}
