<?php
    $section = 'parser-plugins';
    $subpage = 'ref-plugin-parse_default';
    $title = 'Default Parser Plugin';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');
?>

<h1><?php echo htmlspecialchars($title) ?></h1>

<p>Plugin source location: <code>&lt;serge_root&gt;/lib/Serge/Engine/Plugin/parse_default.pm</code></p>

<p>This is a parser for a markup meta-format that can be applied on top of any text file. This format uses <code>&lt;%</code> and <code>%&gt;</code> as start and end markers, and <code>%%</code> as a separator between the string, context, hint, and flag components.</p>
<p>It is recommended that the master files which have this markup applied to get an extra <code>.master</code> extension. Examples: <code>readme.txt<em>.master</em></code>, <code>subtitles.srt<em>.master</em></code>, and so on.</p>

<h2>Code Examples</h2>

<figure>
    <figcaption>example.txt.master</figcaption>
    <code class="block">This is a plain text file which has some localizable strings
in random places.

Here we have only string component:
&lt;%<span class="string">string</span>%&gt;

Here we have string and context specified:
&lt;%<span class="string">string</span>%%<span class="context">context</span>%&gt;

Here we have string, context and hint (comment) specified:
&lt;%<span class="string">string</span>%%<span class="context">context</span>%%<span class="hint">hint</span>%&gt;

The fourth optional parameter is a comma-separated set of flags
&lt;%<span class="string">string</span>%%<span class="context">context</span>%%<span class="hint">hint</span>%%<span class="flags">pad,70,normalize</span>%&gt;

One can skip any optional parameters;
here context part is skipped (empty):
&lt;%<span class="string">string</span>%%%%<span class="hint">hint</span>%&gt;
</code>
</figure>

<h2>Supported Flags in Serge</h2>
<dl>
    <dt><code>normalize</code></dt>
    <dd>Force enable string normalization (overrides the per-job <code>normalize_strings</code> setting).</dd>

    <dt><code>dont-normalize</code></dt>
    <dd>Force disable string normalization (overrides the per-job <code>normalize_strings</code> setting).</dd>

    <dt><code>pad,N</code></dt>
    <dd>Pad string to N symbols.</dd>
</dl>

<h2>Usage</h2>

<figure>
    <figcaption>example-project.serge</figcaption>
    <script language="text/x-config-neat">
jobs
{
    :sample-job
    {
        plugin               parse_default

        # other job parameters
        # ...
    }
}
</script>
</figure>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-footer.php') ?>