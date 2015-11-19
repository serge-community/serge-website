<?php
    $command = 'serge-sync';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/help-header.php');
?>


<h1 id="NAME">NAME</h1>

<p>serge-sync - Perform a full synchronization + localization cycle</p>

<h1 id="SYNOPSIS">SYNOPSIS</h1>

<p><code>serge sync [configuration-files] [--force] [--rebuild-ts-files] [--output-only-mode] [--lang=aa,bb,cc] [--jobs=foo,bar]</code></p>

<p>Where <code>[configuration-files]</code> is a path to a specific .serge file, or a directory to scan .serge files in. You can specify multiple paths as separate command-line parameters. If no paths provided, Serge will look up for .serge files in the current directory.</p>

<h1 id="DESCRIPTION">DESCRIPTION</h1>

<p>For all provided configuration files, run `pull`, `pull-ts`, `localize`, `push-ts` and `push` commands in one cycle.</p>

<h1 id="OPTIONS">OPTIONS</h1>

<dl>

<dt><b>--force</b></dt>
<dd>

<p>Has the same effect as <a href="../serge-pull-ts/"><code>serge pull-ts --force</code></a> and <a href="../serge-localize/"><code>serge localize --force</code></a> combined.</p>

</dd>
<dt><b>--rebuild-ts-files</b></dt>
<dd>

<p>Has the same effect as <a href="../serge-localize/"><code>serge localize --rebuild-ts-files</code></a>.</p>

</dd>
<dt><b>--output-only-mode</b></dt>
<dd>

<p>Has the same effect as <a href="../serge-localize/"><code>serge localize --output-only-mode</code></a>.</p>

</dd>
<dt><b>--lang=xx[,yy][,zz]</b>, <b>--language=xx[,yy][,zz]</b> <b>--languages=xx[,yy][,zz]</b></dt>
<dd>

<p>See <a href="../serge-localize/"><code>serge localize --lang</code></a>. Will also completely skip processing configs where no target languages are found.</p>

</dd>
<dt><b>--job=xx[,yy][,zz]</b>, <b>--jobs=xx[,yy][,zz]</b></dt>
<dd>

<p>See <a href="../serge-localize/"><code>serge localize --job</code></a>. Will also completely skip processing configs where no target jobs are found.</p>

</dd>
<dt><b>--echo-commands</b></dt>
<dd>

<p>Echo system commands about to be executed (useful for debugging)</p>

</dd>
<dt><b>--echo-output</b></dt>
<dd>

<p>Echo commands&#39; output (useful for debugging)</p>

</dd>
</dl>

<h1 id="SEE-ALSO">SEE ALSO</h1>

<p><a href="../serge-pull/">serge-pull</a>, <a href="../serge-pull-ts/">serge-pull-ts</a>, <a href="../serge-localize/">serge-localize</a>, <a href="../serge-push-ts/">serge-push-ts</a>, <a href="../serge-push/">serge-push</a></p>

<p>Part of <a href="../serge/">serge</a> suite.</p>


<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/help-footer.php') ?>

