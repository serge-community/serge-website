<?php
    $command = 'serge-clean-po';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/help-header.php');
?>


<h1 id="NAME">NAME</h1>

<p>serge-clean-po - Delete orphaned .po files</p>

<h1 id="SYNOPSIS">SYNOPSIS</h1>

<p><code>serge clean-po &lt;configuration-files&gt; [--dry-run] [--for-each=&quot;do something with &#39;[PATH]&#39;&quot;]</code></p>

<p>Where <code>&lt;configuration-files&gt;</code> is a path to a specific .serge file, or a directory to scan .serge files in. You can specify multiple paths as separate command-line parameters.</p>

<h1 id="DESCRIPTION">DESCRIPTION</h1>

<p>Gather all target .po directories and known .po file paths from all provided configuration files (assuming that path to .po files contains a /%LOCALE%/ folder, otherwise the script will bail out), then delete all unknown (orphaned) .po files from those target directories.</p>

<h1 id="OPTIONS">OPTIONS</h1>

<dl>

<dt><b>--dry-run</b></dt>
<dd>

<p>Just report orphaned .po files, do not delete them.</p>

</dd>
<dt><b>--for-each=command</b></dt>
<dd>

<p>For each deleted file or deleted empty folder, run the specified command. The command is ran <b>after</b> the deletion. Inside command, use the &#39;[PATH]&#39; placeholder, which will be substituted with the full path to the file or directory. Make sure to surrond [PATH] in quotes according to your shell rules if the paths are likely to contain spaces.</p>

</dd>
</dl>

<h1 id="SEE-ALSO">SEE ALSO</h1>

<p>Part of <a href="../serge/">serge</a> suite.</p>


<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/help-footer.php') ?>

