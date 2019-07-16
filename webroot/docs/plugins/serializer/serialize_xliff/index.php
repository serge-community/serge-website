<?php
    $section = 'serializer-plugins';
    $subpage = 'ref-plugin-serialize_xliff';
    $title = '.XLIFF Serializer Plugin';

    $extra_head = '
        <script src="/media/vendor/codemirror/mode/xml.js"></script>
        <link rel="stylesheet" href="/media/xml/xml.css" />
        <script src="/media/xml/colorize_config.js"></script>
    ';

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
    <script language="text/xml"><?xml version="1.0" encoding="utf-8"?>
<xliff xmlns="urn:oasis:names:tc:xliff:document:1.2" version="1.2">
    <file datatype="x-unknown" original="messages.json"
        source-language="en" target-language="test">
        <body>
            <trans-unit approved="yes" id="37881f5ca702bb268877e4edb0edc83d"
                xml:space="preserve">
                <source xml:lang="en">Value 1</source>
                <target state="new" xml:lang="test" />
                <note from="developer">Description 1</note>
                <context-group name="serge" purpose="x-serge">
                    <context context-type="x-serge-id">1</context>
                    <context context-type="x-serge-file-id">1</context>
                    <context context-type="x-serge-context">string1</context>
                </context-group>
            </trans-unit>

            <!-- ... more units go here ... -->

        </body>
    </file>
</xliff>
</script>
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