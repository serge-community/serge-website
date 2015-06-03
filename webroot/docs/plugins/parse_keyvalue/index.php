<?php
    $section = 'parser-plugins';
    $subpage = 'ref-plugin-parse_keyvalue';
    $title = 'Plain Key=Value String Parser';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');
?>

<h1><?php echo htmlspecialchars($title) ?></h1>

<p>Plugin source location: <code>&lt;serge_root&gt;/lib/Serge/Engine/Plugin/parse_keyvalue.pm</code></p>

<p>This plugin is used to parse resource files in <code>key=value</code> format. The first occurrence of <code>=</code> is used as a delimiter. Whitespace before and afer the delimiter is ignored. Each key-value pair must be on its own line.</p>

<p>In the output, all line breaks in translations are replaced with <code>\n</code>.</p>

<h2>Code Examples</h2>

<figure>
    <figcaption>example.js</figcaption>
    <code class="block"><span class="hint">key1</span> = <span class="string">string</span>
<span class="hint">key2</span>= <span class="string">string</span>
<span class="hint">key3</span>=<span class="string">string</span>
...
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
        plugin               parse_keyvalue

        # other job parameters
        # ...
    }
}
</script>
</figure>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-footer.php') ?>