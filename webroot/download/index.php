<?php
	$page = 'download';
    $title = 'Download';
	include($_SERVER['DOCUMENT_ROOT'] . '/../inc/header.php');
?>

<h1>System Requirements</h1>

<p>Serge can run on any OS with <strong>Perl 5.10 or higher</strong>. Modern Mac OS and Unix systems have Perl already installed. On Windows, we recommend installing <a href="http://strawberryperl.com/">Strawberry Perl</a>.</p>

<p>You also need your favorite <strong>VCS client</strong> (e.g. Git or SVN) to be installed and properly configured for Serge to be able to talk to your remote repositories (but this is not required if you are going to use Serge in a localization-only mode).</p>

<h1>Stable Releases</h1>

<p>Serge, being written in Perl, is published on <a href="http://www.cpan.org/">CPAN</a>. Run the following command to install or upgrade to the latest stable release (make sure you run this as an administrator; on Unix, use <code>sudo</code>):</p>

<code class="cli">cpan Serge</code>

<p>`cpan` is a command line package installation client that either comes with Perl or can be installed separately using your package manager. It will take care of all missing dependencies.</p>

<h1>The Bleeding Edge</h1>

<p>Serge is being actively developed, so make sure you visit our offical repository: <a href="https://github.com/evernote/serge">github.com/evernote/serge</a></p>

<p>Serge can work in any directory. So create a new directory (we will reference it as <code>&lt;serge_root&gt;</code> hereafter), and clone the repo:

<code class="cli">cd &lt;serge_root&gt;
git clone git@github.com:evernote/serge.git .</code>

<p>or download the snapshot as a ZIP archive:</p>

<code class="cli">cd &lt;serge_root&gt;
wget https://github.com/evernote/serge/archive/master.zip
unzip master.zip
unlink master.zip</code>

<p>Then add the <code>&lt;serge_root&gt;/bin</code> directory to your <code>PATH</code> environment variable.</p>

<p>In case you use the latest snapshot, you will need to manage dependencies yourself. This command will install missing dependencies into system (make sure you run this as an administrator):

<code class="cli">cd &lt;serge_root&gt;
cpanm --installdeps .</code>

<p>See also <code>&lt;serge_root&gt;/README</code> file for a list of other installation options (including installing dependencies locally if you don't have administrative rights).</p>

<h1>Verify the Installation</h1>

<p>Run this command:</p>

<code class="cli">serge</code>

<p>If you see command-line help from Serge, then everything has been set up correctly.</p>

<p>Now, <a href="/documentation/">get started with Serge workflow and configuration &rarr;</a></p>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/footer.php') ?>
