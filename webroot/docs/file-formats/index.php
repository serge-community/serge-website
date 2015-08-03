<?php
    $subpage = 'file-formats';
    $title = 'Supported File Formats';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');
?>

<h1>Supported File Formats</h1>

<p>File format support in Serge is realized via parser plugins. Serge comes with <a href="/docs/plugins/parser/<?php echo $parser_plugins[0] ?>">more than 20 plugins</a> for various localization formats.</p>

<ul>
    <li>Native platform-specific file formats:</li>
    <ul>
        <li>Android: .xml</li>
        <li>iOS, Mac OS: .strings, .plist</li>
        <li>Windows: .rc. .rrc, .wxl</li>
        <li>Unix: .po</li>
        <li>Java: .properties</li>
    </ul>
    <li>Generic tree structure parsers:</li>
    <ul>
        <li>JSON;</li>
        <li>HTML/XHTML/PHP;</li>
        <li>XML (including XML documents with embedded HTML inside CDATA blocks);</li>
        <li>YAML;</li>
    </ul>
    <li>Several flavors of simple key-value file formats:</li>
    <ul>
        <li>JavaScript objects;</li>
        <li>Perl/PHP hashes;</li>
        <li>Several key-separator-value formats;</li>
    </ul>
    <li>Generic markup parser that one can use to convert plain-text documents or into localizable ones.</li>
</ul>

<p>On top of supporting different file formats, Serge autodetects various Unicode encodings for source files, and can be configured to output localized files in any encoding.</p>

<p>Some parsers in Serge are validating ones; when Serge detects a problem with the source file, it can send an alert email to a specified address for developers/maintainers to be able to fix the problem quickly.</p>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-footer.php') ?>