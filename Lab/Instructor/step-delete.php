<?php
session_start();
include_once "../Model/Lab.php";

$step = $_GET['step'];


/**
 * Created by PhpStorm.
 * User: Allen James
 * Date: 9/1/2016
 * Time: 10:28 PM
 */

$Lab = new Lab($_SESSION['resource_link_id']);

$Lab->removeStep($step);