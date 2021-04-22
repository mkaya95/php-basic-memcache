<?php
require __DIR__.'/vendor/autoload.php';

use Symfony\Component\Cache\Adapter\MemcachedAdapter;
use Symfony\Contracts\Cache\ItemInterface;

$client = MemcachedAdapter::createConnection(
  'memcached://localhost'
);

$cache = new MemcachedAdapter($client);

$time_start = microtime(true); 

$value = $cache->get('sait', function (ItemInterface $item) {
  $computedValue = file_get_contents('http://localhost/exercise/list?offset=0&limit=100&order=date');
  return $computedValue;
});

$time_end = microtime(true); 

//echo $value;

echo $time_end-$time_start." passed";

//$cache->delete('sait');