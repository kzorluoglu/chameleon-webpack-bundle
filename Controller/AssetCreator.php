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
        $targetAbsolutePath = $this->rootDir."/..";
        $assetFiles[] = new AssetFile('package.json', $sourceAbsolutePath, $targetAbsolutePath);
        $assetFiles[] = new AssetFile('webpack.config.js', $sourceAbsolutePath, $targetAbsolutePath);
        $assetFiles[] = new AssetFile('webpack.development.config.js', $sourceAbsolutePath, $targetAbsolutePath);
        return $assetFiles;
    }

    /**
     * {@inheritDoc}
     */
    public function copy(AssetFile $assetFile): bool
    {
        $sourceFile = $assetFile->getSourceAbsolutePath().'/'.$assetFile->getFileName();
        $targetFile = $assetFile->getTargetAbsolutePath().'/'.$assetFile->getFileName();

        try {
            return copy($sourceFile, $targetFile);
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode(), $e);
        }
    }

    private function getAbsolutePath(): string
    {
        return $this->rootDir.'/../vendor/kzorluoglu/chameleon-webpack-bundle';
    }
}
