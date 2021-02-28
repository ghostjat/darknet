<?php

require '../vendor/autoload.php';

use darknet\core;
$lib = '/home/ghost/bin/c-lib/darknet/data/';
$img = ['dog.jpg','eagle.jpg','giraffe.jpg','horses.jpg','person.jpg','kite.jpg','gp.jpg'];
$dn = new core();
foreach ($img as $value) {
    $dn->detect($lib.$value);
}
