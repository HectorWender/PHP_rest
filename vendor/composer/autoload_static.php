<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitaacedce77e8bd4d758e197857680fb19
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/App',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitaacedce77e8bd4d758e197857680fb19::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitaacedce77e8bd4d758e197857680fb19::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitaacedce77e8bd4d758e197857680fb19::$classMap;

        }, null, ClassLoader::class);
    }
}
