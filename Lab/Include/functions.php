<?php
/**
 * Created by PhpStorm.
 * User: Allen James
 * Date: 8/27/2016
 * Time: 7:17 PM
 */



function Redirect($url, $permanent = false)
{
    if (headers_sent() === false)
    {
        header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
    }

    exit();
}

function Timer($resource_link_id, $user_id, $timer_interval)
{
    include_once "../Model/Database.php";
    $timer = DateTime::createFromFormat("Y-m-d H:i:s",CheckTimer($resource_link_id, $user_id)[0], new DateTimeZone("America/Phoenix"));

    $interval = new DateInterval("PT" . $timer_interval . "M");

    $current_time = DateTime::createFromFormat("Y-m-d H:i:s", date('Y-m-d H:i:s'));
    $current_time->setTimezone(new DateTimeZone("America/Phoenix"));

    $timer_end = $timer->add($interval);

    $timer = $current_time->diff($timer_end);

    if($current_time > $timer_end)
    {
        return false;
    }
    else
    {
        return $timer;
    }
}