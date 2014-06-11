<?php
    $page = 'index';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/header.php');
?>

<div class="graphic-bg"></div>
<div class="graphic"></div>

<p><strong>Serge</strong> (it's name stands for <u>S</u>tring <u>E</u>xtraction and <u>R</u>esource <u>G</u>eneration <u>E</u>ngine) <strong>is a free, open-source toolkit</strong> written in Perl that helps you set up a seamless continuous localization process for your software and/or marketing assets in a fully automated and scalable fashion. It will fit perfectly into your agile development cycle.</p>

<p>Serge is developed and maintained by <a href="http://evernote.com/">Evernote</a>, where it works non-stop to help deliver dozens of different Evernote clients, websites and marketing materials in 30+ languages. But it will equally work well for an indie developer with just one project to translate.</p>

<h1>What Does it Do, Exactly?</h1>

<p>Serge is a command-line tool that can be either run manually and on demand on a developers' computer, or be run continuously on a standalone server. Being provided a special project configuration file or a directory with the configuration files, it will automatically do the following for each project:
<ol>
    <li>Pull source files from your remote development repository</li>
    <li>Parse specific localizable resource files from the local checkout and extract strings from there</li>
    <li>Put translatable strings into its own Translation Memory database</li>
    <li>Generate .po files that can be further used in an offline or online translation environment</li>
    <li>Parse previously generated .po files to integrate translations back into TM database</li>
    <li>Generate localized copies of source files based on existing translations, optionally massaging the content of the files using regular expressions</li>
    <li>Push generated files back to your remote repository</li>
</ol>

<p>This allows developers to concentrate on editing localizable resource files in just one language (e.g. English). After pushing their changes to the remote repository, they will see all the localized files to be accordingly updated after the next Serge cycle run.</p>

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
