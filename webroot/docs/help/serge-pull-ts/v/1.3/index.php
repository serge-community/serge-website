<?php
    $command = 'serge-pull-ts';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/help-header.php');

    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/version-selector.php');
?>


<h1 id="NAME">NAME</h1>

<p>serge-pull-ts - Pull translation files from translation server</p>

<h1 id="SYNOPSIS">SYNOPSIS</h1>

<p><code>serge pull-ts [configuration-files] [--force] [--echo-commands] [--echo-output]</code></p>

<p>Where <code>[configuration-files]</code> is a path to a specific .serge file, or a directory to scan .serge files in. You can specify multiple paths as separate command-line parameters. If no paths provided, Serge will look up for .serge files in the current directory.</p>

<h1 id="DESCRIPTION">DESCRIPTION</h1>

<p>Based on each configuration file&#39;s <b>job</b> section, pull updated translation files from remote translation server into the local directory.</p>

<h1 id="OPTIONS">OPTIONS</h1>

<dl>

<dt><b>--force</b></dt>
<dd>

<p>Instruct the remote party to skip any optimizations and force update all translation files.</p>

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

<p>Part of <a href="../serge/">serge</a> suite.</p>


<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/help-footer.php') ?>

