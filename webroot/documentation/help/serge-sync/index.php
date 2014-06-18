<?php
    $command = 'serge-sync';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/help-header.php');
?>


<h1 id="NAME">NAME</h1>

<p>serge-sync - Perform a full synchronization + localization cycle</p>

<h1 id="SYNOPSIS">SYNOPSIS</h1>

<p><code>serge sync &lt;configuration-files&gt; [--force] [--no-cache-preload] [--recreate-po] [--lang=aa,bb,cc] [--jobs=foo,bar]</code></p>

<p>Where <code>&lt;configuration-files&gt;</code> is a path to a specific .serge file, or a directory to scan .serge files in. You can specify multiple paths as separate command-line parameters.</p>

<h1 id="DESCRIPTION">DESCRIPTION</h1>

<p>For all provided configuration files, run `pull`, `pull-po`, `localize`, `push-po` and `push` commands in one cycle.</p>

<h1 id="OPTIONS">OPTIONS</h1>

<dl>

<dt><b>--force</b></dt>
<dd>

<p>Has the same effect as <code><a href="../serge-pull-po/">serge pull-po --force</a></code> and <code><a href="../serge-localize/">serge localize --force</a></code> combined.</p>

</dd>
<dt><b>--no-cache-preload</b></dt>
<dd>

<p>Has the same effect as <code><a href="../serge-localize/">serge localize --no-cache-preload</a></code>.</p>

</dd>
<dt><b>--recreate-po</b></dt>
<dd>

<p>Has the same effect as <code><a href="../serge-localize/">serge localize --recreate-po</a></code>.</p>

</dd>
<dt><b>--lang=xx[,yy][,zz]</b>, <b>--language=xx[,yy][,zz]</b> <b>--languages=xx[,yy][,zz]</b></dt>
<dd>

<p>See <code><a href="../serge-localize/">serge localize --lang</a></code>. Will also completely skip processing configs where no target languages are found.</p>

</dd>
<dt><b>--job=xx[,yy][,zz]</b>, <b>--jobs=xx[,yy][,zz]</b></dt>
<dd>

<p>See <code><a href="../serge-localize/">serge localize --job</a></code>. Will also completely skip processing configs where no target jobs are found.</p>

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

<p><a href="../serge-pull/">serge-pull</a>, <a href="../serge-pull-po/">serge-pull-po</a>, <a href="../serge-localize/">serge-localize</a>, <a href="../serge-push-po/">serge-push-po</a>, <a href="../serge-push/">serge-push</a></p>

<p>Part of <a href="../serge/">serge</a> suite.</p>


<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/help-footer.php') ?>

