<?php
    $subpage = 'file-formats';
    $title = 'Supported File Formats';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');
?>

<h1>Supported File Formats</h1>

<p>File format support in Serge is realized via parser plugins. Serge comes with <a href="/docs/plugins/parser/<?php echo $parser_plugins[0] ?>">more than 20 plugins</a> for various localization formats.</p>

<ul>
    <li><a href="/docs/plugins/parser/metaparser/">Metaparser</a> plugin that allows you to parse different file formats (.ini, .inc, .csv, custom ones) by providing a list of regular expressions</li>
    <li>Native platform-specific file formats:</li>
    <ul>
        <li>Android: <a href="/docs/plugins/parser/parse_android/">.xml</a></li>
        <li>iOS, Mac OS: <a href="/docs/plugins/parser/parse_strings/">.strings</a>, <a href="/docs/plugins/parser/parse_plist/">.plist</a></li>
        <li>Blackberry: <a href="/docs/plugins/parser/parse_rrc/">.rrc</a></li>
        <li>Windows: <a href="/docs/plugins/parser/parse_rc/">.rc</a>, <a href="/docs/plugins/parser/parse_wxl/">.wxl</a></li>
        <li>Unix: <a href="/docs/plugins/parser/parse_pot/">.po, .pot</a></li>
        <li>Java: <a href="/docs/plugins/parser/parse_properties/">.properties</a></li>
    </ul>
    <li>Generic tree structure parsers:</li>
    <ul>
        <li><a href="/docs/plugins/parser/parse_json/">JSON</a></li>
        <li><a href="/docs/plugins/parser/parse_php_xhtml/">HTML/XHTML/PHP</a></li>
        <li><a href="/docs/plugins/parser/parse_xml/">XML</a> (including XML documents with embedded HTML inside CDATA blocks);</li>
        <li><a href="/docs/plugins/parser/parse_yaml/">YAML</a></li>
    </ul>
    <li>Several flavors of simple key-value file formats:</li>
    <ul>
        <li><a href="/docs/plugins/parser/parse_json_keyvalue/">JavaScript objects</a></li>
        <li><a href="/docs/plugins/parser/parse_hash/">Perl and PHP hashes</a></li>
        <li>Several key-separator-value formats;</li>
    </ul>
    <li><a href="/docs/plugins/parser/parse_master/">Generic markup parser</a> that one can use to convert plain-text documents or into localizable ones.</li>
</ul>

<p>On top of supporting different file formats, Serge autodetects various Unicode encodings for source files, and can be configured to output localized files in any encoding.</p>

<p>Some parsers in Serge are validating ones; when Serge detects a problem with the source file, it can send an alert email to a specified address for developers/maintainers to be able to fix the problem quickly.</p>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-footer.php') ?>