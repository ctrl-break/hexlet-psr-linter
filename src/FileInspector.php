<?php

namespace HexletPsrLinter;

class FileInspector
{
    private $error = '';
    private $code = '';

    public function __construct($filename)
    {
        if (file_exists($filename)) {
            $file = new \SplFileInfo($filename);

            if ($file->getExtension() !== 'php') {
                $this->error = 'File must have php extension';
            } else {
                $this->error = false;
                $this->code = file_get_contents($filename);
            };
        } else {
            $this->error = "File doesn't exist";
        }
    }

    public function getError()
    {
        return $this->error;
    }

    public function getCode()
    {
        return $this->code;
    }
}
