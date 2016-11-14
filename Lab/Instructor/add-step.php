<?php session_start();

include_once '../Include/functions.php';
include_once '../Model/Step.php';

/**
 * Created by PhpStorm.
 * User: Allen James
 * Date: 9/1/2016
 * Time: 7:18 PM
 */

echo "<pre>";
echo var_dump($_SESSION);
echo "</pre>";

include_once '../Model/Lab.php';

$lab = new Lab($_SESSION['resource_link_id']);

$step = $lab->addStep();

$id = $step->getStepID();

Redirect('../Instructor/edit-step.php?step=' . $id);

