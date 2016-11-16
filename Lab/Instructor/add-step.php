<?php session_start();
include_once '../Include/functions.php';
include_once '../Model/Step.php';
/**
 * Created by PhpStorm.
 * User: Allen James
 * Date: 9/1/2016
 * Time: 7:18 PM
 */
include_once '../Model/Lab.php';
$lab = new Lab($_SESSION['resource_link_id']);
$step = $lab->addStep();
echo "<pre>" . var_dump($lab) . "</pre>";
$id = $step->getStepID();
//This is not the place to do this!!! This causes problems!
//$step->Save();
//Redirect('../Instructor/edit-step.php?step=' . $id);