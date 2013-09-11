<?php namespace Plex\Command;

use Plex\Console\Command;
use Plex\Config\Manager as Config;

class CreateProjectCommand extends Command {
    protected $name = 'project:create';

    protected $description = 'Create project';

    public function fire()
    {
        $config = Config::retrieve('plex')
            ->children('nodes')
                ->children(1)
                    ->children('host');
        var_dump($config->toString());

        var_dump( Config::retrieve('applications', null, null, 'plex-applications')
            ->children(0)
            ->toArray()
        );
    }
}