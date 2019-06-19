<?php
    $section = 'serializer-plugins';
    $subpage = 'ref-plugin-serialize_xliff';
    $title = '.XLIFF Serializer Plugin';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');

    $available_since = '1.4';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/version-selector.php');
?>

<h1><?php echo htmlspecialchars($title) ?></h1>

<p>Plugin source location: <code>&lt;serge_root&gt;/lib/Serge/Engine/Plugin/serialize_xliff.pm</code></p>

<p>This plugin serializes/parses translation files in <a href="https://docs.oasis-open.org/xliff/xliff-core/xliff-core.html">XLIFF 1.2</a> format. Note that XLIFF 2.x and XLIFF 1.x are two incompatible formats.</p>

<h2>Example</h2>

<figure>
    <figcaption>messages.json.xliff</figcaption>
    <code class="block"><?xml version="1.0" encoding="utf-8"?>&lt;xliff xmlns="urn:oasis:names:tc:xliff:document:1.2" version="1.2"&gt;
    &lt;file datatype="x-unknown" original="messages.json"
        source-language="en" target-language="test"&gt;
        &lt;body&gt;
            &lt;trans-unit approved="yes" id="37881f5ca702bb268877e4edb0edc83d"
                xml:space="preserve"&gt;
                &lt;source xml:lang="en"&gt;Value 1&lt;/source&gt;
                &lt;target state="new" xml:lang="test" /&gt;
                &lt;note from="developer"&gt;Description 1&lt;/note&gt;
                &lt;context-group name="serge" purpose="x-serge"&gt;
                    &lt;context context-type="x-serge-id"&gt;1&lt;/context&gt;
                    &lt;context context-type="x-serge-file-id"&gt;1&lt;/context&gt;
                    &lt;context context-type="x-serge-context"&gt;string1&lt;/context&gt;
                &lt;/context-group&gt;
            &lt;/trans-unit&gt;

            &lt;!-- ... more units go here ... --&gt;

        &lt;/body&gt;
    &lt;/file&gt;
&lt;/xliff&gt;
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
        serializer
        {
            plugin               serialize_xliff
        }

        # other job parameters
        # ...
    }
}
</script>
</figure>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-footer.php') ?>