<?php
declare (strict_types=1);
if (!extension_loaded('swoole')) {
    dl('swoole.so');
}

use Swoole\WebSocket\Server;
use Swoole\Http\Request;
use Swoole\WebSocket\Frame;

$wbs = new Server("0.0.0.0",8080);
$wbs->on('start', function(Server $wbs){
    
});

$wbs->on('open', function(Server $wbs, Request $req){
    
});

$wbs->on('message', function(Server $wbs, Frame $frame){
    
});

$wbs->on('close', function(Server $server, int $fd){
    
});

$wbs->start();