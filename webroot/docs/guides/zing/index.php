<?php
    $subpage = 'guides-zing';
    $title = 'Serge + Zing';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');
?>

<h1>Serge + Zing</h1>

<p><a href="https://evernote.github.io/zing/">Zing</a> is Evernote's free open-source web-based translation server. Zing was designed to seamlessly work with Serge and support all of its features, and is our recommended translation front-end. Zing supports working with both community and paid translators.</p>

<h1>Configuring Serge to work with Zing</h1>

<p>Here are the main steps that you will need to make Serge work together with Zing.</p>

<h2>Initial Zing Configuration</h2>

<p>It is recommended that you install both Serge and Zing on the same dedicated localization server which will be accessible by your translators. Once you install Zing (please follow its own installation instructions), you will need to specify the root directory where Zing expects all translation files to be stored, in its configuration file (typical installations will use <code>~/.zing/zing.conf</code>):</p>

<script language="text/x-config-neat">
ZING_TRANSLATION_DIRECTORY = '/var/serge/data/ts'
</script>

<p class="notice">Why <code>/var/serge/data/ts</code>? Technically, you can set up any directory to exchange files between Serge and Zing. In this guide, we try to follow the suggested canonical directory structure for your Serge installation. See <a href="/docs/organizing-your-data/">Organizing your data</a>.</p>

<p>Below is an example of the file structure that Zing would expect under <code>/var/serge/data/ts</code> directory:</p>

<script language="text/x-config-neat">
/project1
    /de
        /main.json.po
        /module.json.po
    /ja
        /main.json.po
        /module.json.po
    /pt_BR
        /main.json.po
        /module.json.po
    ...
/project2
    /de
        /resources.xml.po
    /ja
        /resources.xml.po
    /pt_BR
        /resources.xml.po
    ...
...
</script>

<p>Zing can have multiple translation projects, each having its own unique identifier, which also serves as a folder name. In our example above, it's <code>project1</code> and <code>project2</code>. Inside each project, Zing expects a set of directories named after target translation locales, e.g. <code>de</code>, <code>ja</code>, <code>pt_BR</code> and so on. Inside each locale directory, there can be a number of translation files in an arbitrary folder structure (Serge uses .po file format for such files).</p>

<h2>Configuring Serge Jobs</h2>

<p>In each of your Serge jobs, you need to configure <code>ts_file_path</code> parameter so that it generates .po file at a proper location (here and below we will assume we're working with <code>project1</code> project and our configuration file is conveniently named <code>project1.serge</code>):</p>

<figure>
    <figcaption>Part of project1.serge</figcaption>
    <script language="text/x-config-neat">
ts_file_path            /var/serge/data/ts/project1/%LOCALE%/%FILE%.po
</script>
</figure>

<p>Notice that we use <code>%LOCALE%</code> macro here to generate locale-specific folders under <code>/var/serge/data/ts/project1/</code> directory. For this macro to generate proper locale names, it is recommended to specify destination languages in their "canonical" form, where language name is a two-char <a href="https://en.wikipedia.org/wiki/List_of_ISO_639-1_codes">ISO 639-1 language code</a> optionally followed by dash and a two-char <a href="https://en.wikipedia.org/wiki/ISO_3166-1">ISO 3166-1 country code</a>. In Serge, it is recommended to use a lowercase version of the language, as macros like <code>%LOCALE%</code> will properly adjust the case:</p>

<figure>
    <figcaption>Part of project1.serge</figcaption>
    <script language="text/x-config-neat">
destination_languages   de ja pt-br
</script>
</figure>

<p>Once you set up the jobs in your configuration file, you can run Serge localization pass once to see if the .po files are generated properly, and the folder and file structure matches the expectation:</p>

<code class="cli">serge localize project1.serge</code>

<h2>Registering a Project in Zing</h2>

<p>In order to appear in the translation interface, every new project needs to be initially registered in Zing. You, as a Zing administrator, need to go to Zing's Admin interface, select Projects tab, create a new project there and specify the project id, e.g. <code>project1</code>. This will tell Zing that the project files are located in <code>/var/serge/data/ts/project1/</code> directory. Zing will scan files in there and publish the project for translation. In addition to specifying the project id, you need to give the project its display name, e.g. "Project 1", and leave default values for other parameters.</p>

<h2>Configuring Serge Synchronization</h2>

<p>For Serge to be able to communicate with Zing, Serge config must have the following <code>sync</code> &rarr; <code>ts</code> section:</p>

<figure>
    <figcaption>Part of project1.serge</figcaption>
    <script language="text/x-config-neat">
sync
{
    ts
    {
        plugin                  zing

        data
        {
            project_id          project1
            executable          /usr/local/bin/zing
        }
    }
}
</script>
</figure>

<p>Here we specify that we want to use <code>Zing</code> translation service plugin, and provide two parameters:</p>
<ol>
    <li><code>manage_py_path</code> is the path to <code>manage.py</code> script that comes with Zing and serves as a command-line API for the local Zing instance;</li>
    <li><code>project_id</code> is the same project identifier as the one we used in previous step.</li>
</ol>

<p class="notice">Note that if you install Zing into a virtual Python environment, you may need to write a simple wrapper script that selects this environment and then calls the original <code>zing</code> executable with all command-line parameters, and use the path to this wrapper script as a value of <code>executable</code> config parameter. This will allow Serge to run the script from within a proper environment.</p>

<p>Once this is configured, you can run the following commands to push changed .po files to Zing and pull translations back from Zing into .po files:</p>

<code class="cli">serge push-ts project1.serge
serge pull-ts project1.serge</code>


<h2>Putting It All Together</h2>

<p>Here's the combined structure of the Serge configuration file that you can use as a template:</p>

<figure>
    <figcaption>project1.serge</figcaption>
    <script language="text/x-config-neat">
sync
{
    ts
    {
        plugin                  zing

        data
        {
            project_id          my_project
            executable          /usr/local/bin/zing
        }
    }

    # other sync parameters
    # ...
}

jobs
{
    # job 1
    {
        ts_file_path            /var/serge/data/ts/project1/%LOCALE%/%FILE%.po
        destination_languages   de ja pt-br

        # other job parameters
        # ...
    }

    # other jobs
    # ...
}
</script>
</figure>


<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-footer.php') ?>
