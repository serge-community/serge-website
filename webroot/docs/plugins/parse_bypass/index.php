<?php
    $section = 'parser-plugins';
    $subpage = 'ref-plugin-parse_bypass';
    $title = 'Bypass Parser Plugin (Returns Original Text)';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');
?>

<h1><?php echo htmlspecialchars($title) ?></h1>

<p>This is a special 'dummy' parser plugin which doesn't extract any strings for translation, and returns an unchanged source document. This plugin can be used to localize files which otherwise don't contain any translatable strings. For example, one could replace some identifiers, locale codes or file paths by the means of control plugins.</p>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-footer.php') ?>

