<?php
    $subpage = 'organizing-your-data';
    $title = 'Organizing Your Data';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');
?>

<h1>Organizing Your Data</h1>

<p>Serge is expected to run against configuration files, data directories and a database (typically an SQLite database), located on your <a href="/docs/localization-server/">localization server</a>. Though it's totally up to you how to organize your data, we will follow a consistent structure in various parts of Serge documentation, that we'll call <em>canonical</em>. Here it is:</p>

<figure>
    <figcaption>Canonical directory structure</figcaption>
    <code class="block">/var
    /serge
        /data
            /db
            /vcs
            /ts
            /configs
</code>
</figure>

<p>Serge doesn't create any top-level directory structure for you, so you will need to create it by yourself.</p>

<dl>

    <dt><code>/var/serge/data</code></dt>

    <dd>
        <p>This is the root directory for all Serge-related data. Having a single directory for all localization-related files will help you keep things clean and tidy, and enforce stricter security.</p>
    </dd>

    <dt><code>/var/serge/data/db</code> (requires read-write access)</dt>

    <dd>
        <p>This directory is used to store Serge database file (which typically is an SQLite database file, e.g. <code>translate.db3</code>). Serge can also work with MySQL, so if you ever need to use MySQL, you won't have this folder.</p>
    </dd>

    <dt><code>/var/serge/data/vcs</code> (requires read-write access)</dt>

    <dd>
        <p>This directory will contain all local source code checkouts (<code>vcs</code> stands for <em>version control system</em>).</p>
    </dd>

    <dt><code>/var/serge/data/ts</code> (requires read-write access)</dt>

    <dd>
        <p>This directory will contain translation interchange files (<code>ts</code> stands for <em>translation system</em>).</p>
    </dd>

    <dt><code>/var/serge/data/configs</code> (typically requires read-only access)</dt>

    <dd>
        <p>This directory will contain your <a href="/docs/configuration-files/">Serge configuration files</a> (files with <code>.serge</code> extension).</p>
    </dd>

</dl>


<h2>Example</h2>

<p>Assume you have two localization projects, one for your iOS application, and another one for Android. We recommend to use the same project-specific names (in this example, <code>ios</code> and <code>android</code>) for configuration files and for subdirectories in both <code>/vcs</code> and <code>/ts</code> subdirectories. This is how your file and folder structure will look like:</p>

<figure>
    <figcaption>Example directory and file structure</figcaption>
    <code class="block">/var
    /serge
        /data
            /db
                translate.db3
            /vcs
                /android
                    ... local checkout for your project ...
                /ios
                    ... local checkout for your project ...
            /ts
                /android
                    ... translation interchange files created by Serge ...
                /ios
                    ... translation interchange files created by Serge ...
            /configs
                android.serge
                ios.serge
</code>
</figure>

<p class="notice">When chosing names for your projects and configs, use lowercase names and no spaces. This will help you avoid obscure problems in the future.</p>

<p>When you run a localization cycle, Serge will take care of creating subdirectories in <code>/vcs</code> and <code>/ts</code> based on paths defined in your configuration files.

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-footer.php') ?>
