<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Allen
 * Date: 11/14/2016
 * Time: 10:56 AM
 */
include_once '../Lab/Include/functions.php';
include "../Model/Database.php";

if(CheckTimer($_SESSION['resource_link_id'], $_SESSION['user_id']))
{
    Redirect('../Student/labview.php');
}
else
{
    StartTimer($_SESSION['resource_link_id'], $_SESSION['user_id']);
    Redirect('../Student/labview.php');
}