<?php
    $command = 'serge-import';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/help-header.php');
?>


<h1 id="NAME">NAME</h1>

<p>serge-import - Import translations from already existing resource files</p>

<h1 id="SYNOPSIS">SYNOPSIS</h1>

<p><code>serge import [configuration-files] [options]</code></p>

<p>Where <code>[configuration-files]</code> is a path to a specific .serge file, or a directory to scan .serge files in. You can specify multiple paths as separate command-line parameters. If no paths provided, Serge will look up for .serge files in the current directory.</p>

<h1 id="DESCRIPTION">DESCRIPTION</h1>

<p><b>serge-import</b> does the opposite of <a href="../serge-localize/">serge-localize</a>: it scans previously generated localized resource files according to the rules in configuration files, and tries to import translations back into the database.</p>

<p>This is useful to initially import pre-existing translations before setting up an automated localization flow.</p>

<h1 id="OPTIONS">OPTIONS</h1>

<dl>

<dt><b>--dry-run</b></dt>
<dd>

<p>Just show a report, but do no actual import.</p>

</dd>
<dt><b>--lang=xx[,yy][,zz]</b>, <b>--language=xx[,yy][,zz]</b> <b>--languages=xx[,yy][,zz]</b></dt>
<dd>

<p>An optional comma-separated list of target languages</p>

</dd>
<dt><b>--disambiguate-keys</b></dt>
<dd>

<p>If duplicate keys are found, don&#39;t exit but disambiguate them in the order of their presence. Use with care only when you are sure that the ordering and the number of ambigous keys in all files (both original and localized) is the same, otherwise you might end up importing wrong translations for wrong keys.</p>

</dd>
<dt><b>--no-report</b></dt>
<dd>

<p>By default, serge-import generates HTML reports, one per language, in the current directory with &#39;serge-import-report-xx.html&#39; file names, where &#39;xx&#39; is the language. It is strongly recommended to always review these reports, but one may skip generating report files by providing this option.</p>

</dd>
<dt><b>--debug</b></dt>
<dd>

<p>Print debug output</p>

</dd>
</dl>

<h1 id="SEE-ALSO">SEE ALSO</h1>

<p>Part of <a href="../serge/">serge</a> suite.</p>


<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/help-footer.php') ?>

