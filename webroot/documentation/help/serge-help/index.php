<?php
    $command = 'serge-help';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/help-header.php');
?>


<h1 id="NAME">NAME</h1>

<p>serge-help - Show help on serge and its commands</p>

<h1 id="SYNOPSIS">SYNOPSIS</h1>

<p><code>serge help [--console]</code></p>

<p><code>serge help &lt;command&gt; [--console]</code></p>

<h1 id="DESCRIPTION">DESCRIPTION</h1>

<p>Show help on particular command (if it is provided), or general information about serge. By default (and depending on your operating system), it will try to open and HTML version of the help in your browser. Otherwise it will render a plain-text version in the console.</p>

<p>For the list of available commands, just run <code>serge</code> with no command-line parameters.</p>

<h1 id="OPTIONS">OPTIONS</h1>

<dl>

<dt><b>--console</b></dt>
<dd>

<p>Do not try to open HTML help in browser; render help in console instead.</p>

</dd>
</dl>

<h1 id="SEE-ALSO">SEE ALSO</h1>

<p>Part of <a href="../serge/">serge</a> suite.</p>


<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/help-footer.php') ?>

