<?php
namespace mdcms\Theme;


function loadHome()
{
    $rootDirectory = __DIR__ . "/../../..";
    require $rootDirectory . "/theme/home.php";
}

function loadSection()
{
    $rootDirectory = __DIR__ . "/../../..";
    require $rootDirectory . "/theme/section.php";
}

function loadPost()
{
    $rootDirectory = __DIR__ . "/../../..";
    require $rootDirectory . "/theme/post.php";
}

function loadAssets($dest)
{
    # Save the path of old working directory.
    $oldDirectory = getcwd();
    $rootDirectory = __DIR__ . "/../../..";

    # Move to theme directory.
    if (!chdir($rootDirectory)) {
        # Move back to old working directory.
        chdir($oldDirectory);
        throw new \Exception("Unable to change working directory to theme directory");
    }

    # We don't update NPM packages because they are merely for build automation.
    if (!(file_exists("node_modules") && is_dir("node_modules"))) {
        if (!system("npm install")) {
            # Move back to old working directory.
            chdir($oldDirectory);
            throw new \Exception("Unable to install NPM packages");
        }
    }

    # Compile assets.
    if (!system("npm run prod")) {
        # Move back to old working directory.
        chdir($oldDirectory);
        throw new \Exception("Unable to compile assets");
    }

    # Copy assets recursively.
    try {
        $publicDirectory = $rootDirectory . "/public";
        # xCopy is a utility function in mdcms.
        #  It will copy directories and files recursively.
        \mdcms\xCopy($publicDirectory, $dest);
    }
    catch (Exception $e) {
        # Move back to old working directory.
        chdir($oldDirectory);
        throw $e;
    }

    # Move back to old working directory.
    chdir($oldDirectory);
}
