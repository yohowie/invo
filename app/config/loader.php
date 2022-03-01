<?php

$loader = new \Phalcon\Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader->registerDirs(
    [
        $config->application->controllersDir,
        $config->application->modelsDir
    ]
);

$loader->registerNamespaces([
    'Invo\Controllers' => $config->application->controllersDir,
    'Invo\Models' => $config->application->modelsDir,
    'Invo\Forms' => $config->application->formsDir,
    'Invo\Plugins' => $config->application->pluginsDir
]);

$loader->register();
