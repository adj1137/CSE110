<?php
/**
 * Created by PhpStorm.
 * User: Allen
 * Date: 11/13/2016
 * Time: 11:36 AM
 */
include_once 'Database.php';

$lab = SaveLab("Resource", "1,2", "10-10-1993", "10-10-1993", 120);
echo $lab;