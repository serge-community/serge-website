<?php
    $section = 'callback-plugins';
    $subpage = 'ref-plugin-append_hint_message';
    $title = 'Plugin to Append Extra Message to a Hint';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');
?>

<h1><?php echo htmlspecialchars($title) ?></h1>

<p>Plugin source location: <code>&lt;serge_root&gt;/lib/Serge/Engine/Plugin/append_hint_message.pm</code></p>

<p>Plugin always attaches itself to the following callback phase: <code><a href="/docs/dev/callbacks/#add_dev_comment">add_dev_comment</a></code>.</p>

<p>Adding a hint allows you to provide better context to translators. It can include, for example, links to a preview server, or some hashtags to help translators find similar messages. This plugin is used to append an arbitrary message to a hint associated with the translatable string. Message is added to the end of the existing hint message and is separated with two line breaks (so it looks like a new 'paragraph'). You can use multiple entries for this plugin in <code>callback_plugins</code> section if you want to add several 'paragraphs'. Multi-line hint is then exported as a developer's comment in generated translation file, and is generally displayed to translators within their translation environment.</p>

<p>This plugin inherits all the configuration logic from the parent <a href="/docs/plugins/callback/if/">'if' plugin</a> and, if all conditions are met, appends a hint message. Note that all <code>if</code> conditions are optional: if none are provided, the hint message will be always added.</p>

<p>In the context of <code>if</code> conditions, the <code>content_matches</code> and <code>content_doesnt_match</code> rules work against the source string (not the entire file).</p>

<p>When configuring the plugin, you can include macros in hint <code>message</code> parameter, see below. These macros will be expanded to their actual values. Having macros allows one to construct preview links pointing to a specific target file, or to a help page for a specific file extension. See <a href="/docs/configuration-files/reference/">Configuration File Reference</a> for the list of available macros.</p>

<h2>Usage</h2>

<figure>
    <figcaption>example-project.serge</figcaption>
    <script language="text/x-config-neat">
jobs
{
    :sample-job
    {
        callback_plugins
        {
            :sample-preview-link
            {
                plugin               append_hint_message

                data
                {
                    /*
                    (STRING) Message to append to a hint.
                    You can use macros in the message text;
                    See Serge configuration file format
                    reference.
                    */
                    message          Preview:
                                     https://my-preview-site/%PATH%
                }
            }

            :sample-file-format-help-link
            {
                plugin               append_hint_message

                data
                {
                    message          Help on %EXT% file format:
                                     https://my-help-site/%EXT%
                }
            }

            :conditional-help-link
            {
                plugin               append_hint_message

                data
                {
                    if
                    {
                        file_matches    ^foo-

                        then
                        {
                            message     Help on FOO files:
                                        https://my-help-site/foo-files
                        }
                    }
                }
            }
        }

        # other job parameters
        # ...
    }
}
</script>
</figure>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-footer.php') ?>

