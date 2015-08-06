<?php
    $page = 'download';
    $title = 'Download';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/header.php');
?>

<h1>System Requirements</h1>

<p>Serge can run on any OS with <strong>Perl 5.10 or higher</strong>. Modern Mac OS and Unix systems have Perl already installed. On Windows, we recommend installing <a href="http://strawberryperl.com/">Strawberry Perl</a>.</p>

<p>You also need your favorite <strong>VCS client</strong> (e.g. Git or SVN) to be installed and properly configured for Serge to be able to talk to your remote repositories (but this is not required if you are going to use Serge in a localization-only mode).</p>

<p class="notice">Make sure you have enough permissions to install new software/packages/modules; on Unix, use <code>su</code> or <code>sudo</code>.</p>

<p>Some dependency Perl modules include binary modules that need to be compiled from sources. If you're on a Linux machine and don't have a <code>make</code> utility installed, you may need to run your favorite package manager to install build essentials. On Ubuntu/Debian this will be:</p>

<code class="cli">apt-get install build-essential</code>

<?php /*
<h1>Stable Releases</h1>

<p>Serge, being written in Perl, is published on <a href="http://www.cpan.org/">CPAN</a>. Run the following command to install or upgrade to the latest stable release:</p>

<code class="cli">cpan Serge</code>
*/ ?>

<h1>The Bleeding Edge</h1>

<p>Serge is being actively developed, so make sure you visit our offical repository: <a href="https://github.com/evernote/serge">github.com/evernote/serge</a>. If you decide to use the bleeding edge version of Serge, follow the instructions below.</p>

<p>Serge can work in any directory. So create a new directory (we will reference it as <code><em>&lt;serge_root&gt;</em></code> hereafter), and clone the repo:

<code class="cli">cd <em>&lt;serge_root&gt;</em>
git clone git@github.com:evernote/serge.git .</code>

<p>or download the snapshot as a ZIP archive:</p>

<code class="cli">cd <em>&lt;serge_root&gt;</em>
wget https://github.com/evernote/serge/archive/master.zip
unzip master.zip
unlink master.zip</code>

<p>Then add the <code><em>&lt;serge_root&gt;</em>/bin</code> directory to your <code>PATH</code> environment variable.</p>

<p>After unpacking the source, you will need to install/upgrade dependencies. This is done with the help of <code>cpanm</code> package manager, which can itself be installed with the following command:</p>

<code class="cli">cpan App::cpanminus</code>

Once you have it installed, run the following:

<code class="cli">cpanm --installdeps .</code>

<h1>Verify the Installation</h1>

<p>Run this command:</p>

<code class="cli">serge</code>

<p>If you see command-line help from Serge, then everything has been set up correctly.</p>

<p>Now, <a href="/docs/">get started with Serge workflow and configuration &rarr;</a></p>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/footer.php') ?>
