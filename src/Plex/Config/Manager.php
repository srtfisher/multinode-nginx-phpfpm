<?php namespace Plex\Config;

use Plex\Exception\ConfigException;
use Plex\Config\Item as ConfigItem;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Yaml\Exception\ParseException;

/**
 * Configuration Management
 *
 * @package  plex
 * @subpackage configuration
 */
class Manager {
    /**
     * Storage of the Configuration
     * 
     * @var array
     */
    protected static $config;

    /**
     * Retrieve a configuration item
     * 
     * @param string
     * @param  mixed Default value to return (defaults to NULL)
     * @param  array Configuration to check though (null to load from file)
     * @return mixed
     */
    public static function retrieve($key, $default = NULL, $parse = NULL)
    {
        if ($parse == NULL)
            $parse = self::getParse();

        return (isset($parse[$key])) ? new ConfigItem($parse[$key]) : $default;
    }

    /**
     * List of the possible configuration locations
     * 
     * @return array
     */
    protected static function configFiles()
    {
        return [
            '/etc',
            '/usr/local/etc',
            dirname(PLEX_CLI_PATH).'/etc',
        ];
    }

    /**
     * Retrieve the parse of the configuration files
     *
     * @throws  Plex\Exception\ConfigException
     * @return array
     */
    public static function getParse($file = 'plex.yml')
    {
        if (self::$config !== NULL) return $this->parse;
        $locator = new FileLocator(self::configFiles());
        $configFiles = $locator->locate($file, null, false);

        $config = [];
        foreach ($configFiles as $file) :
            try {
                $fileParse = Yaml::parse(file_get_contents($file));
            } catch (ParseException $e) {
                throw new ConfigException(sprintf('Error parsing config file %s: %s', $file, $e->getMessage()));
            }

            $config = array_replace_recursive($config, $fileParse);
        endforeach;

        if (count($config) == 0) throw new ConfigException('No configuration set for Plex.');

        self::$config = $config;
        return self::$config;
    }
}