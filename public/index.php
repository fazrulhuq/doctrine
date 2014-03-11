<?php

use Doctrine\MongoDB\Connection;
use Doctrine\ODM\MongoDB\Configuration;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver;
use Documents\IPLocation;

if (!file_exists($file = __DIR__ . '/../vendor/autoload.php')) {
    throw new RuntimeException('Install dependencies to run this script.');
}
$configData = require_once __DIR__ . '/../config/config.php';
$loader = require_once $file;
$loader->add('Documents', __DIR__ . '/../');

$connection = new Connection($configData['mongodb']['host']);

$config = new Configuration();
$config->setProxyDir(__DIR__ . '/../Proxies');
$config->setProxyNamespace('Proxies');
$config->setHydratorDir(__DIR__ . '/../Hydrators');
$config->setHydratorNamespace('Hydrators');
$config->setDefaultDB($configData['mongodb']['db']);
$config->setMetadataDriverImpl(AnnotationDriver::create(__DIR__ . '/../Documents'));

AnnotationDriver::registerAnnotationClasses();

$dm = DocumentManager::create($connection, $config);

$app = new Silex\Application();

$app->get('/api/geo/find/ip/{ip}', function ($ip) use ($app, $dm) {

    try {
        $subnetValue = explode('.', $ip);
        if (!isset($subnetValue[0]) || !isset($subnetValue[1]) || !isset($subnetValue[3])) {
            return 0;
        }

        $ipNumber = $subnetValue[0] * (256 * 256 * 256) + $subnetValue[1] * (256 * 256) + $subnetValue[2] * 256 + $subnetValue[3];


        $locations = $dm->getRepository('Documents\IPLocation')
                ->findBy(
                array(
                    'ipFrom' => array('$lte' => $ipNumber),
                    'ipTo' => array('$gte' => $ipNumber),
                )
        );
    } catch (Exception $exc) {
        echo $exc->getMessage();
        echo $exc->getTraceAsString();
    }

    return count($locations) > 0 ? $app->json($locations[0]->toArray()) : $app->json(array('-'));
});

//$app->get('/instagram/listener/', function () use ($app) {
//    $mode = $app['request']->get('hub.mode');
//    $challenge = $app['request']->get('hub.challenge');
//    
//    if ($mode === "subscribe" && $challenge) {
//        return $challenge;
//    }
//    
//    
//    
//    return $name;
//});

$app->run();

