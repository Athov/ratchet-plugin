<?php namespace Athov\Ratchet\Controllers;

use Athov\Ratchet\Classes\Events\ExampleRatchetEvent;
use Backend\Classes\Controller;
use BackendMenu;

class TestEvents extends Controller
{
    public $implement = [    ];
    
    public function __construct()
    {
        parent::__construct();
        $this->addJs('/plugins/athov/ratchet/assets/js/websockets-subscriber.js');
    }

    public function index()
    {
    }

    public function onTest()
    {
        broadcast(new ExampleRatchetEvent('test', [
            'title' => 'Test',
            'message' => 'Test',
            'type' => 'info'
        ]));
    }
}
