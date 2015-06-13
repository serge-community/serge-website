<?php
    $section = 'parser-plugins';
    $subpage = 'ref-plugin-parse_resx';
    $title = '.Net .resx Parser Plugin';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');
?>

<h1><?php echo htmlspecialchars($title) ?></h1>

<p>Plugin source location: <code>&lt;serge_root&gt;/lib/Serge/Engine/Plugin/parse_resx.pm</code></p>

<p>This parser extracts strings from <a href="https://msdn.microsoft.com/en-us/library/ekyft91f%28v=VS.90%29.aspx">.Net Framework .RESX files</a>. String names (keys) are extracted as hints.</p>

<h2>Code Examples</h2>

<figure>
    <figcaption>example.resx</figcaption>
    <code class="block">&lt;root&gt;
    &lt;data name="<span class="hint">name_1</span>" ...&gt;
        &lt;value&gt;<span class="string">string</span>&lt;/value&gt;
    &lt;/data&gt;

    &lt;data name="<span class="hint">name_2</span>" ...&gt;
        &lt;value&gt;<span class="string">string</span>&lt;/value&gt;
    &lt;/data&gt;

    ...
&lt;/root&gt;
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
            plugin               parse_resx
        }

        # other job parameters
        # ...
    }
}
</script>
</figure>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-footer.php') ?>