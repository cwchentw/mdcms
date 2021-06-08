<?php
# The sitemap.xml generator of mdcms.

# Get global setting.
require_once __DIR__ . "/../../setting.php";

# Load required library.
require_once __DIR__ . "/../../" . LIBRARY_DIRECTORY . "/autoload.php";


$xml = new DOMDocument("1.0", "UTF-8");

# Pretty printing is not required because sitemap.xml is read by search engine bots.
#$xml->formatOutput = true;

$urlset = $xml->createElement("urlset");
$urlset->setAttribute("xmlns", "http://www.sitemaps.org/schemas/sitemap/0.9");

$links = \mdcms\getAllLinks("/");

foreach ($links as $link) {
    $node = $xml->createElement("url");

    $url = SITE_BASE_URL . $link[MDCMS_LINK_PATH];
    $loc = $xml->createElement("loc", $url);
    $node->appendChild($loc);

    $mtime = $xml->createElement("lastmod", date("Y-m-d", $link[MDCMS_LINK_MTIME]));
    $node->appendChild($mtime);

    # Currently, we simply hard code the frequency of document change.
    # Search engines don't always follow this attribute.
    $changefreq = $xml->createElement("changefreq", "monthly");
    $node->appendChild($changefreq);

    $urlset->appendChild($node);
}

$xml->appendChild($urlset);

# Render sitemap.xml
echo $xml->saveXML();
