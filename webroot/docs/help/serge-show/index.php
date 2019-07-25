<?php
    $command = 'serge-show';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/help-header.php');
?>


<h1 id="NAME">NAME</h1>

<p>serge-show - Show expanded version of a configuration file</p>

<h1 id="SYNOPSIS">SYNOPSIS</h1>

<p><code>serge show &lt;configuration-file&gt;</code></p>

<p>Where <code>&lt;configuration-file&gt;</code> is a path to a specific .serge file.</p>

<h1 id="DESCRIPTION">DESCRIPTION</h1>

<p><b>serge-show</b> prints out the interpreted configuration file by applying all inheritance rules. This is useful to check the full configuration that will be used by Serge.</p>

<h1 id="SEE-ALSO">SEE ALSO</h1>

<p>Part of <a href="../serge/">serge</a> suite.</p>


<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/help-footer.php') ?>

