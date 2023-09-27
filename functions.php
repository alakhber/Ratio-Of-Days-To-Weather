<?php
function setDaysAndDegree()
{
    $daysOfTheMonthWithTemperature = [];
    $daysOfMonth = date('t');
    for ($i = 1; $i <= $daysOfMonth; $i++) {
        $daysOfTheMonthWithTemperature[$i] = rand(7, 35);
    }

    return $daysOfTheMonthWithTemperature;
}
function ratioOfDaysToWeather($daysOfMonth, &$hotDays, &$checkDays, $currentDay = 1)
{
    $currentDegree = $daysOfMonth[$currentDay];
    $tmp = [];
    foreach ($daysOfMonth as  $day => $degree) {
        if (!in_array($day, $checkDays)) {
            $checkDays[] = $day;
            ratioOfDaysToWeather($daysOfMonth, $hotDays,  $checkDays, $day);
        }
        if ($currentDegree < $degree and $day > $currentDay) {
            $tmp[$day] = [
                'current_degree' => $degree,
                'diff_day' => $day - $currentDay,
                'diff_degree' => $degree - $currentDegree,
            ];
        }
    }
    ksort($hotDays);
    $hotDays[$currentDay] =  $tmp;
}
function showDaysByDegree($daysOfMonth)
{
    $daysOfMonth = array_chunk($daysOfMonth, 7, true);
    foreach ($daysOfMonth as $dayOfMonth) {
        foreach ($dayOfMonth as $day => $degree) {
            echo str_pad($day, 2, '0', STR_PAD_LEFT) . '<sup>' . str_pad($degree, 2, '0', STR_PAD_LEFT) . '&deg;</sup>' . ' ';
        }
        echo '<br>';
    }
    echo '<br>';
}
function showDetail($hotDays)
{
    foreach ($hotDays as $hDkey => $hDvalue) {
        if (count($hDvalue) > 0) {
            foreach ($hDvalue as $key => $value) {
                echo $hDkey . '-xx-xxxx Tarixdən ' . $value['diff_day'] . ' Gün Sonra Yəni ' . $key . '-xx-xxxx Tarixində Hava ' . $hDkey . '-xx-xxxx Tarixindəkinə Nisbətən ' . $value['diff_degree'] . '&deg;C İsti Olacaq Yəni Temperatur ' . $value['current_degree'] . '&deg;C  Olacaq <br>';
            }
            echo '<hr>';
        }
    }
}
