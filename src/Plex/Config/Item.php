<?php namespace Plex\Config;

use Plex\Exception\ConfigException;

/**
 * Configuration Item
 *
 * Used to go though arrays of configuration items
 *
 * @package  plex
 * @subpackage  configuration
 */
class Item {
    /**
     * Storage of the configuration item
     * 
     * @var mixed
     */
    protected $item;

    public function __construct($data)
    {
        $this->item = $data;
    }

    /**
     * Go to the child of the configuration item (array)
     *
     * @param  string Key to look for the children of
     * @param  mixed Default value to return when key not found
     * @return Plex\Config\Item
     */
    public function children($key, $default = NULL)
    {
        if (! isset($this->item[$key])) return $default;

        return new Item($this->item[$key]);
    }

    /**
     * Return the Item as a string
     * 
     * @return string
     */
    public function toString()
    {
        return (string) $this->item;
    }

    /**
     * Return the Item as a integer
     * 
     * @return integer
     */
    public function toInteger()
    {
        return (integer) $this->item;
    }

    /**
     * Return the Item as a float
     * 
     * @return float
     */
    public function toFloat()
    {
        return (float) $this->item;
    }

    /**
     * Return the Item as a boolean
     * 
     * @return boolean
     */
    public function toBoolean()
    {
        return (boolean) $this->item;
    }

    /**
     * Return the Item as a boolean
     * Alias to {@link Item::toBoolean()}
     * 
     * @return boolean
     */
    public function toBool()
    {
        return (boolean) $this->item;
    }

    /**
     * Return the Item as a array
     * 
     * @return array
     */
    public function toArray()
    {
        return (array) $this->item;
    }

    /**
     * Return the Item as a object
     * 
     * @return object
     */
    public function toObject()
    {
        return (object) $this->item;
    }
}