<?php namespace Plex\Manager;
use Illuminate\Events\Dispatcher;

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
        $this->boot();
    }

    /**
     * Boot the Application
     * 
     * @return void
     */
    public function boot()
    {
        if ($this->booted) return;

        $this->command = new \Plex\Console\Application('Plex Node Manager', self::VERSION);
        $this->booted = true;
    }
}