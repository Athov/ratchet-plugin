<?php namespace Athov\Ratchet;

use System\Classes\PluginBase;
use Config;

class Plugin extends PluginBase
{
    public function boot()
    {
        $this->setConfiguration();
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
