<?php
    $section = 'vcs-plugins';
    $subpage = 'ref-plugin-gerrit';
    $title = 'Gerrit Synchronization Plugin';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');
?>

<h1><?php echo htmlspecialchars($title) ?></h1>

<p>Plugin source location: <code>&lt;serge_root&gt;/lib/Serge/Sync/Plugin/VCS/gerrit.pm</code></p>

<p>This plugin provides integration with <a href="https://www.gerritcodereview.com/">Gerrit</a>-based source code repositories. Gerrit is a code review system built on top of Git, and it has a different way of submitting changes to the remote server (no direct `git push`). This plugin inherits its core behavior and settings from the <a href="/docs/plugins/vcs/git/">git plugin</a>, and automatically self-reviews the commiited change in Gerrit.</p>

<h2>Usage</h2>

<figure>
    <figcaption>example-project.serge</figcaption>
    <script language="text/x-config-neat">
sync
{
    vcs
    {
        plugin                   gerrit

        data
        {
            # (STRING) Gerrit username to review the change on behalf of
            user                 l10n

            # all other settings are inherited from the `git` plugin
            # ...
        }
    }

    # other sync parameters
    # ...
}
</script>
</figure>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-footer.php') ?>

