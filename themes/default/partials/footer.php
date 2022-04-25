<?php
# Footer of a mdcms theme.
#
# Currently, there is no real footer part in rendered pages.
#  This PHP script is merely for Javascript program loading.
?>

<!-- Native JavaScript for Bootstrap -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap.native/4.1.2/bootstrap-native.min.js"
    integrity="sha512-7l4X3SXR3kqMxOQHrq0SoLYe58UnkkwZSQfTyCOuSVGi5HD0oNgRQVehosJaPwSrnwQdXySXKGap3hrdnJ1mdw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<?php if (!is_null(ENABLE_CODE_HIGHTLIGHT) && ENABLE_CODE_HIGHTLIGHT): ?>
<!-- highlight.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.5.1/highlight.min.js"
    integrity="sha512-yUUc0qWm2rhM7X0EFe82LNnv2moqArj5nro/w1bi05A09hRVeIZbN6jlMoyu0+4I/Bu4Ck/85JQIU82T82M28w=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.5.1/languages/nginx.min.js"
    integrity="sha512-nDPHnJC9UzEA9gBTo7iM80VLTYHcPhBR1v843vUHjolbM8ZKUn+cV0o4DbVd3tgqVd7Hnb6/yUARchFYk/RjaQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- Add more highlight.js language module(s) as needed. -->
<script>hljs.highlightAll();</script>
<?php endif; ?>

<!-- Add more third-party scripts here. -->

<!-- Initialize some variables used in our JavaScript program.
      Set them before calling site-specific scripts. -->
<?php
# The variable will be a JavaScript string.
$enableFixedSidebar = "false";
if (!is_null(ENABLE_FIXED_SIDEBAR) && ENABLE_FIXED_SIDEBAR) {
    $enableFixedSidebar = "true";
}
?>
<script>
    var enableFixedSidebar = <?php echo $enableFixedSidebar; ?>;
</script>

<!-- A site-specific script -->
<script src="/js/site.js"></script>

<!-- Add more site-specific scripts here. -->
