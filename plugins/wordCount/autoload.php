<?php
# Loader of word count plugin.


$sep = DIRECTORY_SEPARATOR;
$sourceDirectory = __DIR__ . $sep . "src";
$prefixDirectory = $sourceDirectory . $sep . "LightweightCMS" . $sep . "Plugin";
require_once $prefixDirectory . $sep . "wordCount.php";
