<?php
    $section = 'callback-plugins';
    $subpage = 'ref-plugin-replace_strings';
    $title = 'Generic String Replacement Plugin';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');

    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/version-selector.php');
?>

<h1><?php echo htmlspecialchars($title) ?></h1>

<p>Plugin source location: <code>&lt;serge_root&gt;/lib/Serge/Engine/Plugin/replace_strings.pm</code></p>

<p>Plugin must be attached through the configuration file to exactly one of the following phases:</p>
<ul>
    <li><code><a href="/docs/dev/callbacks/#after_load_file">after_load_file</a></code></li>
    <li><code><a href="/docs/dev/callbacks/#before_save_localized_file">before_save_localized_file</a></code></li>
    <li><code><a href="/docs/dev/callbacks/#rewrite_translation">rewrite_translation</a></code></li>
    <li><code><a href="/docs/dev/callbacks/#rewrite_path">rewrite_path</a></code></li>
    <li><code><a href="/docs/dev/callbacks/#rewrite_relative_output_file_path">rewrite_relative_output_file_path</a></code></li>
    <li><code><a href="/docs/dev/callbacks/#rewrite_absolute_output_file_path">rewrite_absolute_output_file_path</a></code></li>
</ul>

<p>This plugin is used to manipulate (rewrite/patch) strings. Depending on the callback phase this plugin is attached to, it can change source or destination file contents, rewrite translations and file paths. See the documenation on callbacks for more information.</p>

<p>You can include macros in <code>replace</code> parameter, see below. These macros will be expanded to their actual values. See <a href="/docs/configuration-files/reference/">Configuration File Reference</a> for the list of available macros.</p>

<p>This plugin inherits all the configuration logic from the parent <a href="/docs/plugins/callback/if/">'if' plugin</a> and, if all conditions are met, exectutes the rewrite logic. Note that all <code>if</code> conditions are optional: if none are provided, the replacement rules will be always executed.</p>

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
            :patch-language
            {
                plugin         replace_strings
                phase          before_save_localized_file

                data
                {
                    /*
                    (ARRAY) Replacement regular expression.
                    The first string defines the pattern to find,
                    the second one — the replacement string,
                    the third one — regexp flags. This is
                    equivalent to the following expression in Perl:

                        s/$what/$with/$flags;

                    Note that there can be more than one `replace`
                    rule defined inside this block.
                    */

                    #          what          with              flags
                    replace    `lang = "en"` `lang = "%LANG%"` sg
                }
            }

            :replace-foo-with-bar
            {
                plugin         replace_strings
                phase          before_save_localized_file

                data
                {
                    if
                    {
                        content_matches     \bFOO_TO_BAR\b

                        then
                        {
                            replace         foo bar sg
                            replace         Foo Bar sg
                            replace         FOO BAR sg
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

