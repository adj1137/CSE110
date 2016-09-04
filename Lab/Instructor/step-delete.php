<?php
session_start();
include_once "../Model/Step.php";
$step = $_GET['step'];

echo DeleteStep($step);

/**
 * Created by PhpStorm.
 * User: Allen James
 * Date: 9/1/2016
 * Time: 10:28 PM
 */