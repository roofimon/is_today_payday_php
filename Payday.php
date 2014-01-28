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

