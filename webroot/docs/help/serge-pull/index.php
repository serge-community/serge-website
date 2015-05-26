<?php
    $command = 'serge-pull';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/help-header.php');
?>


<h1 id="NAME">NAME</h1>

<p>serge-pull - Pull project files from source control</p>

<h1 id="SYNOPSIS">SYNOPSIS</h1>

<p><code>serge pull &lt;configuration-files&gt; [--initialize] [--echo-commands] [--echo-output]</code></p>

<p>Where <code>&lt;configuration-files&gt;</code> is a path to a specific .serge file, or a directory to scan .serge files in. You can specify multiple paths as separate command-line parameters.</p>

<h1 id="DESCRIPTION">DESCRIPTION</h1>

<p>Based on each configuration file&#39;s <b>job</b> section, pull changes from source control (e.g. Git or SVN) into the local working directory. Per configuration file settings, there might be several subdirectories mapped to different remote repositories, which will be pulled in one step.</p>

<p><b>Caution</b>: Before the data is downloaded, all unversioned files in the working directory are removed, and pending rebase is aborted, so the working directory should not be the one you are doing any development in.</p>

<h1 id="OPTIONS">OPTIONS</h1>

<dl>

<dt><b>--initialize</b></dt>
<dd>

<p>Allow the script to reconfigure the local checkout (re-sync from scratch, delete extra folders) if the local working dir is missing or the contents of the local project folder differ from the expected one.</p>

<p>If this option is not specified, then, in such an event, the script will report an error and skip processing the configuration file. This is to prevent massive re-syncing on misconfiguration or transient networking errors.</p>

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

