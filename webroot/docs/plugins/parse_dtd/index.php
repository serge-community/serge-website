<?php
    $section = 'parser-plugins';
    $subpage = 'ref-plugin-parse_dtd';
    $title = '.DTD Entities Parser Plugin';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');
?>

<h1><?php echo htmlspecialchars($title) ?></h1>

<p>Plugin source location: <code>&lt;serge_root&gt;/lib/Serge/Engine/Plugin/parse_dtd.pm</code></p>

<p>This plugin is used to parse .DTD files with entities, which are typically used to <a href="https://developer.mozilla.org/en-US/docs/Mozilla/Localization/Localizing_an_extension">localize Mozilla extensions</a>. Entity names are extracted as hints.</p>

<h2>Code Examples</h2>

<figure>
    <figcaption>example.dtd</figcaption>
    <code class="block">&lt;!ENTITY <span class="hint">key1</span> "<span class="string">string</span>"&gt;
&lt;!ENTITY <span class="hint">key2</span> "<span class="string">string</span>"&gt;
</code>
</figure>

<h2>Usage</h2>

<figure>
    <figcaption>example-project.serge</figcaption>
    <script language="text/x-config-neat">
jobs
{
    :sample-job
    {
        plugin               parse_dtd

        # other job parameters
        # ...
    }
}
</script>
</figure>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-footer.php') ?>