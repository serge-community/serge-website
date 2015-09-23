<?php
    $command = 'serge';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/help-header.php');
?>


<h1 id="NAME">NAME</h1>

<p>serge - Serge command launcher</p>

<h1 id="SYNOPSIS">SYNOPSIS</h1>

<p><code>serge &lt;command&gt; [command-specific-parameters] [--command-specific-options] [--debug]</code></p>

<p>Run <code>serge help &lt;command&gt;</code> for help on a particular command.</p>

<h1 id="DESCRIPTION">DESCRIPTION</h1>

<p><b>serge</b> scans all configuration files in the specified directory and for each found file performs resource localization cycle, namely:</p>

<ul>

<li><p>Extracting strings from original (e.g. English) resource files and populate translation database</p>

</li>
<li><p>Scan previously generated translated files, extract translations from there and put them into translation database</p>

</li>
<li><p>Generate translation files with original strings and existing translations</p>

</li>
<li><p>Generate localized resource files by taking original resource files and replacing original strings with translated ones.</p>

</li>
</ul>

<h1 id="OPTIONS">OPTIONS</h1>

<dl>

<dt><b>--dry-run</b></dt>
<dd>

<p>Just report and validate configuration files, but do no actual synchronization/localization work.</p>

</dd>
<dt><b>-l xx[,yy][,zz]</b>, <b>--lang=xx[,yy][,zz]</b>, <b>--language=xx[,yy][,zz]</b> <b>--languages=xx[,yy][,zz]</b></dt>
<dd>

<p>An optional comma-separated list of target languages</p>

</dd>
<dt><b>-j xx[,yy][,zz]</b>, <b>--job=xx[,yy][,zz]</b>, <b>--jobs=xx[,yy][,zz]</b></dt>
<dd>

<p>An optional comma-separated list of jobs to process</p>

</dd>
<dt><b>--force</b></dt>
<dd>

<p>Disable optimizations and force generate all the files</p>

</dd>
<dt><b>--recreate-ts-files</b></dt>
<dd>

<p>With this mode enabled, translation files will not be parsed, their existing translations will be discarded, and the files will be forcedly generated again. This is useful when removing translations from the database and forcing translation files to be in sync with the database.</p>

</dd>
<dt><b>--debug</b></dt>
<dd>

<p>Print debug output</p>

</dd>
</dl>

<h1 id="SEE-ALSO">SEE ALSO</h1>

<p><a href="http://serge.io/">serge website</a></p>


<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/help-footer.php') ?>

