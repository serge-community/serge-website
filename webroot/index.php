<?php
    $page = 'index';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/header.php');
?>

<div class="graphic-bg"></div>
<div class="graphic"></div>

<p><strong>Serge</strong> (it's name stands for <u>S</u>tring <u>E</u>xtraction and <u>R</u>esource <u>G</u>eneration <u>E</u>ngine) <strong>is a free, open-source toolkit</strong> written in Perl that helps you set up a seamless continuous localization process for your software and marketing assets in a fully automated and scalable fashion. It will fit perfectly into your agile development cycle.</p>

<p>Serge is developed and maintained by <a href="http://evernote.com/">Evernote</a>, where it works non-stop to help deliver dozens of different Evernote clients, websites and marketing materials in 30+ languages, but it will equally work well for an indie developer with just one project to translate. It allows developers to concentrate on maintaining resource files in just one language (e.g. English), and Serge will take care of keeping all localized resources in sync.</p>

<h1>Key Features</h1>

<ul>
    <li><strong>Pluggable architecture</strong>: plugins can provide hooks at various stages of main code execution and control the flow; you can easily write your own plugins</li>
    <li><strong>VCS synchronization plugins</strong>: Git; Git/Gerrit, SVN
    <li><strong>.PO synchronization plugins</strong>: Pootle (online translation server)
    <li><strong>Parser plugins</strong>: Android .strings; Google Chrome .json; DTD entities; arbitrary JSON, XML and YAML trees; static PHP/XHTML; MacOS/iOS .strings and .plist files; .pot files; Java .properties; Windows .rc, .resx and .wxl; Blackberry .rrc; Qt .ts; miscellaneous simple key/value formats (Perl, JavaScript, etc.); .master (internal markup format)</li>
    <li><strong>Control flow plugins</strong>: limit the list of destination languages for each individual file based on certain content found in a file; create/update files only when they reach a certain completeness level; replace strings using regular expressions; run arbitrary shell command for each saved localized file</li>
    <li><strong>Translation plugins</strong>: guess translations from previously known similar strings and their translations; fake (test) translation plugin</li>
    <li><strong>TM database types</strong>: SQLite or MySQL</li>
    <li><strong>Robust configuration files</strong> with clean syntax and inheritance/override mechanisms for optimal reuse of common features in multiple projects</li>
    <li><strong>Environment variables</strong>: you can reference external environment variables from within your configuration files for further flexibility</li>
    <li><strong>Import/Export</strong>: TMX (Translation Memory Exchange); TTX (SDL Trados Tag Editor); HTML; fine-grain control of what to export</li>
    <li><strong>Email reports</strong>: receive alerts when files fail to parse or when files reach or drop below a certain completeness ratio threshold</li>
</ul>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/footer.php') ?>
