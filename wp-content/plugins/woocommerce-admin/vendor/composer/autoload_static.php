<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit834acae30f74de018515df793d519c51
{
    public static $files = array (
        'fd9f5df955e5151499fd2f642091d0a0' => __DIR__ . '/../..' . '/includes/core-functions.php',
        'b907791bfd099af1d822ca201c3f03f0' => __DIR__ . '/../..' . '/includes/feature-config.php',
        'c440206b9a4cb2ee803d8c41ad1f292a' => __DIR__ . '/../..' . '/includes/page-controller-functions.php',
        '57b93ef9148e0607a2b45af997e2c1c3' => __DIR__ . '/../..' . '/includes/wc-admin-update-functions.php',
    );

    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'Composer\\Installers\\' => 20,
        ),
        'A' => 
        array (
            'Automattic\\WooCommerce\\Admin\\' => 29,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Composer\\Installers\\' => 
        array (
            0 => __DIR__ . '/..' . '/composer/installers/src/Composer/Installers',
        ),
        'Automattic\\WooCommerce\\Admin\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit834acae30f74de018515df793d519c51::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit834acae30f74de018515df793d519c51::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
