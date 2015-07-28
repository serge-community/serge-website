<?php
    $section = 'parser-plugins';
    $subpage = 'ref-plugin-parse_strings';
    $title = 'MacOS/iOS .strings Parser Plugin';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');
?>

<h1><?php echo htmlspecialchars($title) ?></h1>

<p>Plugin source location: <code>&lt;serge_root&gt;/lib/Serge/Engine/Plugin/parse_strings.pm</code></p>

<p>This parser extracts strings from Apple MacOS/iOS <a href="https://developer.apple.com/library/ios/documentation/Cocoa/Conceptual/LoadingResources/Strings/Strings.html">string resources</a>.

<p>This plugin supports extracting one-line <code>/* ... */</code> style comments that go immediately above the key-value line, as well as <code>// ...</code> style comments at the end of the key-value line. The comment above, the string key, and the extra comment at the end of the string are combined as a hint.</p>

<p>Also, plugin allows to specify the string context by appending <code>##<em>context</em></code> at the end of the key name (see the example below).</p>

<h2>Code Examples</h2>

<figure>
    <figcaption>Localizable.strings</figcaption>
    <code class="block">/* this comment is not attached to a string */

/* <span class="hint">comment</span> */
"<span class="hint">some key</span>" = "<span class="string">string</span>"

/* <span class="hint">comment</span> */
<span class="hint">some_key</span> = "<span class="string">string</span>" // <span class="hint">extra comment</span>

/* this comment is not attached to a string */

/* <span class="hint">comment</span> */
"<span class="hint">some_key</span>##<span class="context">context</span>" = "<span class="string">string</span>" // <span class="hint">extra comment</span>

...
</code>
</figure>

<p class="notice">Limitation: multi-line comments and key values are not supported yet. Also, <code>\U<em>XXXX</em></code> encoding for Unicode symbols is not supported. It is possible to use final Unicode symbols, though.</p>

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
            plugin               parse_strings
        }

        /*
        .strings always use UTF-16LE output encoding,
        and byte-order-mark (BOM) needs to be present
        in the output file
        */
        output_encoding          UTF-16LE
        output_bom               YES

        # other job parameters
        # ...
    }
}
</script>
</figure>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-footer.php') ?>