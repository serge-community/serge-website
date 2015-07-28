<?php
    $section = 'parser-plugins';
    $subpage = 'ref-plugin-parse_js';
    $title = 'Generic JavaScript Object Parser Plugin';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');
?>

<h1><?php echo htmlspecialchars($title) ?></h1>

<p>Plugin source location: <code>&lt;serge_root&gt;/lib/Serge/Engine/Plugin/parse_js.pm</code></p>

<p>This plugin is used to parse JavaScript object properties in <code>"key" : "value"</code> format. Whitespace before and afer colon is ignored. Each key-value pair must be on its own line.</p>

<p>Note that this parser supports only a subset of syntax and does no validation. It is targeted for arbitrary JavaScript files. If your resource file is rather a well-formed JSON that can be strictly validated, it is recommended to use the <a href="/docs/plugins/parser/parse_json_keyvalue/">parse_json_keyvalue</a> plugin instead.</p>

<h2>Code Examples</h2>

<figure>
    <figcaption>example.js</figcaption>
    <code class="block">var localizations = {
    "<span class="hint">key1</span>" : "<span class="string">string</span>",
    "<span class="hint">key2</span>": "<span class="string">string</span>",
    "<span class="hint">key3</span>":"<span class="string">string</span>",
    //...
};
</code>
</figure>

<p class="notice">Limitation: both key and value need to double-quoted. Single-quoted strings are not supported. Multi-line strings are not supported as well.</p>

<h2>Usage</h2>

<figure>
    <figcaption>example-project.serge</figcaption>
    <script language="text/x-config-neat">
jobs
{
    :sample-job
    {
        parser
        {
            plugin               parse_js
        }

        # other job parameters
        # ...
    }
}
</script>
</figure>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-footer.php') ?>