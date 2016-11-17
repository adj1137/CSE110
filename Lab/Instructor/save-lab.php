<?php
session_start();
include_once "../Model/Lab.php";
include_once "../Include/functions.php";

if(isset($_POST['save']))
{
    $Lab = new Lab($_SESSION['resource_link_id']);

    $Lab->setOpenDate($_POST['open_date']);

    $Lab->setDueDate($_POST['due_date']);

    $Lab->setTimerVal($_POST['alotted_time']);

    $Lab->save();

    Redirect("index.php");

}

?>