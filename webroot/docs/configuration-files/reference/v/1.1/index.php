<?php
    $section ='config-files';
    $subpage = 'ref-config-reference';
    $title = 'Configuration File Reference';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');

    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/version-selector.php');
?>

<h1>Configuration File Reference</h1>

<script language="text/x-config-neat">
<?php include('../../../inc/sample.serge.v1.1') ?>
</script>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-footer.php') ?>