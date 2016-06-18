<?php
    $section = 'serializer-plugins';
    $subpage = 'ref-plugin-serialize_po';
    $title = '.PO Serializer Plugin';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');

    $available_since = '1.2';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/version-selector.php');
?>

<h1><?php echo htmlspecialchars($title) ?></h1>

<p>Plugin source location: <code>&lt;serge_root&gt;/lib/Serge/Engine/Plugin/serialize_po.pm</code></p>

<p>This plugin serializes/parses translation files in <a href="https://www.gnu.org/software/gettext/manual/html_node/PO-Files.html">.PO format</a> (used in GNU gettext toolchain). This is a default serializer: if you omit entire <code>serializer</code> job config section (see below), this plugin will be used.</p>

<h2>Usage</h2>

<figure>
    <figcaption>example-project.serge</figcaption>
    <script language="text/x-config-neat">
jobs
{
    :sample-job
    {
        # this entire `serializer` block is optional,
        # since serialize_po is a default plugin
        serializer
        {
            plugin               serialize_po
        }
        # end of the optional block

        # other job parameters
        # ...
    }
}
</script>
</figure>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-footer.php') ?>