<?php
require_once 'Payday.php';
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
