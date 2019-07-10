<?php
    $section = 'vcs-plugins';
    $subpage = 'ref-plugin-git';
    $title = 'Git Synchronization Plugin';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');

    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/version-selector.php');
?>

<h1><?php echo htmlspecialchars($title) ?></h1>

<p>Plugin source location: <code>&lt;serge_root&gt;/lib/Serge/Sync/Plugin/VCS/git.pm</code></p>

<p>This plugin provides integration with <a href="https://git-scm.com/">Git</a>-based source code repositories. On <code><a href="/docs/help/serge-pull/">pull</a></code> sync step, Serge will update its local checkout from your Git server. Respectively, on <code><a href="/docs/help/serge-push/">push</a></code> sync step, Serge will push all the updated files back to the remote repository.</p>

<p>Communication between Serge and Git is performed by the means of running <code>git</code> command-line tool. This means that Git must be installed on the same machine as Serge and have authentication properly configured.</p>

<p>Each configuration file in Serge represents a single translation project, and maps to one or more remote source code repositories (in case of multiple repositories, they all need to be under the same version control and have the same committer configured, since VCS plugin name and committer username are shared within a configuration file). The typical workflow is this:</p>

<ol>
    <li>Create a root directory that will hold all your checkouts, e.g. <code>/var/serge/data/</code></li>
    <li>Create a new Serge configuration file (let's call it <code>my_project.serge</code>) for your translation project so that it stores local repository files under <code>/var/serge/data/my_project/</code> (see <code>sync &rarr; vcs &rarr; data &rarr; local_path</code> parameter)</li>
    <li>Run <code>serge pull --initialize my_project.serge</code> the first time to do the initial checkout; check that <code>/var/serge/data/my_project/</code> folder contains proper files</li>
    <li>To test if you have proper write permissions, alter or add some file in the local repository and run <code>serge push my_project.serge --message="test"</code>; check that your commit went through to the remote server</li>
</ol>

<p>Later you will run <code>serge sync</code> continuously against this configuration file, which will perform the two-way sync between Serge and Git among other synchronization/localization steps. See <a href="/docs/localization-cycle/">Localization Cycle</a> for more information.</p>

<h2>Usage</h2>

<figure>
    <figcaption>example-project.serge</figcaption>
    <script language="text/x-config-neat">
sync
{
    vcs
    {
        plugin                   git

        data
        {
            # (STRING) Absolute path to local folder where local
            # checkout will be stored.
            local_path           /var/serge/data/my_project

            # (STRING) Path to a single remote repository
            # to sync with local `data_dir` folder
            remote_path          ssh://l10n@git.example.com/myrepo
            # --- OR ---
            # (MAP) A key-value list of local subfolders to create and
            # their corresponding remote repositories (if the localizable
            # data for the single localization project is located
            # in several per-component or per-library repositories)
            remote_path
            {
                # one can specify branch name after the '#'.
                # below, the `v5` branch us used
                main             ssh://l10n@git.example.com/myapp#v5
                # if no branch is specified, `master` is used by default
                widget           ssh://l10n@git.example.com/mywidget
            }

            # (BOOLEAN) [OPTIONAL] should the newly generated
            # files be added to the remote repository automatically?
            # (YES or NO, defaults to NO)
            add_unversioned      NO

            # (STRING) [OPTIONAL] additional parameters to be used
            # in `git clone` command at project initialization
            # (when `serge pull --initialize` is run). An example below
            # tells cloning to be shallow (which can speed up cloning
            # projects with extensive history)
            clone_params         --depth 1 --no-tags

            # (STRING) [OPTIONAL] Commit message
            # Default: 'Automatic commit of updated project files'
            commit_message       Automatic commit of updated project files

            # (STRING) public committer name
            name                 L10N Robot

            # (STRING) commiter's email address
            email                l10n-robot@example.com
        }
    }

    # other sync parameters
    # ...
}
</script>
</figure>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-footer.php') ?>

