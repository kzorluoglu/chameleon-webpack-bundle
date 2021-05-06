<?php

namespace kzorluoglu\ChameleonWebpackBundle\Interfaces;

interface WebpackFileInterface
{
    public function getJsFile(string $entryName);

    public function getCssFile(string $entryName);
}
