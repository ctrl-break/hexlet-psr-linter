<?php

namespace HexletPsrLinter;

class FileInspector
{
    private $error = '';

    public function __construct($fileName)
    {
        if (file_exists($fileName)) {
            $file = new \SplFileInfo($fileName);

            if ($file->getExtension() !== 'php') {
                $this->error = 'File must have php extension';
            } else {
                $this->error = false;
            };
        } else {
            $this->error = "File doesn't exist";
        }
    }

    public function getError()
    {
        return $this->error;
    }
}
