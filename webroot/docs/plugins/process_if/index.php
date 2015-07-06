<?php
    $section = 'callback-plugins';
    $subpage = 'ref-plugin-process_if';
    $title = 'Allow or Disallow Processing Based on File/Language/Content/Comment Matching Conditions';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');
?>

<h1><?php echo htmlspecialchars($title) ?></h1>

<p>Plugin source location: <code>&lt;serge_root&gt;/lib/Serge/Engine/Plugin/process_if.pm</code></p>

<p>This plugin inherits all the configuration logic from the parent <a href="/docs/plugins/if/">'if' plugin</a> and provides hooks to <code>can_*</code> callback phases to allow tweaking various processing logic aspects inside Serge.</p>

<p>Plugin must be attached through the configuration file to either of the following phases:</p>
<ul>
    <li><code>can_process_source_file</code></li>
    <li><code>can_extract</code></li>
    <li><code>can_process_po</code></li>
    <li><code>can_generate_po</code></li>
    <li><code>can_translate</code></li>
    <li><code>can_generate_localized_file</code></li>
    <li><code>can_generate_localized_file_source</code></li>
    <li><code>can_save_localized_file</code></li>
</ul>

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

