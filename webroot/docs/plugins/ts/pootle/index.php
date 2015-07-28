<?php
    $section = 'ts-plugins';
    $subpage = 'ref-plugin-pootle';
    $title = 'Pootle Synchronization Plugin';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');
?>

<h1><?php echo htmlspecialchars($title) ?></h1>

<p>Plugin source location: <code>&lt;serge_root&gt;/lib/Serge/Sync/Plugin/TranslationService/pootle.pm</code></p>

<p>This plugin provides integration with <a href="http://pootle.translatehouse.org/">Pootle</a> — a free open-source online translation server software. On <code><a href="/docs/help/serge-push-po/">push-po</a></code> sync step, Serge will tell Pootle to scan generated .po files and update its internal translation database so that the new content becomes available for translation online. Respectively, on <code><a href="/docs/help/serge-pull-po/">pull-po</a></code> sync step, Serge will tell Pootle to synchronize all the translations back into .po files.</p>

<p>Communication between Serge and Pootle is performed by the means of running Pootle's command-line API tool (the script is called <code>manage.py</code>). Note that this means that Pootle must be installed on the same machine as Serge.</p>

<p>Each configuration file in Serge represents a single translation project, and maps to a single specific project in Pootle. The typical workflow is this:</p>

<ol>
    <li>Install Pootle and set it up that it's root directory with .po files is e.g. <code>/var/serge/po/</code></li>
    <li>Create a new Serge configuration filee (let's call it <code>my_project.serge</code>) for your translation project so that it generates .po files under <code>/var/serge/po/my_project/</code> (see <a href="/docs/configuration-files/reference/">Configuration File Reference</a>, <code>jobs &rarr; ... &rarr; po_path</code> parameter)</li>
    <li>Run <code>serge localize my_project.serge</code> to make sure everything works; after this step, you get .po files in your output directory</li>
    <li>Go to Pootle and add a new project with <code>my_project</code> code; Pootle will automatically know that it's files are located under <code>/var/serge/po/my_project/</code> folder</li>
    <li>Edit your Serge configuration file to add a <code>sync/ts</code> section (see the example below), and specify <code>my_project</code> as a value for <code>project_id</code> parameter</li>
    <li>Run <code>serge push-po my_project.serge</code> to push your translation into Pootle for the first time, then go to Pootle's translation UI and see if everything works as expected</li>
</ol>

<p>Later you will run <code>serge sync</code> continuously against this configuration file, which will perform the two-way sync between Serge and Pootle among other synchronization/localization steps. See <a href="/docs/localization-cycle/">Localization Cycle</a> for more information.</p>

<h2>Usage</h2>

<figure>
    <figcaption>example-project.serge</figcaption>
    <script language="text/x-config-neat">
sync
{
    translation_service
    {
        plugin                   pootle

        data
        {
            # (STRING) Path to Pootle’s `manage.py` utility
            manage_py_path       /path/to/pootle/manage.py

            # (STRING) Project id (code) as it is registered in Pootle
            project_id           my_project
        }
    }

    # other sync parameters
    # ...
}
</script>
</figure>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-footer.php') ?>

