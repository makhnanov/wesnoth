<?php

use Illuminate\Support\Str;

require_once __DIR__ . '/vendor/autoload.php';

$config = file_get_contents(__DIR__ . '/../data/core/terrain.cfg');
$lines = explode("\n", $config);
//$array = [];

foreach ($lines as $number => $line) {
    if ($number > 0 && Str::startsWith($line, '#    ## ')) {
        echo $line . PHP_EOL;
    }

//    if ($line === '[terrain_type]') {
    if (Str::startsWith($line, $symbolImages = '    name= _ ')) {
        echo substr($line, strlen($symbolImages)) . PHP_EOL;
    }
    if (Str::startsWith($line, $symbolImages = '    symbol_image=')) {
        echo '/var/www/wesnoth/data/core/images/terrain/' . substr($line, strlen($symbolImages)) . '.png' . PHP_EOL;
    }
    if (Str::startsWith($line, $symbolImages = '    editor_image=')) {
        echo '/var/www/wesnoth/data/core/images/terrain/' . substr($line, strlen($symbolImages)) . '.png' . PHP_EOL;
    }
    if (Str::startsWith($line, $symbolImages = '    icon_image=')) {
        echo '/var/www/wesnoth/data/core/images/terrain/' . substr($line, strlen($symbolImages)) . '.png' . PHP_EOL;
    }
//    }
}
