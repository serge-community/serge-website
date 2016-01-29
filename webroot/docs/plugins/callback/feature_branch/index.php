<?php
    $section = 'callback-plugins';
    $subpage = 'ref-plugin-feature_branch';
    $title = 'Plugin to Extract Only Strings Missing in the Master Job';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');
?>

<h1><?php echo htmlspecialchars($title) ?></h1>

<p>Plugin source location: <code>&lt;serge_root&gt;/lib/Serge/Engine/Plugin/feature_branch.pm</code></p>

<p>Plugin always attaches itself to the following callback phases:</p>
<ul>
    <li><code><a href="/docs/dev/callbacks/#before_job">before_job</a></code></li>
    <li><code><a href="/docs/dev/callbacks/#can_extract">can_extract</a></code></li>
    <li><code><a href="/docs/dev/callbacks/#get_translation_pre">get_translation_pre</a></code></li>
    <li><code><a href="/docs/dev/callbacks/#after_job">after_job</a></code></li>
</ul>

<p>This plugin allows you localize multiple versions (branches) of the same resource files without having to expose duplicate strings for translation. Consider the following example: you have a main development branch (let's call it <code>master</code>) where you have resources to localize. In addition to that, you have multiple feature branches, each having a few new or changed translatable strings as compared to master. A naive approach would be to create multiple translation projects, one per branch. But each project can contain thousands of strings, and it's not practical to keep them all in the database and expose them for translation just for the sake of a few new strings that differ from master, especially if the lifespan of a feature branch is short.</p>

<p><code>feature_branch</code> plugin attemts to simplify working with multiple branches at once by preventing the strings that are already there in the master branch to be extracted for translation from feature branches. For all matching strings in feature branches, it reuses translations from the master branch, so that feature branch resources can still be fully localized for QA purposes.</p>

<p>The plugin must be referenced in both master and feature branch localization jobs</p>

<h2>Usage</h2>

<figure>
    <figcaption>example-project.serge</figcaption>
    <script language="text/x-config-neat">
sync
{
    vcs
    {
        plugin                      git

        data
        {
            local_path              /var/data/myproj

            remote_path
            {
                master              ssh://git.example.com/myapp
                feature1            ssh://git.example.com/myapp#feature1
                # other feature branches
                # ...
            }
        }
    }

    # other sync parameters
    # ...
}

jobs
{
    :master
    {
        id                          job.master

        source_dir                  /var/data/myproj/master/en
        output_file_path            /var/data/myproj/master/%LANG%/%FILE%

        # other job parameters
        # ...

        callback_plugins
        {
            :feature_branch
            {
                plugin              feature_branch

                data
                {
                    /*
                    (STRING) ID of the job which should be
                    considered a `master` one.
                    */
                    master_job      job.master
                }
            }
        }
    }

    :feature1
    {
        # inherit all settings from master job above
        @inherit .#jobs/:master

        # override job id (it must be unique)
        job                         job.feature1

        # since we are working on the same resource files across
        # multiple branches,  we must disambiguate file paths
        # by specifying a prefix
        source_path_prefix          features/feature1/

        # override source and output paths to work
        # with 'feature1' directory
        source_dir                  /var/data/myproj/feature1/en
        output_file_path            /var/data/myproj/feature1/%LANG%/%FILE%
    }

    # other feature branch jobs
    # ...
}
</script>
</figure>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-footer.php') ?>

