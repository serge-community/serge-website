<?php
    $section = 'vcs-plugins';
    $subpage = 'ref-plugin-svn';
    $title = 'Subversion Synchronization Plugin';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');
?>

<h1><?php echo htmlspecialchars($title) ?></h1>

<p>Plugin source location: <code>&lt;serge_root&gt;/lib/Serge/Sync/Plugin/VCS/svn.pm</code></p>

<p>This plugin provides integration with <a href="https://subversion.apache.org/">Subversion</a>-based source code repositories. On <code><a href="/docs/help/serge-pull/">pull</a></code> sync step, Serge will update its local checkout from your Subversion server. Respectively, on <code><a href="/docs/help/serge-push/">push</a></code> sync step, Serge will push all the updated files back to the remote repository.</p>

<p>Communication between Serge and Subversion is performed by the means of running <code>svn</code> command-line tool. This means that Subversion must be installed on the same machine as Serge.</p>

<p>Each configuration file in Serge represents a single translation project, and maps to one or more remote source code repositories (in case of multiple repositories, they all need to be under the same version control and have the same committer configured, since VCS plugin name and committer username are shared within a configuration file). The typical workflow is this:</p>

<ol>
    <li>Create a root directory that will hold all your checkouts, e.g. <code>/var/serge/data/</code></li>
    <li>Create a new Serge configuration file (let's call it <code>my_project.serge</code>) for your translation project so that it stores local repository files under <code>/var/serge/data/my_project/</code> (see <code>sync &rarr; vcs &rarr; data &rarr; local_path</code> parameter)</li>
    <li>Run <code>serge pull --initialize my_project.serge</code> the first time to do the initial checkout; check that <code>/var/serge/data/my_project/</code> folder contains proper files</li>
    <li>To test if you have proper write permissions, alter or add some file in the local repository and run <code>serge push my_project.serge --message="test"</code>; check that your commit went through to the remote server</li>
</ol>

<p>Later you will run <code>serge sync</code> continuously against this configuration file, which will perform the two-way sync between Serge and Subversion among other synchronization/localization steps. See <a href="/docs/localization-cycle/">Localization Cycle</a> for more information.</p>

<h2>Usage</h2>

<figure>
    <figcaption>example-project.serge</figcaption>
    <script language="text/x-config-neat">
sync
{
    vcs
    {
        plugin                   svn

        data
        {
            # (STRING) Absolute path to local folder where local
            # checkout will be stored.
            local_path           /var/serge/data/my_project

            # (STRING) Path to a single remote repository
            # to sync with local `data_dir` folder
            remote_path          https://l10n@svn.example.com/myrepo
            # --- OR ---
            # (MAP) A key-value list of local subfolders to create and
            # their corresponding remote repositories (if the localizable
            # data for the single localization project is located
            # in several per-component or per-library repositories)
            remote_path
            {
                # one can specify branch name after the '#'.
                # below, the `v5` branch us used
                main             https://l10n@svn.example.com/myapp#v5
                # if no branch is specified, `master` is used by default
                widget           https://l10n@svn.example.com/mywidget
            }

            # (BOOLEAN) [OPTIONAL] should the newly generated
            # files be added to the remote repository automatically?
            # (YES or NO, defaults to NO)
            add_unversioned      NO

            # (STRING) [OPTIONAL] Commit message
            # Default: 'Automatic commit of updated project files'
            commit_message       Automatic commit of updated project files

            # (STRING) username to pull and push on behalf of
            user                 l10n

            # (STRING) password for the given user
            password             mY_pA$$w0,rD!
        }
    }

    # other sync parameters
    # ...
}
</script>
</figure>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-footer.php') ?>

