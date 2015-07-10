<?php
    $subpage = 'configuration-files';
    $title = 'Configuration Files';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');
?>

<h1>Configuration Files</h1>

<p>Configuration files provide all the required information to Serge: how to interact with the <a href="/docs/version-control/">version control system</a> and external <a href="/docs/translation-service/">translation service</a>, where to store the local checkout and .po files, what database to use, what files to process and <a href="/docs/file-formats/">how to parse them</a>, what <a href="/docs/modular-architecture/">additional plugins</a> to use, how to name localized versions of files, and so on.</p>

<p>See Serge configuration file <a href="/docs/configuration-files/syntax/">syntax</a> and <a href="/docs/configuration-files/reference/">reference</a>.</p>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-footer.php') ?>