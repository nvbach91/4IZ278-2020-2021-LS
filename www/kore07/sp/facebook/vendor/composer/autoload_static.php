<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite1ce4546262a9ec7261dba27bd48eaf0
{
    public static $files = array (
        'c65d09b6820da036953a371c8c73a9b1' => __DIR__ . '/..' . '/facebook/graph-sdk/src/Facebook/polyfills.php',
    );

    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Facebook\\' => 9,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Facebook\\' => 
        array (
            0 => __DIR__ . '/..' . '/facebook/graph-sdk/src/Facebook',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInite1ce4546262a9ec7261dba27bd48eaf0::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite1ce4546262a9ec7261dba27bd48eaf0::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInite1ce4546262a9ec7261dba27bd48eaf0::$classMap;

        }, null, ClassLoader::class);
    }
}
