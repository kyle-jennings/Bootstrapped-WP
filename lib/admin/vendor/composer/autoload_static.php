<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit9948eaf4bd853dbddd3a6977eb7da93b
{
    public static $prefixLengthsPsr4 = array (
        'b' => 
        array (
            'bswp\\' => 5,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'bswp\\' => 
        array (
            0 => __DIR__ . '/../..' . '/bswp',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit9948eaf4bd853dbddd3a6977eb7da93b::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit9948eaf4bd853dbddd3a6977eb7da93b::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
