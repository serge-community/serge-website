<?php
    $section = 'callback-plugins';
    $subpage = 'ref-plugin-process_if';
    $title = 'Allow or Disallow Processing Based on File/Language/Content/Comment Matching Conditions';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');
?>

<h1><?php echo htmlspecialchars($title) ?></h1>

<p>Plugin source location: <code>&lt;serge_root&gt;/lib/Serge/Engine/Plugin/process_if.pm</code></p>

<p>This plugin inherits all the configuration logic from the parent <a href="/docs/plugins/callback/if/">'if' plugin</a> and provides hooks to <code>can_*</code> callback phases to allow tweaking various processing logic aspects inside Serge.</p>

<p>Plugin must be attached through the configuration file to either of the following phases:</p>
<ul>
    <li><code><a href="/docs/dev/callbacks/#can_process_source_file">can_process_source_file</a></code></li>
    <li><code><a href="/docs/dev/callbacks/#can_extract">can_extract</a></code></li>
    <li><code><a href="/docs/dev/callbacks/#can_process_ts_file">can_process_ts_file</a></code></li>
    <li><code><a href="/docs/dev/callbacks/#can_generate_ts_file">can_generate_ts_file</a></code></li>
    <li><code><a href="/docs/dev/callbacks/#can_translate">can_translate</a></code></li>
    <li><code><a href="/docs/dev/callbacks/#can_generate_localized_file">can_generate_localized_file</a></code></li>
    <li><code><a href="/docs/dev/callbacks/#can_generate_localized_file_source">can_generate_localized_file_source</a></code></li>
    <li><code><a href="/docs/dev/callbacks/#can_save_localized_file">can_save_localized_file</a></code></li>
</ul>

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
            /*
            Source files will be considered localizable
            only if they contain a special "LOCALIZABLE" word
            */
            :if-can-localize
            {
                plugin  process_if
                phase   can_process_source_file

                 data
                {
                    if
                    {
                        content_matches         \bLOCALIZABLE\b

                        then
                        {
                            /*
                            (BOOLEAN) [OPTIONAL] This directive
                            instructs to stop processing other `if`
                            blocks below and return the corresponding
                            value: 1 (YES) or 0 (NO).
                            If omitted, `if` statements below will
                            be processed. See `process_if` plugin
                            for more examples.
                            */
                            return              YES
                        }
                    }

                    if
                    {
                        # ...
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

