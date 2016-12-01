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

function GetTestCaseDetails($resource_link_id)
{
    $in_path = $_SERVER['DOCUMENT_ROOT'] ."/CSE110/Lab/Compile/"  . $resource_link_id. "/input/";

    $inputs = array_values(array_diff(scandir($in_path), array('.', '..')));

    $out_path = $_SERVER['DOCUMENT_ROOT'] ."/CSE110/Lab/Compile/"  . $resource_link_id . "/output/";

    $outputs = array_values(array_diff(scandir($out_path), array('.', '..')));

    $result = Array();

    for($i = 0; $i < count($inputs); $i++)
    {
        $result[$i]['name'] = "Test Case " . $i;
        $result[$i]['in'] = "../Compile/$resource_link_id/input/". $inputs[$i];
        $result[$i]['out'] = "../Compile/$resource_link_id/output/". $outputs[$i];
    }
    return $result;
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

