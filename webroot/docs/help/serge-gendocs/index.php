<?php
    $command = 'serge-gendocs';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/help-header.php');
?>


<h1 id="NAME">NAME</h1>

<p>serge-gendocs - Generate HTML docs from POD</p>

<h1 id="SYNOPSIS">SYNOPSIS</h1>

<p><code>serge gendocs</code></p>

<h1 id="DESCRIPTION">DESCRIPTION</h1>

<p>Scans all .pod files under doc/pod directory and subdirectories and for each file renders its HTML representation under doc/html.</p>

<p><a href="../serge-help/">serge-help</a> uses these HTML files internally to show help on commands in your browser rather than in console (depending on your OS).</p>

<h1 id="SEE-ALSO">SEE ALSO</h1>

<p><a href="../serge-help/">serge-help</a></p>

<p>Part of <a href="../serge/">serge</a> suite.</p>


<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/help-footer.php') ?>

