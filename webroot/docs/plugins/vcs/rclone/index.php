<?php
    $section = 'vcs-plugins';
    $subpage = 'ref-plugin-rclone';
    $title = 'Rclone Synchronization Plugin';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');

    //$available_since = '1.5';
    //include($_SERVER['DOCUMENT_ROOT'] . '/../inc/version-selector.php');
?>

<h1><?php echo htmlspecialchars($title) ?></h1>

<p>Plugin source location: <code>&lt;serge_root&gt;/lib/Serge/Sync/Plugin/VCS/rclone.pm</code></p>

<p>This plugin is a wrapper for <a href="https://rclone.org/">Rclone</a>—a command-line tool that enables synchronization with cloud-based storage solutions like Amazon S3, Google Drive, Dropbox, FTP/SFTP, Microsoft OneDrive, and many others. To use this plugin, you need to have <code>rclone</code> tool installed on your system.</p>

<p>Cloud storage solutions don't usually provide versioning capabilities, so using something like <a href="/docs/plugins/vcs/git/">Git</a> is preferable. Still, in certain cases an ability to exchange localization files with a cloud storage might be handy.</p>

<p>This plugin provides a convenience of using <code><a href="/docs/help/serge-pull/">pull</a></code> sync step to download source files from a cloud storage, then using <code><a href="/docs/help/serge-push/">push</a></code> sync step to upload localized data back to a cloud storage. See <a href="/docs/localization-cycle/">Localization Cycle</a> for more information.</p>

<h2>Usage</h2>

<figure>
    <figcaption>example-project.serge</figcaption>
    <script language="text/x-config-neat">
sync
{
    vcs
    {
        plugin                   rclone

        data
        {
            /*
            (STRING) [OPTIONAL] Path to the Rclone configuration file
            that stores information about remotes (API keys, tokens,
            and so on). Use `rclone config` to manage remotes.

            Path can be relative to the configuration file,
            or absolute.

            %ENV:<...>% macros in paths are expanded
            before each path is converted to an absolute one.
            */
            config                ./rclone.conf

            /*
            (ARRAY) [OPTIONAL] Common command-line parameters
            to pass to `rclone sync` both during pull and push steps.
            See `rclone sync --help` and `rclone help flags`
            for the list of available parameters.
            */
            parameters           --log-level INFO

            /*
            This section defines what
            */
            pull
            {
                /*
                (STRING) Source (remote) to pull data from.
                Here `S3` is a name of a remote
                as defined in ./rclone.conf
                */
                source           S3:some-bucket/source

                /*
                (STRING) Destination (local) directory.
                */
                dest             ../vcs/example-project/source

                /*
                (ARRAY) [OPTIONAL] Command-line parameters
                to pass to `rclone sync` in addition to common ones.
                */
                parameters       --progress
            }

            push
            {
                /*
                (STRING) Source (local) directory.
                */
                source           ../vcs/example-project/target

                /*
                (STRING) Destination (remote) to push data to.
                */
                dest             S3:some-bucket/target

                /*
                (ARRAY) [OPTIONAL] Command-line parameters
                to pass to `rclone sync` in addition to common ones.
                */
                parameters       --dry-run
            }
        }
    }

    # other sync parameters
    # ...
}
</script>
</figure>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-footer.php') ?>

