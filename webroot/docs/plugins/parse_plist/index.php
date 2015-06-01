<?php
    $section = 'parser-plugins';
    $subpage = 'ref-plugin-parse_plist';
    $title = 'Mac OS .plist Parser Plugin';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');
?>

<h1><?php echo htmlspecialchars($title) ?></h1>

<p>This plugin is used to parse <a href="https://developer.apple.com/library/mac/documentation/Darwin/Reference/ManPages/man5/plist.5.html">Apple .plist XML files</a>.</p>

<h2>Code Examples</h2>

<figure>
    <figcaption>example.plist</figcaption>
    <code class="block">&lt;dict&gt;
    &lt;key&gt;<span class="hint">key1</span>&lt;/key&gt;
    &lt;string&gt;<span class="string">string 1</span>&lt;/string&gt;
    &lt;key&gt;<span class="hint">key2</span>&lt;/key&gt;
    &lt;string&gt;<span class="string">string 2</span>&lt;/string&gt;
    &lt;key&gt;<span class="hint">key3</span>&lt;/key&gt;
    &lt;array&gt;
        &lt;string&gt;<span class="string">string 3</span>&lt;/string&gt;
        &lt;string&gt;<span class="string">string 4</span>&lt;/string&gt;
    &lt;/array&gt;
&lt;/dict&gt;
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
        plugin               parse_plist

        # other job parameters
        # ...
    }
}
</script>
</figure>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-footer.php') ?>