<?php
    $section = 'ts-plugins';
    $subpage = 'ref-plugin-zing';
    $title = 'Zing Synchronization Plugin';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');

    $available_since = '1.4';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/version-selector.php');
?>

<h1><?php echo htmlspecialchars($title) ?></h1>

<p>Plugin source location: <code>&lt;serge_root&gt;/lib/Serge/Sync/Plugin/TranslationService/zing.pm</code></p>

<p>This plugin provides integration with <a href="https://evernote.github.io/zing/">Zing</a>, Evernote's own open-source translation platform.</p>

<p>On <code><a href="/docs/help/serge-push-ts/">push-ts</a></code> sync step, Serge will tell Zing to scan generated translation files and update its internal translation database so that the new content becomes available for translation online. Respectively, on <code><a href="/docs/help/serge-pull-ts/">pull-ts</a></code> sync step, Serge will tell Zing to synchronize all the translations back into translation files.</p>

<p class="notice">When working with Zing, use the <a href="/docs/plugins/serializer/serialize_po">serialize_po</a> serializer for translation interchange files.</p>

<p>Communication between Serge and Zing is performed by the means of running Zing's command-line API tool, <code>zing</code>. Note that this means that Zing must be installed on the same machine as Serge. Please refer to <a href="/docs/guides/zing/">Serge + Zing</a> configuration guide for more information.</p>

<p>Each configuration file in Serge represents a single translation project, and maps to a single specific project in Zing. The typical workflow is this:</p>

<ol>
    <li>Install Zing and set it up that it's root directory with .po files is e.g. <code>/var/serge/po/</code></li>
    <li>Create a new Serge configuration file (let's call it <code>my_project.serge</code>) for your translation project so that it generates .po files under <code>/var/serge/po/my_project/</code> (see <a href="/docs/configuration-files/reference/">Configuration File Reference</a>, <code>jobs &rarr; ... &rarr; ts_file_path</code> parameter)</li>
    <li>Run <code>serge localize my_project.serge</code> to make sure everything works; after this step, you get .po files in your output directory</li>
    <li>Go to Zing and add a new project with <code>my_project</code> code; Zing will automatically know that its files are located under <code>/var/serge/po/my_project/</code> folder</li>
    <li>Edit your Serge configuration file to add a <code>sync/ts</code> section (see the example below), and specify <code>my_project</code> as a value for <code>project_id</code> parameter</li>
    <li>Run <code>serge push-ts my_project.serge</code> to push your translations into Zing for the first time, then go to Zing's translation UI and see if everything works as expected</li>
</ol>

<p>Later you will run <code>serge sync</code> continuously against this configuration file, which will perform the two-way sync between Serge and Zing among other synchronization/localization steps. See <a href="/docs/localization-cycle/">Localization Cycle</a> for more information.</p>

<h2>Usage</h2>

<figure>
    <figcaption>example-project.serge</figcaption>
    <script language="text/x-config-neat">
sync
{
    ts
    {
        plugin                   zing

        data
        {
            # (STRING) [OPTIONAL] Path to `zing` executable.
            # If omitted, defaults to "zing" or the value of
            # the ZING_EXECUTABLE environment variable.
            executable           /path/to/zing

            # (STRING) Project id (code) as it is registered in Zing
            project_id           my_project
        }
    }

    # other sync parameters
    # ...
}
</script>
</figure>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-footer.php') ?>

