<?php namespace Athov\Ratchet;

use System\Classes\PluginBase;
use Config;
use App;
use Askedio\LaravelRatchet\Providers\LaravelRatchetServiceProvider;

class Plugin extends PluginBase
{
    public function boot()
    {
        $this->setConfiguration();
        App::register(LaravelRatchetServiceProvider::class);
    }

    public function setConfiguration()
    {
        Config::set('ratchet', Config::get('athov.ratchet::ratchet'));
        Config::set('zmq', Config::get('athov.ratchet::zmq'));
    }

    public function registerComponents()
    {
    }

    public function registerSettings()
    {
    }
}
