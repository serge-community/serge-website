<?php
    $section = 'callback-plugins';
    $subpage = 'ref-plugin-replace_strings';
    $title = 'Generic String Replacement Plugin';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');
?>

<h1><?php echo htmlspecialchars($title) ?></h1>

<p>Plugin source location: <code>&lt;serge_root&gt;/lib/Serge/Engine/Plugin/replace_strings.pm</code></p>

<p>Plugin must be attached through the configuration file to exactly one of the following phases:</p>
<ul>
    <li><code>after_load_file</code></li>
    <li><code>before_save_localized_file</code></li>
    <li><code>rewrite_translation</code></li>
    <li><code>rewrite_path</code></li>
    <li><code>rewrite_relative_output_path</code></li>
    <li><code>rewrite_absolute_output_path</code></li>
</ul>

<p>This plugin is used to manipulate (rewrite/patch) strings. Depending on the callback phase this plugin is attached to, it can change source or destination file contents, rewrite translations and file paths. See the documenation on callbacks for more information.</p>

<p>You can include macros in <code>replace</code> parameter, see below. These macros will be expanded to their actual values. See <a href="/docs/configuration-files/reference/">Configuration File Format</a> reference for the list of available macros.</p>

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
            :patch-language
            {
                plugin         replace_strings
                phase          before_save_localized_file

                data
                {
                    replace    `lang = "en"` `lang = "%LANG%"` sg
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

