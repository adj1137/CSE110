<?php session_start();
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

echo var_dump($lab->addStep());

header( 'Location: labview.php' ) ;
exit();
