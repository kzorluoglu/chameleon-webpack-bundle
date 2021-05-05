<?php

namespace  kzorluoglu\ChameleonWebpackBundle\DataModel;

class AssetFile
{
    private string $fileName;
    private string $sourceAbsolutePath;
    private string $targetAbsolutePath;

    public function __construct(string $fileName, string $sourceAbsolutePath, string $targetAbsolutePath)
    {
        $this->fileName = $fileName;
        $this->sourceAbsolutePath = $sourceAbsolutePath;
        $this->targetAbsolutePath = $targetAbsolutePath;
    }

    public function getFileName(): string
    {
        return $this->fileName;
    }

    public function getSourceAbsolutePath(): string
    {
        return $this->sourceAbsolutePath;
    }

    public function getTargetAbsolutePath(): string
    {
        return $this->targetAbsolutePath;
    }

}
