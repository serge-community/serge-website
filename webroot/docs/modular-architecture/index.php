<?php
    $subpage = 'modular-architecture';
    $title = 'Modular Architecture';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');
?>

<h1>Modular Architecture</h1>

<p>Localization goes beyond simple file parsing and translation. Serge is built with extensibility in mind, and realizes its <a href="/docs/file-formats/">file format support</a> and extra functionality by the means of plugins.</p>

<p>Here are some of the things that you can do with Serge:</p>

<ul>
    <li>Use regular expressions to modify the file content before it gets parsed</li>
    <li>Use regular expressions to modify the localized file content before it gets saved</li>
    <li>Use regular expressions to modify translations on the fly (for example, normalize punctuation)</li>
    <li>Run arbitrary shell commands once localized files are saved (for example, to compile files)</li>
    <li>Limit target languages on a per-file basis based on file path or its contents</li>
    <li>Prevent generating/updating localized files unless they are 100% translated</li>
    <li>Smart-guess translations from similar previously translated strings</li>
    <li>Control Serge Translation Memory database right from the translation UI (by the means of commands provided in translator's comments)</li>
</ul>

<p>Learn more about supported functionality by looking up the documentation on available <a href="/docs/plugins/parser/<?php echo $parser_plugins[0] ?>">parser plugins</a> and <a href="/docs/plugins/callback/<?php echo $callback_plugins[0] ?>">callback plugins</a>.</p>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-footer.php') ?>