<?php

namespace kzorluoglu\ChameleonWebpackBundle\DataModel;

class CssFile
{
    private string $dirname;
    private string $basename;
    private string $extension;
    private string $filename;

    public function __construct(string $dirname, string $basename, string $extension, string $filename)
    {
        $this->dirname = $dirname;
        $this->basename = $basename;
        $this->extension = $extension;
        $this->filename = $filename;
    }

    public function getDirname(): string
    {
        return $this->dirname;
    }

    public function getBasename(): string
    {
        return $this->basename;
    }

    public function getExtension(): string
    {
        return $this->extension;
    }

    public function getFilename(): string
    {
        return $this->filename;
    }


}
