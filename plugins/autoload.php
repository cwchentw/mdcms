<?php
# The main loader for plugin(s).

$sep = DIRECTORY_SEPARATOR;
# Get root path.
$rootDirectory = __DIR__ . $sep . "..";
# Load global settings.
require_once $rootDirectory . $sep . "setting.php";

# Scan all files in the directory.
$libraries = scandir(__DIR__);

# We only scan top layer of this directory.
foreach ($libraries as $library) {
    # Skip special directories.
    if ("." == substr($library, 0, 1)) {
        continue;
    }
    # Skip private directories and files.
    else if ("_" == substr($library, 0, 1)) {
        continue;
    }

    # Pass plugin in the black list.
    if (in_array($library, PLUGIN_BLACKLIST)) {
        continue;
    }

    $path = __DIR__ . $sep . $library;

    # Skip the script itself.
    if (__FILE__ == $path) {
        continue;
    }

    if (is_dir($path)) {
        # autoload.php at the root path of a plugin is mandatory.
        $loader = $path . $sep . "autoload.php";

        # Load the plugin.
        require_once $loader;
    }
}
