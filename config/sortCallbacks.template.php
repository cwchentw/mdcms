<?php
# Sort callbacks for a site.


# Callback to sort sections.
define("SORT_SECTION_CALLBACK", "sort-section-callback");
$GLOBALS[SORT_SECTION_CALLBACK] = function ($a, $b) {
    # Sort two sections by their weights.
    if (array_key_exists(LIGHTWEIGHT_CMS_SECTION_WEIGHT, $a)
        && array_key_exists(LIGHTWEIGHT_CMS_SECTION_WEIGHT, $b))
    {
        $wa = $a[LIGHTWEIGHT_CMS_SECTION_WEIGHT];
        $wb = $b[LIGHTWEIGHT_CMS_SECTION_WEIGHT];

        if ($wa < $wb) {
            return -1;
        }
        else if ($wa == $wb) {
            return 0;
        }
        else {
            return 1;
        }
    }

    # Sort two sections by their titles.
    if (array_key_exists(LIGHTWEIGHT_CMS_SECTION_TITLE, $a)
        && array_key_exists(LIGHTWEIGHT_CMS_SECTION_TITLE, $b))
    {
        $ta = $a[LIGHTWEIGHT_CMS_SECTION_TITLE];
        $tb = $b[LIGHTWEIGHT_CMS_SECTION_TITLE];

        return strcasecmp($ta, $tb);
    }

    # They are equal, which is seldom the case.
    return 0;
};

# Callback to sort posts.
define("SORT_POST_CALLBACK", "sort-post-callback");
$GLOBALS[SORT_POST_CALLBACK] = function ($a, $b) {
    # Sort two posts by their weights.
    if (array_key_exists(LIGHTWEIGHT_CMS_POST_WEIGHT, $a)
        && array_key_exists(LIGHTWEIGHT_CMS_POST_WEIGHT, $b))
    {
        $wa = $a[LIGHTWEIGHT_CMS_POST_WEIGHT];
        $wb = $b[LIGHTWEIGHT_CMS_POST_WEIGHT];

        if ($wa < $wb) {
            return -1;
        }
        else if ($wa == $wb) {
            return 0;
        }
        else {
            return 1;
        }
    }

    # Sort two posts by their modified time.
    #  Your should always set a mtime in metadata
    #  region of posts.
    if (array_key_exists(LIGHTWEIGHT_CMS_POST_MTIME, $a)
        && array_key_exists(LIGHTWEIGHT_CMS_POST_MTIME, $b))
    {
        $ma = $a[LIGHTWEIGHT_CMS_POST_MTIME];
        $mb = $b[LIGHTWEIGHT_CMS_POST_MTIME];

        if ($ma < $mb) {
            return -1;
        }
        else if ($ma == $mb) {
            return 0;
        }
        else {
            return 1;
        }
    }

    # Sort two posts by their titles.
    if (array_key_exists(LIGHTWEIGHT_CMS_POST_TITLE, $a)
        && array_key_exists(LIGHTWEIGHT_CMS_POST_TITLE, $b))
    {
        $ta = $a[LIGHTWEIGHT_CMS_POST_TITLE];
        $tb = $b[LIGHTWEIGHT_CMS_POST_TITLE];

        return strcasecmp($ta, $tb);
    }

    # They are equal, which is seldom the case.
    return 0;
};
