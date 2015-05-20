<?php
    $subpage = 'config';

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

<h1>Configuration File Reference</h1>

<script language="text/x-config-neat">
<?php include('inc/sample.serge') ?>
</script>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-footer.php') ?>