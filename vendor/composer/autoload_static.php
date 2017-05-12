<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit4bf04bd41c7af5d59563aa061796ff9c
{
    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'Traffic\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Traffic\\' => 
        array (
            0 => __DIR__ . '/../..' . '/application/libs',
        ),
    );

    public static $fallbackDirsPsr4 = array (
        0 => __DIR__ . '/../..' . '/app/libs',
        1 => __DIR__ . '/../..' . '/app/model',
        2 => __DIR__ . '/../..' . '/app/controller',
        3 => __DIR__ . '/../..' . '/app/view',
        4 => __DIR__ . '/../..' . '/app/core',
    );

    public static $prefixesPsr0 = array (
        'T' => 
        array (
            'Twig_' => 
            array (
                0 => __DIR__ . '/..' . '/twig/twig/lib',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit4bf04bd41c7af5d59563aa061796ff9c::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit4bf04bd41c7af5d59563aa061796ff9c::$prefixDirsPsr4;
            $loader->fallbackDirsPsr4 = ComposerStaticInit4bf04bd41c7af5d59563aa061796ff9c::$fallbackDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit4bf04bd41c7af5d59563aa061796ff9c::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
