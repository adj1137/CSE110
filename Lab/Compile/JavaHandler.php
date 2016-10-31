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
        $this->input = $input;

    }

    private function FindFileName()
    {
        $clean = str_replace("\r", " ", $this->input);

        $input = explode(" ", $clean);

        return $input[2];
    }


    public function Compile()
    {
        $this->filename = $this->FindFileName();

        $JAVA_HOME = "/htdocs/CSE110/Lab/Compile/jdk1.8.0_102";
        $PATH = "$JAVA_HOME/bin:".getenv('PATH');
        putenv("JAVA_HOME=$JAVA_HOME");
        putenv("PATH=$PATH");

        $myfile = fopen($_SERVER['DOCUMENT_ROOT'] . "/CSE110/Lab/Compile/$this->filename.java", "w") or die("Unable to open file!");
        fwrite($myfile, $this->input);
        fclose($myfile);

        exec($_SERVER['DOCUMENT_ROOT'] . "/CSE110/Lab/Compile/jdk1.8.0_102/bin/javac " . $_SERVER['DOCUMENT_ROOT'] . "/CSE110/Lab/Compile/$this->filename.java -d " . $_SERVER['DOCUMENT_ROOT'] . "/CSE110/Lab/Compile/ 2>&1", $this->output);

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
           exec($_SERVER['DOCUMENT_ROOT'] ."/CSE110/Lab/Compile/jdk1.8.0_102/bin/java -cp " . $_SERVER['DOCUMENT_ROOT'] . "/CSE110/Lab/Compile/ $this->filename 2>&1", $this->output);
        }
        else
        {
            $this->output[count($this->output)] = "Java Run Error: File Did Not Compile Successfully. Please Compile and then Try To Run Again.";
        }

    }

    public function GetOutput()
    {
        echo "<pre>" . $this->output . "</pre>";
        return implode("\n", $this->output);
    }

    public function GetInput()
    {
        return $this->input;
    }
}