<?php
    $page = 'download';
    $title = 'Download';

    $head = '
        <script src="/media/vendor/jquery/jquery-2.1.1.min.js"></script>
        <script src="/media/vendor/jquery/jquery.timeago.min.js"></script>
    ';

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

<p>Serge can work in any directory. So create a new directory (we will reference it as <code><em>&lt;serge_root&gt;</em></code> hereafter). For example:</p>

<code class="cli">mkdir ~/serge</code>

<h2>Step 2. Download Sources</h2>

<p>Serge is being actively developed, and its source code is available <a href="https://github.com/evernote/serge">on GitHub</a>. Code in master branch is considered a bleeding edge version; stable releases are marked with <a href="https://github.com/evernote/serge/releases">release tags</a>.</p>

<p>Pick the option that works best for you:</p>

<h3>A. Clone the Repository</h3>

<code class="cli">cd <em>&lt;serge_root&gt;</em>
git clone git@github.com:evernote/serge.git
cd serge</code>

<h3>B. Download Latest Stable Snapshot</h3>

<p>Latest stable release: <span id="latest_release_info"><a href="https://github.com/evernote/serge/releases/latest">See this page</a></span></p>

<code class="cli">cd <em>&lt;serge_root&gt;</em>
wget https://github.com/evernote/serge/archive/<em class="tag_name">&lt;version&gt;</em>.zip -O serge-<em class="tag_name">&lt;version&gt;</em>.zip</span>
unzip serge-<em class="tag_name">&lt;version&gt;</em>.zip
unlink serge-<em class="tag_name">&lt;version&gt;</em>.zip
cd serge-<em class="tag_name">&lt;version&gt;</em></code>

<h2>Step 3. Install Dependencies</h2>

<p>Some dependency Perl modules include binaries that need to be compiled from sources. If you're on a Linux machine, run your package manager to install build essentials and libssl headers. On Ubuntu/Debian this will be:</p>

<code class="cli">apt-get -qq update
apt-get -qq -y install build-essential libssl-dev</code>

<p>Installing/upgrading dependencies is done with the help of <code>cpanm</code> package manager, which needs to be installed with the following command:</p>

<code class="cli">cpan App::cpanminus</code>

Once you have it installed, run the following command in <code><em>&lt;serge_root&gt;</em>/serge-<em class="tag_name">&lt;version&gt;</em></code> directory:

<code class="cli">cpanm --installdeps .</code>

<h2>Step 4. Add Serge to Your PATH</h2>

<p>Add the <code><em>&lt;serge_root&gt;</em>/serge-<em class="tag_name">&lt;version&gt;</em>/bin</code> directory to your <code>PATH</code> environment variable so that you can run if from any directory.</p>

<h2>Step 5. Verify the Installation</h2>

<p>Run this command:</p>

<code class="cli">serge</code>

<p>If you see command-line help from Serge, then everything has been set up correctly.</p>

<h2>Step 6. Generate HTML Help</h2>

<p>If you're installing Serge on your development machine, you can take advantage of using HTML help that will open in your browser. Run the following command to generate the HTML version of the help for Serge commands:</p>

<code class="cli">serge gendocs</code>

<p>To test the result, run:</p>

<code class="cli">serge help</code>

<p>This will open a help page in the browser.</p>

<p>Now, <a href="/docs/">get started with Serge workflow and configuration &rarr;</a></p>

<script type="text/javascript">
    $(document).ready(function () {
        var project = 'evernote/serge';
        $.getJSON('https://api.github.com/repos/'+project+'/releases/latest').done(function (release) {
            if (release.assets) {
                $('.tag_name').text(release.tag_name.replace(' ', '+'));
                var esc_tag_name = $("<div>").text(release.tag_name).html();
                $('#latest_release_info').html('<strong>' + esc_tag_name + '</strong> (released ' + $.timeago(release.published_at) + ')');
            }
        });
    });
</script>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/footer.php') ?>
