<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit55114d1ac0086ad91aa9d5addef9aebf
{
    public static $files = array (
        '7b11c4dc42b3b3023073cb14e519683c' => __DIR__ . '/..' . '/ralouphie/getallheaders/src/getallheaders.php',
        'a0edc8309cc5e1d60e3047b5df6b7052' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/functions_include.php',
        'c964ee0ededf28c96ebd9db5099ef910' => __DIR__ . '/..' . '/guzzlehttp/promises/src/functions_include.php',
        '37a3dc5111fe8f707ab4c132ef1dbc62' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/functions_include.php',
    );

    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Psr\\Http\\Message\\' => 17,
            'Psr\\Http\\Client\\' => 16,
            'Psr\\Cache\\' => 10,
        ),
        'G' => 
        array (
            'GuzzleHttp\\Psr7\\' => 16,
            'GuzzleHttp\\Promise\\' => 19,
            'GuzzleHttp\\' => 11,
            'Grpc\\Gcp\\' => 9,
            'Grpc\\' => 5,
            'Google\\Protobuf\\' => 16,
            'Google\\Auth\\' => 12,
            'Google\\ApiCore\\' => 15,
            'Google\\Analytics\\Data\\' => 22,
            'Google\\' => 7,
            'GPBMetadata\\Google\\Protobuf\\' => 28,
            'GPBMetadata\\Google\\Analytics\\Data\\' => 34,
            'GPBMetadata\\Google\\' => 19,
            'GPBMetadata\\ApiCore\\' => 20,
        ),
        'F' => 
        array (
            'Firebase\\JWT\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Psr\\Http\\Message\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-message/src',
        ),
        'Psr\\Http\\Client\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-client/src',
        ),
        'Psr\\Cache\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/cache/src',
        ),
        'GuzzleHttp\\Psr7\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/psr7/src',
        ),
        'GuzzleHttp\\Promise\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/promises/src',
        ),
        'GuzzleHttp\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/guzzle/src',
        ),
        'Grpc\\Gcp\\' => 
        array (
            0 => __DIR__ . '/..' . '/google/grpc-gcp/src',
        ),
        'Grpc\\' => 
        array (
            0 => __DIR__ . '/..' . '/grpc/grpc/src/lib',
        ),
        'Google\\Protobuf\\' => 
        array (
            0 => __DIR__ . '/..' . '/google/protobuf/src/Google/Protobuf',
        ),
        'Google\\Auth\\' => 
        array (
            0 => __DIR__ . '/..' . '/google/auth/src',
        ),
        'Google\\ApiCore\\' => 
        array (
            0 => __DIR__ . '/..' . '/google/gax/src',
        ),
        'Google\\Analytics\\Data\\' => 
        array (
            0 => __DIR__ . '/..' . '/google/analytics-data/src',
        ),
        'Google\\' => 
        array (
            0 => __DIR__ . '/..' . '/google/common-protos/src',
        ),
        'GPBMetadata\\Google\\Protobuf\\' => 
        array (
            0 => __DIR__ . '/..' . '/google/protobuf/src/GPBMetadata/Google/Protobuf',
        ),
        'GPBMetadata\\Google\\Analytics\\Data\\' => 
        array (
            0 => __DIR__ . '/..' . '/google/analytics-data/metadata',
        ),
        'GPBMetadata\\Google\\' => 
        array (
            0 => __DIR__ . '/..' . '/google/common-protos/metadata',
        ),
        'GPBMetadata\\ApiCore\\' => 
        array (
            0 => __DIR__ . '/..' . '/google/gax/metadata/ApiCore',
        ),
        'Firebase\\JWT\\' => 
        array (
            0 => __DIR__ . '/..' . '/firebase/php-jwt/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'GPBMetadata\\GrpcGcp' => __DIR__ . '/..' . '/google/grpc-gcp/src/generated/GPBMetadata/GrpcGcp.php',
        'Grpc\\Gcp\\AffinityConfig' => __DIR__ . '/..' . '/google/grpc-gcp/src/generated/Grpc/Gcp/AffinityConfig.php',
        'Grpc\\Gcp\\AffinityConfig_Command' => __DIR__ . '/..' . '/google/grpc-gcp/src/generated/Grpc/Gcp/AffinityConfig_Command.php',
        'Grpc\\Gcp\\ApiConfig' => __DIR__ . '/..' . '/google/grpc-gcp/src/generated/Grpc/Gcp/ApiConfig.php',
        'Grpc\\Gcp\\ChannelPoolConfig' => __DIR__ . '/..' . '/google/grpc-gcp/src/generated/Grpc/Gcp/ChannelPoolConfig.php',
        'Grpc\\Gcp\\MethodConfig' => __DIR__ . '/..' . '/google/grpc-gcp/src/generated/Grpc/Gcp/MethodConfig.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit55114d1ac0086ad91aa9d5addef9aebf::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit55114d1ac0086ad91aa9d5addef9aebf::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit55114d1ac0086ad91aa9d5addef9aebf::$classMap;

        }, null, ClassLoader::class);
    }
}
