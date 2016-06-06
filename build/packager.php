<?php
require __DIR__ . '/Burgomaster.php';

$stageDirectory = __DIR__ . '/artifacts/staging';
$projectRoot = __DIR__ . '/../';
$packager = new \Burgomaster($stageDirectory, $projectRoot);

// Copy basic files to the stage directory. Note that we have chdir'd onto
// the $projectRoot directory, so use relative paths.
foreach (['README.md', 'LICENSE'] as $file) {
    $packager->deepCopy($file, $file);
}

// Copy each dependency to the staging directory. Copy *.php and *.pem files.
$packager->recursiveCopy('src', 'Habrahabr/Api', ['php']);

// Create the classmap autoloader
$packager->createAutoloader();

// Create a phar file from the staging directory at a specific location
$packager->createPhar(__DIR__ . '/artifacts/habrahabr.phar');

// Create a zip file from the staging directory at a specific location
$packager->createZip(__DIR__ . '/artifacts/habrahabr.zip');
