<?php
    $section = 'parser-plugins';
    $subpage = 'ref-plugin-parse_rrc';
    $title = 'Blackberry .RRC Parser Plugin';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');
?>

<h1><?php echo htmlspecialchars($title) ?></h1>

<p>Plugin source location: <code>&lt;serge_root&gt;/lib/Serge/Engine/Plugin/parse_rrc.pm</code></p>

<p>This parser extracts strings from <a href="https://msdn.microsoft.com/en-us/library/ekyft91f%28v=VS.90%29.aspx">Blackberry .RRC resource files</a>. String keys are extracted as hints.</p>

<h2>Code Examples</h2>

<figure>
    <figcaption>example.rrc</figcaption>
    <code class="block"><span class="hint">KEY_1</span>#0="<span class="string">string</span>";
<span class="hint">KEY_2</span>#0="<span class="string">string</span>";
<span class="hint">KEY_3</span>#0="<span class="string">string</span>";
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
        plugin               parse_rrc

        # .RRC files always use Java encoding
        output_encoding      Java

        # other job parameters
        # ...
    }
}
</script>
</figure>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-footer.php') ?>