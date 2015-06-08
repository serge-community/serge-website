<?php
    $section = 'parser-plugins';
    $subpage = 'ref-plugin-parse_properties';
    $title = 'Java JDK .properties (Resource Bundle) Parser Plugin';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');
?>

<h1><?php echo htmlspecialchars($title) ?></h1>

<p>Plugin source location: <code>&lt;serge_root&gt;/lib/Serge/Engine/Plugin/parse_properties.pm</code></p>

<p>This parser extracts strings from files in <a href="http://en.wikipedia.org/wiki/.properties">Java .properties format</a>.</p>

<p>Note that .properties files don't have an official way to provide context or comments for localized strings. This plugin supports special <code>#.flag</code> and <code>#.param=value</code> comment lines that affect the key=value line that goes immediately below it. For example, <code>#.internal</code> allows one to prevent certain strings from being extracted for translation, <code>#.context=value</code> sets the context for the string, and one or more <code>#.comment=comment line</code> lines define a comment that will be extracted and associated with the string. All other (unknown) flags are appended as hashtags to the hint; in other words, <code>#.myhashtag</code> is equivalent to <code>#.comment=#myhashtag</code> line. If there's a blank line between such special comments and a key=value line, these comments are discarded.</p>

<h2>Code Examples</h2>

<figure>
    <figcaption>example.properties</figcaption>
    <code class="block"><span class="hint">key1</span> = <span class="string">string</span>

#.<span class="hint">settings</span>
#.<span class="hint">ui</span>
#.<span class="hint">admin</span>
<span class="hint">key2</span> : <span class="string">string</span>

#.internal
key3 = non-translatable string

#.context=<span class="context">verb</span>
<span class="hint">key4</span> = <span class="string">string</span>

#.comment=<span class="hint">comment line 1</span>
#.comment=<span class="hint">comment line 2</span>
<span class="hint">key5</span> = <span class="string">string</span>

<span class="hint">key6</span> = <span class="string">multi-line \
string</span>
...</code>
</figure>

<h2>Usage</h2>

<figure>
    <figcaption>example-project.serge</figcaption>
    <script language="text/x-config-neat">
jobs
{
    :sample-job
    {
        plugin               parse_properties

        data
        {
            /*
              whether to escape single quotation marks (' => '')
              in localized files; this option is needed because
              there are some inconsistencies between different
              Java frameworks in dealing with escaped quotes.
              Default: NO
            */
            escaped_quotes   YES
        }

        # .properties files generally use Java encoding
        output_encoding      Java

        # other job parameters
        # ...
    }
}
</script>
</figure>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-footer.php') ?>