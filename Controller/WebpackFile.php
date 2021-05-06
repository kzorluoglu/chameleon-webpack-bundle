<?php

namespace kzorluoglu\ChameleonWebpackBundle\Controller;

use Exception;
use kzorluoglu\ChameleonWebpackBundle\Interfaces\WebpackFileInterface;

class WebpackFile implements WebpackFileInterface
{

    private string $rootDir;

    public function __construct(string $rootDir)
    {
        $this->rootDir = $rootDir;
    }

    public function getJsFile(string $entryName): string
    {
       return $this->generateScriptTagForEntry($entryName);
    }

    public function getCssFile(string $entryName)
    {
        // TODO: Implement getCssFiles() method.
    }

    private function getCompiledJsFile($entryName): ?array
    {
        $jsFiles = [];
        foreach(glob($this->rootDir.'/../web/build/'.$entryName.'*.js') as $jsFile) {
            $jsFiles[] = $jsFile;
        }

        if (0 === \count($jsFile)) {
            return null;
        }

        return $jsFiles;
    }

    /**
     * @throws Exception
     */
    private function generateScriptTagForEntry(string $entryName): string
    {
        if(null === ($jsFile = $this->getCompiledJsFile($entryName))){
            throw new Exception(sprintf('We can\'t find any js file for Entry :%s', $entryName));
        }

        return sprintf('<script type="text/javascript" src="build/%s"></script>', $jsFile);
    }
}
