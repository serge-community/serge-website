<?php
    $command = 'serge-localize';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/help-header.php');
?>


<h1 id="NAME">NAME</h1>

<p>serge-localize - Perform localization cycle</p>

<h1 id="SYNOPSIS">SYNOPSIS</h1>

<p><code>serge localize &lt;configuration-files&gt; [--force] [--recreate-po] [--lang=aa,bb,cc] [--jobs=foo,bar]</code></p>

<p>Where <code>&lt;configuration-files&gt;</code> is a path to a specific .serge file, or a directory to scan .serge files in. You can specify multiple paths as separate command-line parameters.</p>

<h1 id="DESCRIPTION">DESCRIPTION</h1>

<p>For all provided configuration files, run all their localization jobs, as follows:</p>

<ul>

<li><p>Extract strings from original (e.g. English) resource files in the working directory and populate translation database.</p>

</li>
<li><p>Scan previously generated .po files in the .po directory (if they exist), extract translations from there and put them into translation database.</p>

</li>
<li><p>Update .po files with any existing translations, create missing .po files.</p>

</li>
<li><p>Generate localized resource files in the working directory by taking original resource files and replacing original strings with translated ones.</p>

</li>
</ul>

<p>See Serge config format description for more information on how to define localization jobs.</p>

<h1 id="OPTIONS">OPTIONS</h1>

<dl>

<dt><b>--force</b></dt>
<dd>

<p>Disable internal optimizations and force process/generate all the files.</p>

<p>This is useful when someone outside has altered/deleted the previously created localized resource files, and you want to rebuold everything.</p>

<p>Note that some localization plugins (for example, <i>completeness</i> plugin) may prevent some files from being updated or created unless a certain criteria is met; <code>--force</code> doesn&#39;t change any of this logic, it will only ensure that the localization procedures will be run for each matching file and no shortcut paths will be taken.</p>

</dd>
<dt><b>--lang=xx[,yy][,zz]</b>, <b>--language=xx[,yy][,zz]</b> <b>--languages=xx[,yy][,zz]</b></dt>
<dd>

<p>An optional comma-separated list of target languages. If not specified, will go through all languages defined in each job.</p>

</dd>
<dt><b>--job=xx[,yy][,zz]</b>, <b>--jobs=xx[,yy][,zz]</b></dt>
<dd>

<p>An optional comma-separated list of jobs to process.</p>

</dd>
<dt><b>--recreate-po</b></dt>
<dd>

<p>With this mode enabled, .po files will not be parsed, their existing translations will be discarded, and the .po files will be forcedly generated again.</p>

<p>Note that you won&#39;t need this in the typical use of Serge toolkit, until you write some custom scripts that import translations directly into the translation memory database, bypassing the .po files. So, this option will propagate translation changes from the database into .po files, otherwise in the next localization cycle (<code>serge localize</code> or <code>serge sync</code>) translations will be read from .po files, essentially undoing any side changes.</p>

<p>The typical custom import flow is:</p>

<ol>

<li><p>Run <code>serge localize</code> or <code>serge sync</code>;</p>

</li>
<li><p>Run custom script that does something to translation memory database;</p>

</li>
<li><p>Run <code>serge localize --recreate-po</code> or <code>serge sync --recreate-po</code> once to propagate changes into .po files;</p>

</li>
<li><p>Continue running <code>serge localize</code> or <code>serge sync</code> normally.</p>

</li>
</ol>

</dd>
<dt><b>--output-only-mode</b></dt>
<dd>

<p>Only produce output files: do not parse or generate .po files, do not update database with source strings or translations. This flag will force this mode on all jobs, disregarding their own <code>output_only_mode</code> setting.</p>

</dd>
</dl>

<h1 id="SEE-ALSO">SEE ALSO</h1>

<p><a href="../serge-sync/">serge-sync</a></p>

<p>Part of <a href="../serge/">serge</a> suite.</p>


<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/help-footer.php') ?>

