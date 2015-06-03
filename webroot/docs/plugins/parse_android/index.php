<?php
    $section = 'parser-plugins';
    $subpage = 'ref-plugin-parse_android';
    $title = 'Android strings.xml Parser Plugin';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');
?>

<h1><?php echo htmlspecialchars($title) ?></h1>

<p>Plugin source location: <code>&lt;serge_root&gt;/lib/Serge/Engine/Plugin/parse_android.pm</code></p>

<p>This plugin extracts strings from <a href="http://developer.android.com/guide/topics/resources/string-resource.html">Android resource files</a> (strings.xml). String names (IDs) are extracted as translation hints. Tags that bear <code>translatable="false"</code> attribute are skipped. Plugin handles Android-specific escaping of apostrophes and quotation marks.</p>

<h2>Code Examples</h2>

<h3>Simple Strings</h3>

<figure>
    <figcaption>strings.xml</figcaption>
    <code class="block">&lt;string name="<span class="hint">hint</span>" ...&gt;<span class="string">string</span>&lt;/string&gt;</code>
</figure>

<h3>String Arrays</h3>

<p>To provide better context and indicate that string comes from an array, the resulting hint is constructed as <code><span class="hint">hint</span>:item</code>.</p>

<figure>
    <figcaption>strings.xml</figcaption>
    <code class="block">&lt;string-array name="<span class="hint">hint</span>" ...&gt;
  &lt;item&gt;<span class="string">string</span>&lt;/item&gt;
  ...
&lt;/string-array&gt;</code>
</figure>

<h3>Plural Strings</h3>

<p>For plural strings, hint is extracted from both parent <code>&lt;plurals&gt;</code> tag and individual quantity value; the resulting hint is constructed as <code><span class="hint">parent_hint</span>:<span class="hint">quantity_hint</span></code>.</p>

<figure>
    <figcaption>strings.xml</figcaption>
    <code class="block">&lt;plurals name="<span class="hint">parent_hint</span>" ...&gt;
  &lt;item quantity="<span class="hint">quantity_hint</span>"&gt;<span class="string">string</span>&lt;/item&gt;
  ...
&lt;/plurals&gt;</code>
</figure>

<p class="notice">Limitation: dynamic number of plurals is not supported yet; all quantity variants need to be pre-created in the original XML resource file.</p>

<h2>Usage</h2>

<figure>
    <figcaption>example-project.serge</figcaption>
    <script language="text/x-config-neat">
jobs
{
    :sample-job
    {
        plugin               parse_android

        # other job parameters
        # ...
    }
}
</script>
</figure>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-footer.php') ?>