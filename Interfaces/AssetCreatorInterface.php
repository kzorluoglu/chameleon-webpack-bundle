<?php

namespace kzorluoglu\ChameleonWebpackBundle\Interfaces;

use kzorluoglu\ChameleonWebpackBundle\DataModel\AssetFile;
use Exception;

interface AssetCreatorInterface
{
    /**
     * @return AssetFile[]
     */
    public function getAssets(): array;

    /**
     * @param AssetFile $assetFile
     * @return string
     * @throws Exception
     */
    public function copy(AssetFile $assetFile): bool;
}
