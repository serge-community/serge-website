<?php
    $section = 'parser-plugins';
    $subpage = 'ref-plugin-parse_pot';
    $title = 'Gettext .PO/.POT Parser Plugin';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');
?>

<h1><?php echo htmlspecialchars($title) ?></h1>

<p>Plugin source location: <code>&lt;serge_root&gt;/lib/Serge/Engine/Plugin/parse_pot.pm</code></p>

<p>This plugin is used to parse <a href="https://www.gnu.org/software/gettext/manual/html_node/PO-Files.html#PO-Files">GNU Gettext .PO/.POT files</a>. Plurals are supported. All comments and references are extracted and combined as a hint.</p>

<h2>Code Examples</h2>

<figure>
    <figcaption>example.pot</figcaption>
    <code class="block">#  <span class="hint">translator-comments</span>
#. <span class="hint">automatic-comments</span>
#: <span class="hint">reference</span>
#, flag
msgid "<span class="string">string</span>"
msgstr ""

#. <span class="hint">comment</span>
msgid "<span class="string">string-singular</span>"
msgid_plural "<span class="string">string-plural</span>"
msgstr[0] ""
msgstr[1] ""
</code>
</figure>

<p class="notice">Limitation: in generated localized .po files, header is not modified. This means that <code>Language:</code> and <code>Plural-Forms:</code> lines in the header, if originally present, will not be changed. If necessary, these headers can now be rewritten by the means of <a href="/docs/plugins/replace_strings/">replace_strings</a> plugin.</p>

<h2>Usage</h2>

<figure>
    <figcaption>example-project.serge</figcaption>
    <script language="text/x-config-neat">
jobs
{
    :sample-job
    {
        plugin               parse_pot

        # other job parameters
        # ...
    }
}
</script>
</figure>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-footer.php') ?>