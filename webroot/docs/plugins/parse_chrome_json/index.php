<?php
    $section = 'parser-plugins';
    $subpage = 'ref-plugin-parse_chrome_json';
    $title = 'Chrome Extension messages.json Parser Plugin';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');
?>

<h1><?php echo htmlspecialchars($title) ?></h1>

<p>This parser extracts strings from Chrome extension <a href="https://developer.chrome.com/extensions/i18n-messages">messages.json format</a>.</p>

<p>In case JSON format validation fails, the plugin can send an error report to specified recipients. If no email settings provided, it will simply report the error in the console output.</p>

<h2>Code Examples</h2>

<figure>
    <figcaption>messages.json</figcaption>
    <code class="block">{
    "some_key": {
        "message": "<span class="string">string</span>",
        "description": "<span class="hint">hint</span>"
    },
    "another_key": {
        "message": "<span class="string">string</span>",
        "description": "<span class="hint">hint</span>"
    },
    ...
}</code>
</figure>

<h2>Usage</h2>

<figure>
    <figcaption>sample-chrome-json-project.conf</figcaption>
    <script language="text/x-config-neat">
jobs
{
    :sample-job
    {
        plugin               parse_chrome_json

        data
        {
            # email to send error reports on behalf of
            email_from       l10n-robot@acme.org

            # one or more email addresses
            # to send error reports to
            email_to         chrome-engineer@acme.org
                             chrome-project-manager@acme.org

            # email subject
            email_subject    Errors found in messages.json
        }

        # other job parameters
        # ...
    }
}
</script>
</figure>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-footer.php') ?>

