<?php

namespace kzorluoglu\ChameleonWebpackBundle\Controller;

use Exception;
use kzorluoglu\ChameleonWebpackBundle\DataModel\CssFile;
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
        return $this->generateCssTagForEntry($entryName);
    }

    /**
     * @throws Exception
     */
    private function generateScriptTagForEntry(string $entryName): string
    {
        if(null === ($jsFiles = $this->getEntryJsFiles($entryName))){
            throw new Exception(sprintf("We can't find any js file for Entry :%s", $entryName));
        }

        if (true === is_array($jsFiles)) {
            return $this->getMultipleScripts($jsFiles);
        }

        return $this->getScript($jsFiles[0]);
    }

    private function getScript(JsFile $file): string
    {
        return sprintf('<script type="text/javascript" src="build/%s"></script>', $file->getBasename());
    }

    /**
     * @param JsFile[] $jsFiles
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


    /**
     * @throws Exception
     */
    private function generateCssTagForEntry(string $entryName): string
    {
        if(null === ($cssFiles = $this->getEntryCssFiles($entryName))){
            throw new Exception(sprintf("We can't find any css file for Entry :%s", $entryName));
        }

        if (true === is_array($cssFiles)) {
            return $this->getMultipleCss($cssFiles);
        }

        return $this->getCssTag($cssFiles[0]);
    }

    /**
     * @return JsFile[]|null
     */
    private function getEntryJsFiles(string $entryName): ?array
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
     * @return CssFile[]|null
     */
    private function getEntryCssFiles(string $entryName): ?array
    {
        $jsFiles = [];
        foreach(glob($this->rootDir.'/../web/build/'.$entryName.'*.css') as $jsFile) {
            $fileInfo = pathinfo($jsFile);
            $jsFiles[] = new CssFile($fileInfo['dirname'], $fileInfo['basename'], $fileInfo['extension'], $fileInfo['filename']);
        }

        if (0 === \count($jsFiles)) {
            return null;
        }

        return $jsFiles;
    }

    /**
     * @param CssFile[] $cssFiles
     */
    private function getMultipleCss(array $cssFiles): string
    {
        $scripts = '';
        foreach ($cssFiles as $file)
        {
            $scripts .= $this->getCssTag($file)." \n";
        }

        return $scripts;
    }

    private function getCssTag(CssFile $file): string
    {
    return sprintf('<link rel="stylesheet" media="all" href="build/%s"></script>', $file->getBasename());
    }


}
