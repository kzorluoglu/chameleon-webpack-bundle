<?php

namespace kzorluoglu\ChameleonWebpackBundle\Interfaces;

use kzorluoglu\ChameleonWebpackBundle\DataModel\AssetFile;

interface AssetCreatorInterface
{
    /**
     * @return AssetFile[]
     */
    public function getAssets(): array;

    public function copy(AssetFile $assetFile): string;
}
