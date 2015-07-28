<?php
    $section = 'parser-plugins';
    $subpage = 'ref-plugin-parse_xliff';
    $title = 'XLIFF Parser Plugin';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');
?>

<h1><?php echo htmlspecialchars($title) ?></h1>

<p>Plugin source location: <code>&lt;serge_root&gt;/lib/Serge/Engine/Plugin/parse_xliff.pm</code></p>

<p>This plugin is used to parse XLIFF 1.x and XLIFF 2.x documents (a subset thereof). Parser doesn't do any strict XLIFF validation, and only requires some basic structure as shown in the examples below. In the translated document, Plugin will add <code>&lt;target&gt;...&lt;/target&gt;</code> nodes with translations, as well as set proper <code>target-language="<em>LANGUAGE</em>"</code> attribute on each <code>&lt;file&gt;</code> tag.</p>

<p>In case XML format validation fails, the plugin can send an error report to specified recipients. If no email settings are provided, it will simply report the error in the console output.</p>

<h2>Code Example (XLIFF 1.x)</h2>

<figure>
    <figcaption>sample_version_1.0.xliff</figcaption>
    <code class="block">&lt;?xml version="1.0" encoding="UTF-8"?&gt;
&lt;xliff version="1.0"&gt;

    &lt;file original="<span class="hint">sample1.txt</span>" source-language="en"&gt;
        &lt;body&gt;
            &lt;trans-unit id="<span class="hint">foo</span>"&gt;
                &lt;source&gt;<span class="string">Foo</span>&lt;/source&gt;
            &lt;/trans-unit&gt;
            &lt;trans-unit id="<span class="hint">bar</span>"&gt;
                &lt;source&gt;<span class="string">Bar</span>&lt;/source&gt;
            &lt;/trans-unit&gt;
        &lt;/body&gt;
    &lt;/file&gt;

    &lt;file original="<span class="hint">sample2.txt</span>" source-language="en"&gt;
        &lt;header&gt;
            &lt;note&gt;<span class="hint">File-related comment</span>&lt;/note&gt;
        &lt;/header&gt;
        &lt;body&gt;
            &lt;group id="<span class="hint">mygroup</span>"&gt;
                &lt;note&gt;<span class="hint">Group-related comment 1</span>&lt;/note&gt;
                &lt;note&gt;<span class="hint">Group-related comment 2</span>&lt;/note&gt;
                &lt;trans-unit id="<span class="hint">foo2</span>"&gt;
                    &lt;source&gt;<span class="string">Foo2 &lt;x xid="bar2"/&gt;</span>&lt;/source&gt;
                &lt;/trans-unit&gt;
                &lt;trans-unit id="<span class="hint">bar2</span>"&gt;
                    &lt;note&gt;<span class="hint">Unit-related comment</span>&lt;/note&gt;
                    &lt;source&gt;<span class="string">Bar2</span>&lt;/source&gt;
                &lt;/trans-unit&gt;
            &lt;/group&gt;
        &lt;/body&gt;
    &lt;/file&gt;

&lt;/xliff&gt;
</code>
</figure>

<p class="notice">Limitation: All inline elements inside <code>&lt;source&gt;...&lt;/source&gt;</code> will be exposed as a raw XML string for translation.</p>

<p>Original file names, as well as group and unit identifier are extracted and combined into a single hint, along with file- group- and unit-level notes. Given the example above, the final hint for string <code><span class="string">Bar2</span></code> will look like this:</p>
<code class="block">file-original:sample2.txt group-id:mygroup unit-id:bar2

File note: File-related comment

Group note: Group-related comment 1

Group note: Group-related comment 2

Unit note: Unit-related comment</code>

<h2>Code Example (XLIFF 2.x)</h2>

<figure>
    <figcaption>sample_version_2.0.xliff</figcaption>
    <code class="block">&lt;?xml version="1.0" encoding="UTF-8"?&gt;
&lt;xliff version="2.0"&gt;

    &lt;file original="<span class="hint">sample1.txt</span>" source-language="en"&gt;
        &lt;header/&gt;
        &lt;body&gt;
            &lt;unit id="<span class="hint">foo</span>"&gt;
                &lt;source&gt;<span class="string">Foo</span>&lt;/source&gt;
            &lt;/unit&gt;
            &lt;unit id="<span class="hint">bar</span>"&gt;
                &lt;source&gt;<span class="string">Bar</span>&lt;/source&gt;
            &lt;/unit&gt;
        &lt;/body&gt;
    &lt;/file&gt;

    &lt;file original="<span class="hint">sample2.txt</span>" source-language="en"&gt;
        &lt;notes&gt;
            &lt;note&gt;<span class="hint">File-related comment 1</span>&lt;/note&gt;
            &lt;note&gt;<span class="hint">File-related comment 2</span>&lt;/note&gt;
        &lt;/notes&gt;
        &lt;body&gt;
            &lt;group id="<span class="hint">mygroup</span>"&gt;
                &lt;notes&gt;
                    &lt;note&gt;<span class="hint">Group-related comment</span>&lt;/note&gt;
                &lt;/notes&gt;
                &lt;unit id="<span class="hint">foo2</span>"&gt;
                    &lt;source&gt;<span class="string">Foo2 &lt;ph id="1" dataRef="bar2" /&gt;</span>&lt;/source&gt;
                &lt;/unit&gt;
                &lt;unit id="<span class="hint">bar2</span>"&gt;
                    &lt;notes&gt;
                        &lt;note&gt;<span class="hint">Unit-related comment</span>&lt;/note&gt;
                    &lt;/notes&gt;
                    &lt;segment&gt;
                        &lt;source&gt;<span class="string">Bar2</span>&lt;/source&gt;
                    &lt;/segment&gt;
                    &lt;ignorable&gt;Baz2&lt;/ignorable&gt;
                    &lt;segment&gt;
                        &lt;source&gt;<span class="string">Etc2</span>&lt;/source&gt;
                    &lt;/segment&gt;
                &lt;/unit&gt;
            &lt;/group&gt;
        &lt;/body&gt;
    &lt;/file&gt;

&lt;/xliff&gt;
</code>
</figure>

<p class="notice">Limitation: All inline elements inside <code>&lt;source&gt;...&lt;/source&gt;</code> will be exposed as a raw XML string for translation.</p>

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
            plugin               parse_xliff

            data
            {
                /*
                (STRING) [OPTIONAL] Email to send
                error reports on behalf of
                */
                email_from       l10n-robot@acme.org

                /*
                (ARRAY) [OPTIONAL] One or more email
                addresses to send error reports to
                */
                email_to         engineer@acme.org
                                 project-manager@acme.org

                /*
                (STRING) [OPTIONAL] Email subject
                */
                email_subject    Errors found in XLIFF file
            }
        }

        # other job parameters
        # ...
    }
}
</script>
</figure>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-footer.php') ?>
