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

$timer = DateTime::createFromFormat("Y-m-d H:i:s",CheckTimer($_SESSION['resource_link_id'], $_SESSION['user_id'])[0]);
echo var_dump($timer);
if($timer)
{
    $lab = new Lab($_SESSION['resource_link_id']);

    $interval = new DateInterval("PT" . $lab->getTimerVal() . "M");

    $current_time = DateTime::createFromFormat("Y-m-d H:i:s", date('Y-m-d H:i:s'));
    $current_time->setTimezone(new DateTimeZone("America/Phoenix"));

    $timer_end = $timer->add($interval);

    echo var_dump($current_time->diff($timer_end));

    if($current_time->diff($timer_end) < 0)
    {
        Redirect('../Student/time-up.php');
    }
    else
    {
        Redirect('../Student/labview.php');
    }
    echo var_dump($current_time);
}
else
{
    echo StartTimer($_SESSION['resource_link_id'], $_SESSION['user_id']);
    Redirect('../Student/labview.php');
}