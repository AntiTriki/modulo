<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit86177e0c6d7d9cfe71c818786fe758f1
{
    public static $prefixesPsr0 = array (
        'J' => 
        array (
            'Jaspersoft' => 
            array (
                0 => __DIR__ . '/..' . '/jaspersoft/rest-client/src',
            ),
            'JasperPHP' => 
            array (
                0 => __DIR__ . '/..' . '/cossou/jasperphp/src',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInit86177e0c6d7d9cfe71c818786fe758f1::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
