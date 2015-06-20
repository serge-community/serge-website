<?php
    $section = 'callback-plugins';
    $subpage = 'ref-plugin-append_hint_message';
    $title = 'Plugin to Append Extra Message to a Hint';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');
?>

<h1><?php echo htmlspecialchars($title) ?></h1>

<p>Plugin source location: <code>&lt;serge_root&gt;/lib/Serge/Engine/Plugin/append_hint_message.pm</code></p>

<p>Plugin always attaches itself to the following callback phase: <code>add_dev_comment</code>.</p>

<p>Adding a hint allows you to provide better context to translators. It can include, for example, links to a preview server, or some hashtags to help translators find similar messages. This plugin is used to append an arbitrary message to a hint associated with the translatable string. Message is added to the end of the existing hint message and is separated with two line breaks (so it looks like a new 'paragraph'). You can use multiple entries for this plugin in <code>callback-plugins</code> section if you want to add several 'paragraphs'. Multi-line hint is then exported as a developer's comment in generated .po file, and is generally displayed to translator within their translation environment.</p>

<p>When configuring the plugin, you can include macros in hint <code>message</code> parameter, see below. These macros will be expanded to their actual values. Having macros allows one to construct preview links pointing to a specific target file, or to a help page for a specific file extension. See <a href="/docs/configuration-files/reference/">Configuration File Format</a> reference for the list of available macros.</p>

<h2>Usage</h2>

<figure>
    <figcaption>example-project.serge</figcaption>
    <script language="text/x-config-neat">
jobs
{
    :sample-job
    {
        callback-plugins
        {
            :sample-preview-link
            {
                plugin               append_hint_message

                data
                {
                    # you can use macros in the message text;
                    # see Serge configuration file format reference
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
        }

        # other job parameters
        # ...
    }
}
</script>
</figure>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-footer.php') ?>

