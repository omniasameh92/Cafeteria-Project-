<?php
require 'vendor/autoload.php';

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;

require ('Chat.php');

$server = IoServer::factory(new HttpServer(new WsServer(new Chat)),4551);

$server->run();