<?php
    $section = 'parser-plugins';
    $subpage = 'ref-plugin-parse_json_keyvalue';
    $title = 'JSON Dictionary Parser Plugin';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');
?>

<h1><?php echo htmlspecialchars($title) ?></h1>

<p>Plugin source location: <code>&lt;serge_root&gt;/lib/Serge/Engine/Plugin/parse_json_keyvalue.pm</code></p>

<p>This plugin is used to parse plain JSON objects (dictionaries) in <code>"key" : "value"</code> format.</p>

<p>Note that this parser does full JSON parsing/validation, and thus can be used on JSON only. If you have dictionaries in arbitrary JavaScript file, use the <a href="/docs/plugins/parse_js">parse_js</a> plugin instead. If your JSON has an arbitrary structure, see the <a href="/docs/plugins/parse_json">parse_json</a> plugin that gives more flexibility on what nodes to translate.</p>

<p>In case JSON format validation fails, the plugin can send an error report to specified recipients. If no email settings provided, it will simply report the error in the console output.</p>

<h2>Code Examples</h2>

<figure>
    <figcaption>example.json</figcaption>
    <code class="block">{
    "<span class="hint">key1</span>": "<span class="string">string</span>",
    "<span class="hint">key2</span>": "<span class="string">string</span>",
    "<span class="hint">key3</span>": "<span class="string">string</span>",
    //...
}
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
        parser
        {
            plugin               parse_json_keyvalue

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
                email_subject    Errors found in JSON file
            }
        }

        # other job parameters
        # ...
    }
}
</script>
</figure>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-footer.php') ?>