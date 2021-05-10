<?php

namespace kzorluoglu\ChameleonWebpackBundle\Twig;

use kzorluoglu\ChameleonWebpackBundle\Interfaces\WebpackFileInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class EntryFilesTwigExtension extends AbstractExtension
{
    private WebpackFileInterface $webpackFile;

    public function __construct(WebpackFileInterface $webpackFile)
    {
        $this->webpackFile = $webpackFile;
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('webpack_entry_js_files', [$this, 'getWebpackEntryJsFiles'], ['is_safe' => ['html']]),
            new TwigFunction('webpack_entry_css_files', [$this, 'getWebpackEntryCssFiles'], ['is_safe' => ['html']]),
        ];
    }
    public function getWebpackEntryJsFiles(string $entryName): string
    {
        return $this->webpackFile->getJsFile($entryName);
    }

    public function getWebpackEntryCssFiles(string $entryName): string
    {
        return $this->webpackFile->getCssFile($entryName);
    }
}
