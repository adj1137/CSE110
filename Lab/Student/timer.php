<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Allen
 * Date: 11/14/2016
 * Time: 10:56 AM
 */
include "../Model/Database.php";

if(CheckTimer($_SESSION['resource_link_id'], $_SESSION['user_id']))
{
    Redirect('../labview.php');
}
else
{
    StartTimer($_SESSION['resource_link_id'], $_SESSION['user_id']);
    Redirect('../labview.php');
}