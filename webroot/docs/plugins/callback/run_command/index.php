<?php
    $section = 'callback-plugins';
    $subpage = 'ref-plugin-run_command';
    $title = 'Run Shell Command';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');
?>

<h1><?php echo htmlspecialchars($title) ?></h1>

<p>Plugin source location: <code>&lt;serge_root&gt;/lib/Serge/Engine/Plugin/run_command.pm</code></p>

<p>Plugin always attaches itself to the following callback phase: <code><a href="/docs/dev/callbacks/#after_save_localized_file">after_save_localized_file</a></code>.</p>

<p>This plugin allows one to run some shell command each time the localized file is saved, which allows one to post-process (compile, pack, validate) localized files.</p>

<p>This plugin inherits all the configuration logic from the parent <a href="/docs/plugins/callback/if/">'if' plugin</a> and, if all conditions are met, runs a shell command. Note that all <code>if</code> conditions are optional: if none are provided, the shell command will always run.</p>

<p>Shell command can include macros in <code>command</code> parameter, which will be expanded to their actual values. See <a href="/docs/configuration-files/reference/">Configuration File Reference</a> for the list of standard macros. In addition to standard macros, <code>%OUTFILE%</code> will be substituted with the full output file path, and <code>%OUTPATH%</code> will be substituted with the full directory path (sans the file name).</p>

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
            :gzip
            {
                plugin         run_command

                data
                {
                    /*
                    (STRING) A shell command to run
                    */
                    command    gzip <%OUTFILE% >%OUTFILE%.gz
                }
            }

            :minify
            {
                plugin         run_command

                data
                {
                    if
                    {
                        file_matches    \.js$

                        then
                        {
                            command    jsmin
                                       <%OUTFILE%
                                       >%OUTPATH%%NAME%.min.js
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

<p>See also: <a href="/docs/plugins/if/">'if' plugin reference</a>.</p>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-footer.php') ?>

