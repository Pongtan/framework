<?php


namespace Pongtan\Services;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Translation\FileLoader;
use Illuminate\Translation\Translator;

class Factory
{
    /**
     * @return Translator
     */
    public static function getLang()
    {
        $lang = config('app.lang');
        if (!$lang) {
            $lang = 'en';
        }
        // Prepare the FileLoader
        $loader = new FileLoader(new Filesystem(), app()->getBasePath() . '/resources/lang/');
        // Register the English translator
        $trans = new Translator($loader, $lang);
        return $trans;
    }
}