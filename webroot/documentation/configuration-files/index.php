<?php
    $subpage = 'configuration-files';
    $title = 'Configuration Files';

    $head = '
        <script src="/media/vendor/codemirror/codemirror.js"></script>
        <script src="/media/vendor/codemirror/runmode.js"></script>

        <script src="/media/configneat/configneat.js"></script>
        <link rel="stylesheet" href="/media/configneat/configneat.css" />

        <script src="/media/vendor/jquery/jquery-2.1.1.min.js"></script>

        <script src="/media/configneat/colorize_config.js"></script>
    ';

    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');
?>

<h1>Configuration Files</h1>

<p>Configuration files provide all the required information to Serge: how to interact with the <a href="/documentation/version-control/">version control system</a> and external <a href="/documentation/translation-service/">translation service</a>, where to store the local checkout and .po files, which database to use, which files to process, which parser and additional plugins to use, how to name localized versions of files, and so on.</p>

<p><a href="/documentation/configuration-files/reference/">See the full configuration file reference</a>.</p>

<p>For the generic configuration file syntax, please refer to <a href="https://github.com/iafan/Config-Neat">Config::Neat documentation</a> (this is the config parser library Serge uses internally).</p>

<?php /*
<script language="text/x-config-neat">
<?php include('inc/sample.serge') ?>
</script>
*/ ?>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-footer.php') ?>