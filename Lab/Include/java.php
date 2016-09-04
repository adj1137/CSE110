<?php
/**
 * Created by PhpStorm.
 * User: Allen James
 * Date: 8/27/2016
 * Time: 9:23 PM
 */
class Java {

    private $output;

    public function CompileJavaCode($user, $file, $code)
    {
        $f = fopen('../Workspace/'. $user . '/'.$file, "w");

        fwrite($f, $code);

        fclose($f);

        $JavaPath = "C:/Program Files/Java/jdk1.8.0_102/bin/";
        $ClassPath = "C:/xampp/htdocs/tsugi/mod/Lab/Workspace/". $user . '/'.$file;

        return shell_exec($JavaPath.'javac -classpath ' . $ClassPath );
    }

}

