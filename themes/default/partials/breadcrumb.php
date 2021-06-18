<?php
# Breadcrumb(s) of a page.
#
# This layout is applicable to all pages in mdcms sites
#  - home page, sections and posts.


# Take global data.
$breadcrumb = $GLOBALS[MDCMS_BREADCRUMB];
?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">

        <?php
        $len = count($breadcrumb);
        for ($i = 0; $i < $len; ++$i) {
            if ($i < $len - 1) {
                echo "<li class=\"breadcrumb-item\">";
                    echo "<a href=\"" . $breadcrumb[$i][MDCMS_LINK_PATH] . "\">"
                        . $breadcrumb[$i][MDCMS_LINK_TITLE] . "</a>";
                echo "</li>";
            }
            else {
                echo "<li class=\"breadcrumb-item active\" aria-current=\"page\">"
                    . $breadcrumb[$i][MDCMS_LINK_TITLE]
                    . "</li>";
            }
        }
        ?>

    </ol>
</nav>
