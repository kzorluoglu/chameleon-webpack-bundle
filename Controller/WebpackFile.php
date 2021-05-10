<?php

namespace kzorluoglu\ChameleonWebpackBundle\Controller;

use Exception;
use kzorluoglu\ChameleonWebpackBundle\DataModel\JsFile;
use kzorluoglu\ChameleonWebpackBundle\Interfaces\WebpackFileInterface;

class WebpackFile implements WebpackFileInterface
{

    private string $rootDir;

    public function __construct(string $rootDir)
    {
        $this->rootDir = $rootDir;
    }

    /**
     * @throws Exception
     */
    public function getJsFile(string $entryName): string
    {
       return $this->generateScriptTagForEntry($entryName);
    }

    public function getCssFile(string $entryName)
    {
        // TODO: Implement getCssFiles() method.
    }

    /**
     * @param string $entryName
     * @return JsFile[]|null
     */
    private function getCompiledJsFile(string $entryName): ?array
    {
        $jsFiles = [];
        foreach(glob($this->rootDir.'/../web/build/'.$entryName.'*.js') as $jsFile) {
            $fileInfo = pathinfo($jsFile);
            $jsFiles[] = new JsFile($fileInfo['dirname'], $fileInfo['basename'], $fileInfo['extension'], $fileInfo['filename']);
        }

        if (0 === \count($jsFiles)) {
            return null;
        }

        return $jsFiles;
    }

    /**
     * @throws Exception
     */
    private function generateScriptTagForEntry(string $entryName): string
    {
        if(null === ($jsFiles = $this->getCompiledJsFile($entryName))){
            throw new Exception(sprintf('We can\'t find any js file for Entry :%s', $entryName));
        }

        if (true === is_array($jsFiles)) {
                return $this->getMultipleScripts($jsFiles);
        }

        return $this->getScript($jsFiles[0]);
    }

    private function getScript(JsFile $jsFile): string
    {
        return sprintf('<script type="text/javascript" src="build/%s"></script>', $jsFile->getBasename());
    }

    /**
     * @param JsFile[] $jsFiles
     * @return string
     */
    private function getMultipleScripts(array $jsFiles): string
    {
        $scripts = '';
        foreach ($jsFiles as $file)
        {
            $scripts .= $this->getScript($file)." \n";
        }

        return $scripts;
    }
}
