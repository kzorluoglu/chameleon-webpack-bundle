<?php

namespace kzorluoglu\ChameleonWebpackBundle\Controller;

use kzorluoglu\ChameleonWebpackBundle\DataModel\AssetFile;
use kzorluoglu\ChameleonWebpackBundle\Interfaces\AssetCreatorInterface;
use Exception;

class AssetCreator implements AssetCreatorInterface
{

    private array $assetFiles = [];
    private string $rootDir;

    public function __construct(string $rootDir)
    {
        $this->rootDir = $rootDir;
    }

    /**
     * {@inheritDoc}
     */
    public function getAssets(): array
    {
        $sourceAbsolutePath = $this->getAbsolutePath();
        $assetFiles[] = new AssetFile('package.json', $sourceAbsolutePath, $this->rootDir);
        $assetFiles[] = new AssetFile('webpack.config.js', $sourceAbsolutePath, $this->rootDir);
        $assetFiles[] = new AssetFile('webpack.development.config.js', $sourceAbsolutePath, $this->rootDir);
        return $assetFiles;
    }

    /**
     * {@inheritDoc}
     */
    public function copy(AssetFile $assetFile): string
    {
        try {
            $sourceFile = $assetFile->getSourceAbsolutePath().'/'.$assetFile->getFileName();
            $targetFile = $assetFile->getTargetAbsolutePath().'/'.$assetFile->getFileName();
            copy($sourceFile, $targetFile);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    private function getAbsolutePath(): string
    {
        return $this->rootDir.'/../vendor/kzorluoglu';
    }
}
