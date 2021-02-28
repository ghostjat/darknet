# php-darknet ![Darknet Logo](darknet.png)

php-ffi experiment
=========
php7.4 interface to the lib-darknet for object detection.

Install
---------
composer require ghostjat/darknet

Description
-----------
[lib-darknet](https://github.com/pjreddie/darknet) 

# Darknet #
Darknet is an open source neural network framework written in C and CUDA. It is fast, easy to install, and supports CPU and GPU computation.

* It offers a simple API.
* High performance, due to the fact that it uses native interface elements.
* Fast learning by the user, due to the simplicity of its API.
# yolo v2, v3, v4 #

Synopsis
--------
WARNING:  
This module is in its early stages and should be considered a Work in Progress.
The interface is not final and may change in the future.  

Sample:

<p align="center">
<img src="https://raw.github.com/ghostjat/php-darknet/master/temp/out/gp.jpg" alt="gp"/>
 <img src ="https://raw.github.com/ghostjat/php-darknet/master/temp/out/dog.jpg" alt ="dog"/>
  <img src ="https://raw.github.com/ghostjat/php-darknet/master/temp/out/eagle.jpg" alt ="egale"/>
 <img src ="https://raw.github.com/ghostjat/php-darknet/master/temp/out/giraffe.jpg" alt ="giraffe"/>
<img src="https://raw.github.com/ghostjat/php-darknet/master/temp/out/person.jpg" alt="person"/>
</p>

Sample code:

```<?php

require '../vendor/autoload.php';

use darknet\core;
$lib = '/home/ghost/bin/c-lib/darknet/data/';
$img = ['eagle.jpg','giraffe.jpg','horses.jpg','person.jpg','kite.jpg'];
$dn = new core();
foreach ($img as $value) {
    $dn->detect($lib.$value);
}
```
Author
------
Shubham Chaudhary <ghost.jat@gmail.com>
