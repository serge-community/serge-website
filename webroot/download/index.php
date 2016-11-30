<?php
    $page = 'download';
    $title = 'Download';

    // parse param string like 'win/stable' or 'unix/latest'

    $params = explode('/', $_SERVER['QUERY_STRING'], 2);
    $os = $params[0];

    if ($os != '') {
        $os = ($os == 'win') || ($os == 'unix') || ($os == 'mac') ? $os : '';
    }

    if ($os == '') {
        $ua = $_SERVER['HTTP_USER_AGENT'];

        if (preg_match('/Windows/', $ua)) {
            $os = 'win';
        } elseif (preg_match('/Macintosh/', $ua)) {
            $os = 'mac';
        } else {
            $os = 'unix';
        }
    }

    $version = $params[1] == 'latest' ? 'latest' : 'stable';

    $head = '
        <script src="/media/vendor/jquery/jquery-2.1.1.min.js"></script>
        <script src="/media/vendor/jquery/jquery.timeago.min.js"></script>
        <script>
            var version = "'.$version.'";
            var os = "'.$os.'";
        </script>

        <style>
            h3 a {
                font-weight: 400;
            }
        </style>
    ';

    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/header.php');
?>

<h1>Before You Start</h1>

<h3>Choose Your Patform</h3>
<ul class="menu selector" id="os_selector">
    <li><a id="os_win">Windows</a></li>
    <li><a id="os_unix">Unix</a></li>
    <li><a id="os_mac">Mac OS</a></li>
</ul>

<p>Below you will see instructions on installing Serge on your system with the necessary dependencies. If you prefer to keep things isolated, you can also <a href="https://github.com/evernote/serge-dockerfiles">install Serge as a Docker container</a>.</p>

<h3>Select Preferred Version</h3>
<ul class="menu selector" id="version_selector">
    <li><a id="version_latest">Latest</a><div id="latest_master_info"></div></li>
    <li><a id="version_stable">Stable (<span class="tag_name"></span>)</a><div id="latest_release_info"></div></li>
</ul>

<p>Serge source code is available <a href="https://github.com/evernote/serge">on GitHub</a>. Code in <code>master</code> branch is considered the latest version; stable releases are marked with <a href="https://github.com/evernote/serge/releases">release tags</a>.</p>

<h1>Installing Serge on
    <span class="win">Windows</span>
    <span class="unix">Unix</span>
    <span class="mac">Mac OS</span>
</h1>

<p>
    Serge can run on any OS with <strong>Perl 5.10 or higher</strong>.
    <span class="mac unix"><span class="unix">Unix</span><span class="mac">Mac OS</span> systems have Perl already installed.</span>
    <span class="win">On Windows, we recommend installing <a href="http://strawberryperl.com/">Strawberry Perl</a>.</span>
</p>

<p>You can check your Perl version by running this command:</p>
<code class="cli">perl -v</code>

<!--
<p>If you plan to use Serge in full sync mode (that is, to pull and push data to your version control system, like Git, Mercurial or SVN), it is assumed that you have the client command-line application for it installed and properly configured. This is not needed if you plan to use Serge in a localization-only mode (generate/update resource files locally).</p>
-->

<h2>Step 1. Create a Directory for Serge</h2>

<p>Serge can work in any directory. So create a new directory for Serge application files. For example:</p>

<code class="cli unix mac">mkdir ~/serge</code>
<code class="cli win">mkdir C:\Serge</code>

<h2>Step 2. Download the <span class="stable">Stable Release</span><span class="latest">Latest Code Snapshot</span></h2>


<!--<h3>Download <span class="stable">Stable Release</span><span class="latest">Latest Code</span></h3>-->

<section class="mac unix">
   <code class="cli">cd ~/serge
wget https://github.com/evernote/serge/archive/<span class="latest">master</span><span class="stable"><span class="tag_name"><em>&lt;version&gt;</em></span></span>.zip -O serge-<span class="latest">master</span><span class="stable"><span class="tag_name"><em>&lt;version&gt;</em></span></span>.zip</span>
unzip serge-<span class="latest">master</span><span class="stable"><span class="tag_name"><em>&lt;version&gt;</em></span></span>.zip
unlink serge-<span class="latest">master</span><span class="stable"><span class="tag_name"><em>&lt;version&gt;</em></span></span>.zip
cd serge-<span class="latest">master</span><span class="stable"><span class="tag_name"><em>&lt;version&gt;</em></span></span></code>
</section>

<section class="win">
    <p>Download <a id="download_link" href="#">https://github.com/evernote/serge/archive/<span class="latest">master</span><span class="stable"><span class="tag_name"><em>&lt;version&gt;</em></span></span>.zip</a> and unpack it to <code>C:\Serge</code>.</p>
</section>

<h2>Step 3. Install Dependencies</h2>

<section class="unix">
    <p>Some Perl modules that you're about to install in step 3.2 require compiling binaries from sources. Run your package manager to install build essentials and library headers. For example, on Ubuntu/Debian this will be:</p>

    <code class="cli">sudo apt-get -qq update
sudo apt-get -qq -y install build-essential libssl-dev libexpat-dev</code>
</section>

<p>Installing/upgrading Perl dependencies is done with the help of <code>cpanm</code> package manager, which needs to be installed with the following command:</p>

<code class="cli"><span class="mac unix">sudo </span>cpan App::cpanminus</code>

Once you have it installed, run the following commands:

<code class="cli">cd <span class="unix mac">~/serge/</span><span class="win">C:\Serge\</span>serge-<span class="latest">master</span><span class="stable"><span class="tag_name"><em>&lt;version&gt;</em></span></span>
<span class="mac unix">sudo </span>cpanm --installdeps .</code>

<h2>Step 4. Make Serge Available from Any Directory</h2>

<p class="win">Add <code>C:\Serge\serge-<span class="latest">master</span><span class="stable"><span class="tag_name"><em>&lt;version&gt;</em></span></span>\bin</code> directory to your <code>PATH</code> environment variable in Windows settings (make sure to remove the path to the previous version of Serge if it was there). After that you will need to close and open a new shell window so that it would pick up the changes.</p>

<p class="mac unix">Create a symlink to <code>serge</code> binary:</p>
<code class="cli mac unix">sudo ln -s ~/serge/serge-<span class="latest">master</span><span class="stable"><span class="tag_name"><em>&lt;version&gt;</em></span></span>/bin/serge /usr/local/bin/serge</code>

<h2>Step 5. Verify the Installation</h2>

<p>Run this command to see command-line help from Serge:</p>

<code class="cli">serge</code>

<section class="win">
    <h2>Step 6. Generate HTML Help</h2>

    <p>If you're installing Serge on your development machine, you can take advantage of using HTML help that will open in your browser. Run the following command to generate the HTML version of the help for Serge commands:</p>

    <code class="cli">serge gendocs</code>

    <p>To test the result, run:</p>

    <code class="cli">serge help</code>

    <p>This will open a help page in the browser.</p>
</section>

<p>Now, <a href="/docs/">get started with Serge workflow and configuration &rarr;</a></p>

<script type="text/javascript">
    $(document).ready(function () {
        var project = 'evernote/serge';

        // update master branch information
        $.getJSON('https://api.github.com/repos/'+project+'/branches/master').done(function (branch) {
            if (branch.commit) {
                $('#latest_master_info').html('updated ' + $.timeago(branch.commit.commit.committer.date));
            }
        });

        // update latest release information
        $.getJSON('https://api.github.com/repos/'+project+'/releases/latest').done(function (release) {
            if (release.assets) {
                $('.tag_name').text(release.tag_name.replace(' ', '+'));
                var esc_tag_name = $("<div>").text(release.tag_name).html();
                $('#latest_release_info').html('released ' + $.timeago(release.published_at));
            }
            $('#download_link').each(function() {
                $(this).attr('href', $(this).text());
            });
        });

        function updateState() {
            $('.content').removeClass().addClass('content').addClass(version).addClass(os);
            history.replaceState(undefined, undefined, '?'+os+'/'+version+location.hash);
        }

        updateState()

        $('#os_win').on('click', function() {
            os = 'win';
            updateState();
        });

        $('#os_unix').on('click', function() {
            os = 'unix';
            updateState();
        });

        $('#os_mac').on('click', function() {
            os = 'mac';
            updateState();
        });

        $('#version_latest').on('click', function() {
            version = 'latest';
            updateState();
        });

        $('#version_stable').on('click', function() {
            version = 'stable';
            updateState();
        });
    });
</script>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/footer.php') ?>
