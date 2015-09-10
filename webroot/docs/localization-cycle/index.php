<?php
    $subpage = 'localization-cycle';
    $title = 'Localization Cycle';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');
?>

<h1>Localization Cycle</h1>

<p>Localization cycle in Serge is a process of generating localized resources by getting source resources and applying all known translations to them (this is what <code>serge localize</code> does). On top of that, Serge performs all the necessary synchronization with version control system and translation service (this is what <code>serge sync</code> does).</p>

<p>The diagram below shows what steps are performed by Serge when you run <code><a href="/docs/help/serge-sync/">sync</a></code> or <code><a href="/docs/help/serge-localize/">localize</a></code> command against a <a href="/docs/configuration-files/">configuration file</a> which describes your localization project:</p>

<p><img src="/media/sync_diagram.svg" width="680" /></p>

<p><code><a href="/docs/help/serge-localize/">sync</a></code> performs a full localization+sync cycle:</p>

<ol>
    <li>Pull source files from the <a href="/docs/version-control/">remote development repository</a> (<code><a href="/docs/help/serge-pull/">pull</a></code>)</li>
    <li>Pull translation files from <a href="/docs/translation-service/">external translation service</a> (<code><a href="/docs/help/serge-pull-ts/">pull-ts</a></code>)</li>
    <li>Perform an inner (local) localization cycle (<code><a href="/docs/help/serge-localize/">localize</a></code>):
        <ol>
            <li>Parse specific localizable resource files from the local checkout, extract strings from there and put them into its own Translation Memory database</li>
            <li>Parse previously generated translation files and put new translations into TM database</li>
            <li>Generate/update translation files that can be further used in an offline or online translation environment</li>
            <li>Generate localized copies of source files based on existing translations</li>
        </ol>
    </li>
    <li>Push translation files to an <a href="/docs/translation-service/">external translation service</a> (<code><a href="/docs/help/serge-push-ts/">push-ts</a></code>)</li>
    <li>Push generated localized files back to the <a href="/docs/version-control/">remote repository</a> (<code><a href="/docs/help/serge-push/">push</a></code>)</li>
</ol>

<h1>Intended Use</h1>

<p><code>sync</code> command needs to be used on a <a href="/docs/localization-server/">localization server</a>.</p>

<p><code>localize</code> command alone can be used on a local development machine for on-demand resource localization, localization project configuration, or testing your custom parsers.</p>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-footer.php') ?>
