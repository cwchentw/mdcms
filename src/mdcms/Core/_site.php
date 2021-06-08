<?php
namespace mdcms\Core;
# Private functions used by site.php.

# Get the root path of mdcms.
$rootDirectory = __DIR__ . "/../../..";

function getPageFromPath($path)
{
    global $rootDirectory;
    $contentDirectory = $rootDirectory . "/" . CONTENT_DIRECTORY;
    $page = substr($path, strlen($contentDirectory));

    $fileParts = pathinfo($page);
    if (isset($fileParts["extension"])) {
        $page = substr($page, 0, -(strlen($fileParts["extension"])+1));
    }

    /* Add a trailing slash if no any. */
    if ("/" != substr($page, strlen($page)-1, 1)) {
        $page .= "/";
    }

    return $page;
}

/* TODO: Test the code. */
function getHTMLPathFromPage($page)
{
    global $rootDirectory;
    $path = $rootDirectory
        . "/" . CONTENT_DIRECTORY
        . "/" . $page;

    /* Remove a trailing "/" */
    if ("/" == substr($path, strlen($path)-1, 1)) {
        $path = substr($path, 0, strlen($path)-1);
    }

    return $path . HTML_FILE_EXTENSION;
}

/* TODO: Test the code. */
function readHTMLLink($page)
{
    $result = array();

    $result[MDCMS_LINK_PATH] = $page;

    $htmlPath = getHTMLPathFromPage($page);

    $result[MDCMS_LINK_MTIME] = filemtime($htmlPath);

    $rawContent = file_get_contents($htmlPath);

    # `$rawContent` is not a full HTML document.
    # Therefore, we don't use a HTML parser but some regex pattern.
    preg_match("/<h1[^>]*>(.+)<\/h1>/", $rawContent, $matches);

        # Extract a title from a document.
    if (isset($matches)) {
        $result[MDCMS_POST_TITLE] = $matches[1];
    }
    # If no title in the above document, extract a title from a path.
    else {
        $title = preg_replace("/\//", "", $page);
        $title = preg_replace("/-+/", " ", $title);
        $title = ucwords($title);  # Capitalize a title.
        $result[MDCMS_LINK_TITLE] = $title;
    }

    return $result;
}

/* TODO: Test the code. */
function readMarkdownLink($page)
{
    $result = array();

    $result[MDCMS_LINK_PATH] = $page;

    global $rootDirectory;
    $path = $rootDirectory
        . "/" . CONTENT_DIRECTORY
        . "/" . $page;

    /* Remove a trailing "/" */
    if ("/" == substr($path, strlen($path)-1, 1)) {
        $path = substr($path, 0, strlen($path)-1);
    }

    $markdownPath = $path . MARKDOWN_FILE_EXTENSION;

    $result[MDCMS_LINK_MTIME] = filemtime($markdownPath);

    $rawContent = file_get_contents($markdownPath);

    preg_match("/^# (.+)/", $rawContent, $matches);

    # Extract a title from a document.
    if (isset($matches)) {
        $result[MDCMS_LINK_TITLE] = $matches[1];
    }
    # If no title in the above document, extract a title from a path.
    else {
        $title = preg_replace("/\//", "", $page);
        $title = preg_replace("/-+/", " ", $title);
        $title = ucwords($title);  # Capitalize a title.
        $result[MDCMS_LINK_TITLE] = $title;
    }

    return $result;
}

/* TODO: Test the code. */
function readDirectoryLink($page)
{
    $result = array();

    $result[MDCMS_LINK_PATH] = $page;

    global $rootDirectory;
    $path = $rootDirectory
        . "/" . CONTENT_DIRECTORY
        . "/" . $page;
    $indexPath = $path . "/" . SECTION_INDEX;

    if (file_exists($indexPath)) {
        $result[MDCMS_LINK_MTIME] = filemtime($indexPath);

        $rawContent = file_get_contents($indexPath);

        preg_match("/^# (.+)/", $rawContent, $matches);

        # Extract a title from a document.
        if (isset($matches)) {
            $result[MDCMS_LINK_TITLE] = $matches[1];
        }
        # If no title in the above document, extract a title from a path.
        else {
            goto extract_title_from_page;
        }
    }
    else {
        extract_title_from_page:
        $result[MDCMS_LINK_MTIME] = stat($path)["mtime"];

        $title = preg_replace("/\//", "", $page);
        $title = preg_replace("/-+/", " ", $title);
        $title = ucwords($title);  # Capitalize a title.
        $result[MDCMS_LINK_TITLE] = $title;
    }

    return $result;
}

/* TODO: Test the code. */
function isHTMLFile($path)
{
    return strpos($path, HTML_FILE_EXTENSION);
}

/* TODO: Test the code. */
function isMarkdownFile($path)
{
    return strpos($path, MARKDOWN_FILE_EXTENSION);
}
