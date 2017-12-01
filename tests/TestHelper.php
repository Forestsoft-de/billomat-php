<?php
/**
 * Created by PhpStorm.
 * User: Forest
 * Date: 21-Nov-17
 * Time: 20:31
 */

namespace Forestsoft\Billomat;


use Symfony\Component\Yaml\Yaml;

class TestHelper
{

    private static $config;

    public static function getConfig()
    {
        $config = [];
        if (self::$config === null) {
            if (!is_file(__DIR__ . "/config.yml")) {
                throw new \Exception("No test config file found. Please copy " .  __DIR__ . "/config.dist.yml to " .  __DIR__ . "/config.dist.yml");
            }
            $config = Yaml::parse(file_get_contents(__DIR__ . "/config.yml"));
            self::$config = $config;
        }

        return self::$config;
    }

    public static function getMock($string)
    {

        $generator = new \PHPUnit_Framework_MockObject_Generator();
        $mock = $generator->getMock($string);

        return $mock;

    }
}