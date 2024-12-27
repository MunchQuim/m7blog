<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit5dc57294c19af907d1bf39555d2c2559
{
    public static $prefixLengthsPsr4 = array (
        'm' => 
        array (
            'models\\' => 7,
        ),
        'J' => 
        array (
            'Joaquimpinsot\\Practica6Blog\\' => 28,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'models\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/models',
        ),
        'Joaquimpinsot\\Practica6Blog\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit5dc57294c19af907d1bf39555d2c2559::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit5dc57294c19af907d1bf39555d2c2559::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit5dc57294c19af907d1bf39555d2c2559::$classMap;

        }, null, ClassLoader::class);
    }
}
