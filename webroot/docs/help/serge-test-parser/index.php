<?php
    $command = 'serge-test-parser';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/help-header.php');
?>


<h1 id="NAME">NAME</h1>

<p>serge-test-parser - Test parser against any given file</p>

<h1 id="SYNOPSIS">SYNOPSIS</h1>

<p><code>serge test-parser &lt;parser_name&gt; &lt;file_path&gt; [--import-mode] [--output-mode=&lt;mode&gt;]</code></p>

<p>Where <code>&lt;parser_name&gt;</code> is a file name of the parser sans its extension (parsers are typically located in lib/Serge/Engine/Plugin folder), and <code>&lt;file_path&gt;</code> is a path to the localizable file to test this parser on.</p>

<h1 id="DESCRIPTION">DESCRIPTION</h1>

<p>Parse the given file using the selected parser and emit the resulting data in one of the available formats. This is useful for writing new parsers.</p>

<h1 id="OPTIONS">OPTIONS</h1>

<dl>

<dt><b>--import-mode</b></dt>
<dd>

<p>With this option, parser will be told it works in import mode. In such mode import-aware parsers are expected to extract translations rather than source strings, and also skip missing translations.</p>

</dd>
<dt><b>--output-mode=mode</b></dt>
<dd>

<p>By default, parsed data will be emitted in an easily readable Config::Neat format (the format used in Serge configuration files). Such files are also suitable for diff. However, there are alternative output modes available:</p>

<dl>

<dt><b>dumper</b></dt>
<dd>

<p>Use Data::Dumper to dump the parsed structure. The format is a bit verbose, but can be handy for debugging.</p>

</dd>
</dl>

</dd>
</dl>

<h1 id="SEE-ALSO">SEE ALSO</h1>

<p>Part of <a href="../serge/">serge</a> suite.</p>


<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/help-footer.php') ?>

