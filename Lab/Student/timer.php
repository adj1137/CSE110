<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Allen
 * Date: 11/14/2016
 * Time: 10:56 AM
 */
include_once '../Include/functions.php';
include "../Model/Database.php";
include "../Model/Lab.php";

//Create Lab Object to Check all times
$lab = new Lab($_SESSION['resource_link_id']);
//Get $due_date and $open_date DateTime objects from lab's due_date and open_date fields
$due_date = DateTime::createFromFormat("Y-m-d H:i:s", $lab->getDueDate());
$open_date = DateTime::createFromFormat("Y-m-d H:i:s", $lab->getOpenDate());
//Check if current time is past due date
if($due_date < new DateTime())
{
    Redirect('../Student/lab-past-due.php');
}//Check if current time is before open date
elseif($open_date > new DateTime())
{
    Redirect('../Student/lab-not-open.php');
}
//Attempt to create timer object from Timer Database Records
$timer = DateTime::createFromFormat("Y-m-d H:i:s",CheckTimer($_SESSION['resource_link_id'], $_SESSION['user_id'])[0]);

if($timer) //If the timer object was found
{
    $interval = new DateInterval("PT" . $lab->getTimerVal() . "M");

    $current_time = DateTime::createFromFormat("Y-m-d H:i:s", date('Y-m-d H:i:s'));
    $current_time->setTimezone(new DateTimeZone("America/Phoenix"));

    $timer_end = $timer->add($interval);

    $difference = $current_time->diff($timer_end);
    if($difference->h <= 0 && $difference->m <= 0 && $difference->s <= 0) //Time is up!
    {
        Redirect('../Student/time-up.php');
    }
    else //There is still time remaining
    {
        Redirect('../Student/labview.php');
    }
}
else // Create a new time object
{
    echo StartTimer($_SESSION['resource_link_id'], $_SESSION['user_id']);
    Redirect('../Student/labview.php');
}