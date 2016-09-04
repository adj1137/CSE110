<?php

/**
 * Created by PhpStorm.
 * User: Allen James
 * Date: 8/31/2016
 * Time: 6:38 PM
 */

class JavaHandler
{
    private $filename;
    private $input;
    private $output;
    private $CompileSuccess;

    public function JavaHandler($input)
    {
        $this->Compile($input);
        $this->Run();

    }

    private function FindFileName()
    {
        $clean = str_replace("\r", " ", $this->input);

        $input = explode(" ", $clean);

        return $input[2];
    }


    public function Compile($input)
    {
        $this->input = $input;
        $this->filename = $this->FindFileName();

        $JAVA_HOME = "/htdocs/JavaHandler/Compile/jdk1.8.0_102";
        $PATH = "$JAVA_HOME/bin:".getenv('PATH');
        putenv("JAVA_HOME=$JAVA_HOME");
        putenv("PATH=$PATH");

        $myfile = fopen("$this->filename.java", "w") or die("Unable to open file!");
        fwrite($myfile, $input);
        fclose($myfile);

        exec("C:/xampp/htdocs/JavaHandler/Compile/jdk1.8.0_102/bin/javac C:/xampp/htdocs/JavaHandler/Compile/$this->filename.java -d C:/xampp/htdocs/JavaHandler/Compile/ 2>&1", $this->output);

        echo var_dump($this->output);

        if($this->output == Array())
        {
            $this->CompileSuccess = TRUE;
        }
        else
        {
            $this->CompileSuccess = FALSE;
        }

    }
    public function Run()
    {

        if($this->CompileSuccess)
        {
           exec("C:/xampp/htdocs/JavaHandler/Compile/jdk1.8.0_102/bin/java $this->filename 2>&1", $this->output);
        }
        else
        {
            $this->output[count($this->output)] = "Java Run Error: File Did Not Compile Successfully. Please Compile and then Try To Run Again.";
        }

    }

    public function GetOutput()
    {
        return implode("\n", $this->output);
    }

    public function GetInput()
    {
        return $this->input;
    }
}