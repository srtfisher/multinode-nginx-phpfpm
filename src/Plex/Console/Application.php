<?php namespace Plex\Console;

class Application extends \Symfony\Component\Console\Application {
    /**
     * Plex Version
     *
     * @var string
     */
    const VERSION = '0.0.1';

    /**
     * Instance of the Console
     * 
     * @var Plex\Console\Application
     */
    protected $command;

    /**
     * Indicates if the application has booted
     * 
     * @var boolean
     */
    protected $booted = false;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct('Plex Node Manager', self::VERSION);
        $this->setAutoExit(false);
    }
}