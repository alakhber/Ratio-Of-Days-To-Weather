<?php
require_once './functions.php';
$hotDays = [];
$checkDays = [];
$daysOfMonth = setDaysAndDegree();


setDaysAndDegree($daysOfMonth);
showDaysByDegree($daysOfMonth);
ratioOfDaysToWeather($daysOfMonth, $hotDays, $checkDays);
showDetail($hotDays);
