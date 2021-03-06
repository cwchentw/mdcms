<?php
# Don't add any namespace in a mdcms theme. Instead,
#  let mdcms load global functions.


function loadHome()
{
    # Get the root path of default theme of mdcms.
    $sep = DIRECTORY_SEPARATOR;
    $rootDirectory = __DIR__ . $sep . "..";

    require $rootDirectory . $sep . "theme" . $sep . "home.php";
}

function loadSection()
{
    # Get the root path of default theme of mdcms.
    $sep = DIRECTORY_SEPARATOR;
    $rootDirectory = __DIR__ . $sep . "..";

    require $rootDirectory . $sep . "theme" . $sep . "section.php";
}

function loadPost()
{
    # Get the root path of default theme of mdcms.
    $sep = DIRECTORY_SEPARATOR;
    $rootDirectory = __DIR__ . $sep . "..";

    require $rootDirectory . $sep . "theme" . $sep . "post.php";
}

function loadAssets($dest)
{
    # Save the path of old working directory.
    $oldDirectory = getcwd();

    # Get the root path of default theme of mdcms.
    $sep = DIRECTORY_SEPARATOR;
    $rootDirectory = __DIR__ . $sep . "..";

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
    #
    # Not every theme invoke the same command to compile assets.
    #  Modify it according to your own situation.
    if (!system("npm run prod")) {
        # Move back to old working directory.
        chdir($oldDirectory);

        throw new \Exception("Unable to compile assets");
    }

    # Copy assets recursively.
    try {
        $publicDirectory = $rootDirectory . $sep . "public";

        # xCopy is a utility function in mdcms.
        #  It will copy directories and files recursively.
        \LightweightCMS\Core\xCopy($publicDirectory, $dest);
    }
    catch (Exception $e) {
        # Move back to old working directory.
        chdir($oldDirectory);

        throw $e;
    }

    # Move back to old working directory.
    chdir($oldDirectory);
}
