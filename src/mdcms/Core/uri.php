<?php
namespace mdcms\Core;
# URIs related functions.


# Check whether the page is the home page of a site.
function isHome($uri)
{
    return "/" == $uri;
}

function isPageInHome($uri)
{
    preg_match("/^\/(\d+)\/$/s", $uri, $matches);

    if (isset($matches)) {
        return true;
    }

    return false;
}

# Check whether the page is a section.
#
# The function doesn't distinguish between top sections
#  and nested ones.
function isSection($uri)
{
    $rootDirectory = __DIR__ . "/../../..";
    # Get global setting.
    require_once $rootDirectory . "/setting.php";

    $path = $rootDirectory . "/" . CONTENT_DIRECTORY . "/" . $uri;

    return is_dir($path);
}
