<?php
    $subpage = 'localization-cycle';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');
?>

<h1>Localization Cycle</h1>

<p>The diagram below shows what steps are performed by Serge when you run <code><a href="/documentation/help/serge-sync/">sync</a></code> or <code><a href="/documentation/help/serge-localize/">localize</a></code> command against some <a href="/documentation/configuration-file/">configuration file</a> (which describes localization project):</p>

<p><img src="/media/sync_diagram.svg" width="680" /></p>

<p><code><a href="/documentation/help/serge-localize/">sync</a></code> performs a full localization+sync cycle:</p>

<ol>
    <li>Pull source files from the <a href="/documentation/version-control/">remote development repository</a> (<code><a href="/documentation/help/serge-pull/">pull</a></code>)</li>
    <li>Pull .po files from <a href="/documentation/translation-service/">external translation service</a> (<code><a href="/documentation/help/serge-pull-po/">pull-po</a></code>)</li>
    <li>Perform an inner (local) localization cycle (<code><a href="/documentation/help/serge-localize/">localize</a></code>):
        <ol>
            <li>Parse specific localizable resource files from the local checkout, extract strings from there and put them into its own Translation Memory database</li>
            <li>Parse previously generated .po files and put new translations into TM database</li>
            <li>Generate/update .po files that can be further used in an offline or online translation environment</li>
            <li>Generate localized copies of source files based on existing translations</li>
        </ol>
    </li>
    <li>Push .po files to an <a href="/documentation/translation-service/">external translation service</a> (<code><a href="/documentation/help/serge-push-po/">push-po</a></code>)</li>
    <li>Push generated localized files back to the <a href="/documentation/version-control/">remote repository</a> (<code><a href="/documentation/help/serge-push/">push</a></code>)</li>
</ol>

<h1>Intended Use</h1>

<p><code>sync</code> command makes sense in a continuous localization environment. On a very basic level, you can run <code>serge sync /path/to/localization-configuration-files-folder</code> as a cron job on your server.</p>

<p><code>localize</code> command alone can be used on a local development machine for on-demand resource localization, localziation project configuration, or testing your custom parsers.</p>


<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-footer.php') ?>
