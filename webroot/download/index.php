<?php
    $page = 'download';
    $title = 'Download';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/header.php');
?>

<h1>System Requirements</h1>

<p>Serge can run on any OS with <strong>Perl 5.10 or higher</strong>. Modern Mac OS and Unix systems have Perl already installed. On Windows, we recommend installing <a href="http://strawberryperl.com/">Strawberry Perl</a>.</p>

<p>You also need your favorite <strong>VCS client</strong> (e.g. Git or SVN) to be installed and properly configured for Serge to be able to talk to your remote repositories (but this is not required if you are going to use Serge in a localization-only mode).</p>

<p class="notice">Make sure you have enough permissions to install new software/packages/modules; on Unix, use <code>su</code> or <code>sudo</code>.</p>

<?php /*
<h1>Stable Releases</h1>

<p>Serge, being written in Perl, is published on <a href="http://www.cpan.org/">CPAN</a>. Run the following command to install or upgrade to the latest stable release:</p>

<code class="cli">cpan Serge</code>
*/ ?>

<h1>Installation</h1>

<h2>Step 1. Create a Directory for Serge</h2>

<p>Serge can work in any directory. So create a new directory (we will reference it as <code><em>&lt;serge_root&gt;</em></code> hereafter).

<h2>Step 2. Download Sources</h2>

<p>Serge is being actively developed, and its source code is available <a href="https://github.com/evernote/serge">on GitHub</a>. Code in master branch is considered a bleeding edge version; stable releases are marked with <a href="https://github.com/evernote/serge/releases">release tags</a>.</p>

<p>Pick the option that works best for you:</p>

<h3>A. Clone the Repository</h3>

<code class="cli">cd <em>&lt;serge_root&gt;</em>
git clone git@github.com:evernote/serge.git .</code>

<h3>B. Download a Snapshot</h3>

<code class="cli">cd <em>&lt;serge_root&gt;</em>
wget https://github.com/evernote/serge/archive/<em>&lt;version&gt;</em>.zip
unzip <em>&lt;version&gt;</em>.zip
unlink <em>&lt;version&gt;</em>.zip</code>

<h2>Step 3. Install Dependencies</h2>

<p>Some dependency Perl modules include binaries that need to be compiled from sources. If you're on a Linux machine and don't have a <code>make</code> utility installed, you may need to run your favorite package manager to install build essentials. On Ubuntu/Debian this will be:</p>

<code class="cli">apt-get install build-essential</code>

<p>Installing/upgrading dependencies is done with the help of <code>cpanm</code> package manager, which needs to be installed with the following command:</p>

<code class="cli">cpan App::cpanminus</code>

Once you have it installed, run the following command in <code><em>&lt;serge_root&gt;</em></code> directory:

<code class="cli">cpanm --installdeps .</code>

<h2>Step 4. Add Serge to Your PATH</h2>

<p>Add the <code><em>&lt;serge_root&gt;</em>/bin</code> directory to your <code>PATH</code> environment variable so that you can run if from any directory.</p>

<h2>Step 5. Verify the Installation</h2>

<p>Run this command:</p>

<code class="cli">serge</code>

<p>If you see command-line help from Serge, then everything has been set up correctly.</p>

<h2>Step 6. Generate HTML Help</h2>

<p>If you're installing Serge on your development machine, you can take advantage of using HTML help that will open in your browser. Run the following command to generate HTML version of the help for Serge commands:</p>

<code class="cli">serge gendocs</code>

<p>To test the result, run:</p>

<code class="cli">serge help</code>

<p>This will open a help page in the browser.</p>

<p>Now, <a href="/docs/">get started with Serge workflow and configuration &rarr;</a></p>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/footer.php') ?>
