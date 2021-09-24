<?php

function hariIndo()
{
    $today = date('l');
    if ($today == 'Sunday') {
        $day = 'Minggu';
    } elseif ($today == 'Monday') {
        $day = 'Senin';
    } elseif ($today == 'Tuesday') {
        $day = 'Selasa';
    } elseif ($today == 'Wednesday') {
        $day = 'Rabu';
    } elseif ($today == 'Thursday') {
        $day = 'Kamis';
    } elseif ($today == 'Friday') {
        $day = 'Jum\'at';
    } else {
        $day = 'Sabtu';
    }

    return $day;
}