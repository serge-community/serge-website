<?php
    $section = 'callback-plugins';
    $subpage = 'ref-plugin-run_command';
    $title = 'Run Shell Command';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');
?>

<h1><?php echo htmlspecialchars($title) ?></h1>

<p>Plugin source location: <code>&lt;serge_root&gt;/lib/Serge/Engine/Plugin/run_command.pm</code></p>

<p>This plugin inherits all the configuration logic from the parent <a href="/docs/plugins/if/">'if' plugin</a> and, if all conditions are met, runs a shell command. Note that all <code>if</code> conditions are optional: if none are provided, the shell command will always run.</p>

<p>Shell command can include macros in <code>command</code> parameter, see below. These macros will be expanded to their actual values. See <a href="/docs/configuration-files/reference/">Configuration File Format</a> reference for the list of available macros.</p>

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
            :gzip
            {
                plugin         run_command
                phase          after_save_localized_file

                data
                {
                    /*
                    (STRING) A shell command to run
                    */
                    command    gzip <%FILE% >%FILE%.gz
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

