<?php
	$page = 'download';
	include($_SERVER['DOCUMENT_ROOT'] . '/../inc/header.php');
?>

<h1>Stable Releases</h1>

<p>Serge, being written in Perl, is published on <a href="http://www.cpan.org/">CPAN</a>. Run the following command to install the latest stable release:</p>

<code class="block">cpan Serge</code>

<p>`cpan` command line client will take care of all dependencies.</p>

<h1>The Bleeding Edge</h1>

<p>Serge is being actively developed, so make sure you visit our offical repository: <a href="https://github.com/evernote/serge">github.com/evernote/serge</a></p>

<p>Serge can work off of any directory. So create a new directory, switch to it, and either download the snapshot as a ZIP archive:</p>

<code class="block">wget https://github.com/evernote/serge/archive/master.zip
unzip master.zip</code>

<p>or clone the repo:</p>

<code class="block">git clone git@github.com:evernote/serge.git</code>

<p>Then add the <code>&lt;serge_root&gt;/bin</code> directory to your <code>$PATH</code> environment variable, so that you can simply say `<code>serge</code>` in the console to run it.</p>

<p>In case you use the latest snapshot, you will need to manage dependencies yourself. You can run `<code>&lt;serge_root&gt;/bin/tools/check_dependencies.pl --install</code>` to check if all dependencies are installed and attempt to install the missing ones from CPAN.</p>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/footer.php') ?>
