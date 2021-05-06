<?php

namespace kzorluoglu\ChameleonWebpackBundle\Twig;

use kzorluoglu\ChameleonWebpackBundle\Interfaces\WebpackFileInterface;
use Symfony\Bundle\TwigBundle\DependencyInjection\TwigExtension;
use Twig\TwigFunction;

class EntryFilesTwigExtension extends TwigExtension
{
    private WebpackFileInterface $webpackFile;

    public function __construct(WebpackFileInterface $webpackFile)
    {
        $this->webpackFile = $webpackFile;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('webpack_entry_js_files', [$this, 'getWebpackEntryJsFiles']),
            new TwigFunction('webpack_entry_css_files', [$this, 'getWebpackEntryCssFiles']),
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
