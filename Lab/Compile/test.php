<?php
/**
 * Created by PhpStorm.
 * User: Allen
 * Date: 11/7/2016
 * Time: 11:29 AM
 */

include "JavaHandler.php";

$code = "import java.util.*; 
        public class Test {
            public static void main(String[] args){
            Scanner sc = new Scanner(System.in);
            System.out.println(sc.nextLine());
            }
        }";
$java = new JavaHandler($code);

$java->setResourceLinkID("142");
$java->setUserID("123456");

$java->Compile();

$java->Run("input1.txt");

echo $java->GetOutput();

