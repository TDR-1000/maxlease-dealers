<?php

/**
 * Class ASContainer
 */
class MAXContainer
{
    /**
     * @var
     */
    protected static $instance;

    /**
     * @param \Pimple\Container $container
     */
    public static function setContainer(\Pimple\Container $container)
    {
        self::$instance = $container;
    }

    /**
     * @return mixed
     */
    public static function getInstance()
    {
        return self::$instance;
    }
}
