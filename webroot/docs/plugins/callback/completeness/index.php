<?php
    $section = 'callback-plugins';
    $subpage = 'ref-plugin-completeness';
    $title = 'Generate/Update/Delete Files Based on Their Translation Completeness';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');

    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/version-selector.php');
?>

<h1><?php echo htmlspecialchars($title) ?></h1>

<p>Plugin source location: <code>&lt;serge_root&gt;/lib/Serge/Engine/Plugin/completeness.pm</code></p>

<p>Plugin always attaches itself to the following callback phases:</p>
<ul>
    <li><code><a href="/docs/dev/callbacks/#can_generate_localized_file">can_generate_localized_file</a></code></li>
    <li><code><a href="/docs/dev/callbacks/#after_save_localized_file">after_save_localized_file</a></code></li>
    <li><code><a href="/docs/dev/callbacks/#after_job">after_job</a></code></li>
</ul>

<p>This plugin calculates the translation 'completeness' of a file (ratio of translated strings to the total number of strings in that file) for each language, and, based on its value, provides the following behavior options:</p>
<ol>
    <li>an ability to skip creating a new localized file until its completeness ratio reaches <code>create_threshold</code> level;</li>
    <li>an ability to skip updating an already existing localized file until its completeness ratio reaches <code>update_threshold</code> level;</li>
    <li>an ability to delete a localized file when its completeness drops below <code>update_threshold</code> level;</li>
    <li>send email reports with the summary of the files that reached or dropped below the <code>create_threshold</code> and <code>update_threshold</code> levels.</li>
</ol>

<p>By default, plugin uses the following settings: <code>create_threshold</code> is set to 1, <code>update_threshold</code> is set to 0, and <code>can_delete</code> is set to NO. This means that a file will never be created unless it is 100% complete; once it has been created, it will always be updated no matter what its current completeness ratio is (even if it drops to zero), and it will never be deleted.</p>

<p>If no email settings are provided, the plugin will skip sending a report.</p>

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
            :sample-completeness-settings
            {
                plugin                   completeness

                data
                {
                    /*
                    (NUMBER) [OPTIONAL] Threshold
                    after reaching which the file
                    is allowed to be created.
                    Allowed values: any real number
                    within [0..1] range.
                    Default is 1
                    */
                    create_threshold     0.95

                    /*
                    (NUMBER) [OPTIONAL] Threshold
                    after reaching which the file
                    is allowed to be updated.
                    Allowed values: any real number
                    within [0..1] range.
                    Default is 0
                    */
                    update_threshold     0.5

                    /*
                    (STRING) [OPTIONAL] Whenever the plugin
                    decides that the file should not be
                    saved because its translations are
                    incomplete, you can still save such
                    incomplete files into a separate
                    folder by specifying the path to the folder
                    in this parameter. This can be useful
                    for debugging purposes or to allow
                    previewing incomplete files
                    by translators.

                    The parameter accepts the same file-
                    and language-based macros as `ts_file_path`
                    and `output_file_path` parameters of the
                    configuration file. See the configuration
                    file reference for the full list of macros.

                    If this parameter is missing,
                    incomplete files will not be created.
                    */
                    save_incomplete_to   /path/to/folder

                    /*
                    (ARRAY) [OPTIONAL] List of languages
                    for which the completeness plugin
                    logic should be bypassed. Useful for
                    pseudo-localization, when translations
                    for certain languages are generated
                    on the fly and not stored in the
                    database (and thus completeness ratio
                    can't be calculated on them)
                    Default is: <empty array>
                    */
                    bypass_languages     test

                    /*
                    (BOOLEAN) [OPTIONAL] If 'can_detete'
                    is set to a true value, the file
                    will be deleted if its completeness
                    ratio becomes equal or less than
                    'update_threshold' value.
                    Default is NO
                    */
                    can_delete           YES

                    # email to send status reports on behalf of
                    email_from           l10n-robot@acme.org

                    /*
                    (ARRAY) [OPTIONAL] One or more email
                    addresses to send status reports to
                    */
                    email_to             engineer@acme.org
                                         project-manager@acme.org

                    /*
                    (STRING) [OPTIONAL] Email subject prefix.
                    Depending on a report type, this preffix
                    will be appended with either
                    ' New files created' or
                    ' Stale files removed'.

                    Defaults to job name in square brackets:
                    '[<job_name>]:'
                    */
                    email_subject        [website localization]:
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

