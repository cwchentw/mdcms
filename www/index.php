<?php
# Router of mdcms.

# Get global setting.
require_once __DIR__ . "/../setting.php";
# Load builtin library
require_once __DIR__ . "/../" . LIBRARY_DIRECTORY . "/autoload.php";
# Load plugin(s) if any.
require_once __DIR__ . "/../" . PLUGIN_DIRECTORY . "/autoload.php";
# Load a theme.
require_once __DIR__ . "/../" . THEME_DIRECTORY . "/" . SITE_THEME . "/autoload.php";


# TODO: Load Xdebug on a development environment.

# TODO: Check essential variables on a development environment.

# Filter the input URI.
# It may be redundant on Nginx.
$loc = filter_input(INPUT_SERVER, "REQUEST_URI", FILTER_SANITIZE_URL);

# Check whether the URL is dangerous.
if (false != strpos($loc, "..")) {
    $post = array();
    $post[MDCMS_POST_TITLE] = "Bad Request Error";
    $post[MDCMS_POST_CONTENT] = "Invalid URL";
    $post[MDCMS_POST_STATUS] = 400;
    goto render;
}

render:
# Render an error page.
if (isset($post) && 200 != $post["status"]) {
    $GLOBALS[MDCMS_POST] = $post;

    # TODO: Create a mock breadcrumb.

    loadPost();
}
# Render home page of a mdcms site.
else if (\mdcms\Core\isHome($loc)) {
    $GLOBALS[MDCMS_BREADCRUMB] = \mdcms\Core\getBreadcrumb($loc);
    $GLOBALS[MDCMS_SECTIONS] = \mdcms\Core\getSections($loc);
    # Posts not included in any section.
    $GLOBALS[MDCMS_POSTS] = \mdcms\Core\getPosts($loc);

    loadHome();
}
# TODO: Render a page.
# Render a section.
else if (\mdcms\Core\isSection($loc)) {
    $GLOBALS[MDCMS_BREADCRUMB] = \mdcms\Core\getBreadcrumb($loc);
    # Current section.
    $GLOBALS[MDCMS_SECTION] = \mdcms\Core\readSection($loc);
    # Subsections of current section.
    $GLOBALS[MDCMS_SECTIONS] = \mdcms\Core\getSections($loc);
    # Posts of current section.
    $GLOBALS[MDCMS_POSTS] = \mdcms\Core\getPosts($loc);

    loadSection();
}
# Render a post.
else {
    foreach (REDIRECT_LIST as $redirect) {
        if (count($redirect) < 2) {
            continue;
        }

        if ($redirect[0] == $loc) {
            $status = 302;
            if (!is_null($redirect[2])) {
                $status = $redirect[2];
            }

            header("Location: {$redirect[1]}", true, $status);
        }
    }

    $post = \mdcms\Core\readPost($loc);

    # If HTTP status 404, generate an error page on-the-fly.
    if (404 == $post[MDCMS_POST_STATUS]) {
        # Create a post dynamically.
        $post = array();

        $post[MDCMS_POST_TITLE] = "Page Not Found";
        $post[MDCMS_POST_CONTENT] = "The page doesn't exist on our server.";
        $post[MDCMS_POST_AUTHOR] = SITE_AUTHOR;
        $post[MDCMS_POST_STATUS] = 404;
        $post[MDCMS_POST_WORD_COUNT] = 7;

        # Create a breadcrumb dynamically.
        $breadcrumb = array();

        {
            $link = array();

            $link[MDCMS_LINK_PATH] = "/";
            $link[MDCMS_LINK_TITLE] = BREADCRUMB_HOME;

            array_push($breadcrumb, $link);
        }

        {
            $link = array();

            $link[MDCMS_LINK_TITLE] = "Page Not Found";

            array_push($breadcrumb, $link);
        }

        $GLOBALS[MDCMS_POST] = $post;
        $GLOBALS[MDCMS_BREADCRUMB] = $breadcrumb;
    }
    # Load a normal page.
    else {
        $GLOBALS[MDCMS_BREADCRUMB] = \mdcms\Core\getBreadcrumb($loc);
        $GLOBALS[MDCMS_POST] = $post;
    }

    loadPost();
}
