<?php
function redirect($url)
{
    header("Location: $url");
}

function isDate($date)
{
    /* 
        Function to check if a string follows date format
        Input: a string
        Output: True if it follows date format else False
    */
    $dt = DateTime::createFromFormat("Y-m-d", $date);
    return $dt !== false && !array_sum($dt::getLastErrors());
}

function calculateDaysBetween($currentDate, $laterDate)
{
    /* 
        Function to check calculate number of days between two days
        Input: 
            - $currentDate(DateTime)
            - $laterDate(DateTime)
        Output: number of days between
    */

    return $currentDate->diff($laterDate)->format("%r%a"); //3
}

function fileNameHash($file_name)
{
    $file_name = password_hash($file_name, PASSWORD_BCRYPT);
    return str_replace("/", "", $file_name);
}
