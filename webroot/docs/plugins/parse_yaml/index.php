<?php
    $section = 'parser-plugins';
    $subpage = 'ref-plugin-parse_yaml';
    $title = 'Generic YAML Tree Parser Plugin';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');
?>

<h1><?php echo htmlspecialchars($title) ?></h1>

<p>Plugin source location: <code>&lt;serge_root&gt;/lib/Serge/Engine/Plugin/parse_yaml.pm</code></p>

<p>This plugin is used to extract localizable strings from arbitrary YAML data structures (typically used to localize <a href="http://guides.rubyonrails.org/i18n.html#adding-translations">Ruby On Rails applications</a>).</p>

<p>In case YAML format validation fails, the plugin can send an error report to specified recipients. If no email settings provided, it will simply report the error in the console output.</p>

<h2>Code Examples</h2>

<figure>
    <figcaption>messages.yml</figcaption>
    <code class="block"><span class="hint">en</span>:
    <span class="hint">messages</span>:
        <span class="hint">key1</span>: <span class="string">string</span>
        <span class="hint">key2</span>: <span class="string">string</span>
        <span class="hint">plural_message</span>:
            <span class="hint">one</span>: <span class="string">string</span>
            <span class="hint">other</span>: <span class="string">string</span>
</code>
</figure>

<p>For each extracted translatable string, parser builds the full key path (e.g. <code>en/messages/key1</code> or <code>en/messages/plural_message/one</code>) and uses that as a hint provided along with the string.</p>

<p class="notice">Limitation: dynamic number of plurals is not supported yet; all quantity variants need to be pre-created in the original YML resource file, and they are extracted as individual translatable units.</p>

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
            plugin                   parse_yaml

            data
            {
                /*
                (BOOLEAN) [OPTIONAL] Should the parser
                expand aliases (named anchors and references)
                before extracting text for translation?

                Default is NO (anchors and references are not
                expanded and just skipped).

                Set this value to YES if you need to
                translate the referenced blocks of text
                differently depending on the context;

                Set this value to NO if all references
                need to stay intact, and translations to be
                reused between references.
                */
                expand_aliases       NO

                /*
                (STRING) [OPTIONAL] Email to send
                error reports on behalf of
                */
                email_from         l10n-robot@acme.org

                /*
                (ARRAY) [OPTIONAL] One or more email
                addresses to send error reports to
                */
                email_to           engineer@acme.org
                                   project-manager@acme.org

                /*
                (STRING) [OPTIONAL] Email subject
                */
                email_subject        Errors found in XML file
            }
        }

        # other job parameters
        # ...
    }
}
</script>
</figure>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-footer.php') ?>