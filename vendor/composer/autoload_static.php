<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit8e94146d169155188e0ce7df3a4b9407
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'SmartMailAssistant\\' => 19,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'SmartMailAssistant\\' => 
        array (
            0 => __DIR__ . '/../..' . '/includes',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit8e94146d169155188e0ce7df3a4b9407::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit8e94146d169155188e0ce7df3a4b9407::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit8e94146d169155188e0ce7df3a4b9407::$classMap;

        }, null, ClassLoader::class);
    }
}
