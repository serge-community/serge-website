<?php
    $section = 'parser-plugins';
    $subpage = 'ref-plugin-parse_key_space_value';
    $title = 'Plain Key-Space-Value String Parser';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');
?>

<h1><?php echo htmlspecialchars($title) ?></h1>

<p>Plugin source location: <code>&lt;serge_root&gt;/lib/Serge/Engine/Plugin/parse_key_space_value.pm</code></p>

<p>This plugin is used to parse resource files in <code>key<em>&lt;space&gt;</em>value</code> format. The first occurrence of space or tab character after the first non-whitespace character is used as a delimiter. Whitespace around key and value is ignored. Each key-value pair must be on its own line.</p>

<p>In the output, all line breaks in translations are replaced with <code>\n</code>.</p>

<h2>Code Examples</h2>

<figure>
    <figcaption>example.txt</figcaption>
    <code class="block"><span class="hint">key1</span> <span class="string">string</span>
    <span class="hint">key2</span>    <span class="string">string</span>
<span class="hint">key3</span> <span class="string">string</span>
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
        parser
        {
            plugin               parse_key_space_value
        }

        # other job parameters
        # ...
    }
}
</script>
</figure>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-footer.php') ?>