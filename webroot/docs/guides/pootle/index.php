<?php
    $subpage = 'guides-pootle';
    $title = 'Serge + Pootle';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');
?>

<h1>Serge + Pootle</h1>

<p class="notice"><a href="http://pootle.translatehouse.org/">Pootle</a> is a free open-source web-based translation server. Pootle works with Serge beautifully, and is a recommended translation front-end if you want to build a truly seamless continuous localization process. Pootle supports working with both community and paid translators.</p>

<h1>Configuring Serge to work with Pootle</h1>

<p>Here are the main steps that you will need to make Pootle work together with Pootle.</p>

<h2>Initial Pootle Configuration</h2>

<p>It is recommended that you install both Serge and Pootle on the same dedicated localization server which will be accessible by your translators. Once you install Pootle (please follow its own installation instructions), you will need to specify the root directory where Pootle expects all translation files to be stored, in its configuration file (typical installations will use <code>~/.pootle/pootle.conf</code>):</p>

<script language="text/x-config-neat">
POOTLE_TRANSLATION_DIRECTORY = '/var/serge/po'
</script>

<p>Below is an example of the file structure that Pootle would expect under <code>/var/serge/po</code> directory:</p>

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

<p>Pootle can have multiple translation projects, each having its own unique identifier, which also serves as a folder name. In our example above, it's <code>project1</code> and <code>project2</code>. Inside each project, Pootle expects a set of directories named after target translation locales, e.g. <code>de</code>, <code>ja</code>, <code>pt_BR</code> and so on. Inside each locale directory, there can be a number of translation files (Serge uses .po file format for such files).</p>

<h2>Configuring Serge Jobs</h2>

<p>In each of your Serge jobs, you need to configure <code>ts_file_path</code> parameter so that it generates .po file at a proper location (here and below we will assume we're working with <code>project1</code> project and our configuration file is conveniently named <code>project1.serge</code>):</p>

<figure>
    <figcaption>Part of project1.serge</figcaption>
    <script language="text/x-config-neat">
ts_file_path            /var/serge/po/project1/%LOCALE%/%FILE%.po
</script>
</figure>

<p>Notice that we use <code>%LOCALE%</code> macro here to generate locale-specific folders under <code>/var/serge/po/project1/</code> directory. For this macro to generate proper locale names, it is recommended to specify destination languages in their "canonical" form, where language name is a two-char <a href="https://en.wikipedia.org/wiki/List_of_ISO_639-1_codes">ISO 639-1 language code</a> optionally followed by dash and a two-char <a href="https://en.wikipedia.org/wiki/ISO_3166-1">ISO 3166-1 country code</a>. In Serge, it is recommended to use a lowercase version of the language, as macros like <code>%LOCALE%</code> will properly adjust the case:</p>

<figure>
    <figcaption>Part of project1.serge</figcaption>
    <script language="text/x-config-neat">
destination_languages   de ja pt-br
</script>
</figure>

<p>Once you set up the jobs in your configuration file, you can run Serge localization pass once to see if the .po files are generated properly, and the folder and file structure matches the expectation:</p>

<code class="cli">serge localize project1.serge</code>

<h2>Registering a Project in Pootle</h2>

<p>In order to appear in the translation interface, every new project needs to be initially registered in Pootle. You, as a Pootle administrator, need to go to Pootle's Admin interface, select Projects tab, create a new project there and specify the project id, e.g. <code>project1</code>. This will tell Pootle that the project files are located in <code>/var/serge/po/project1/</code> directory. Pootle will scan files in there and publish the project for translation. In addition to specifying the project id, you need to give the project its display name, e.g. "Project 1", and leave default values for other parameters.</p>

<h2>Configuring Serge Synchronization</h2>

<p>For Serge to be able to communicate with Pootle, Serge config must have the following <code>sync</code> &rarr; <code>ts</code> section:</p>

<figure>
    <figcaption>Part of project1.serge</figcaption>
    <script language="text/x-config-neat">
sync
{
    ts
    {
        plugin                  pootle

        data
        {
            manage_py_path      /path/to/pootle/manage.py
            project_id          project1
        }
    }
}
</script>
</figure>

<p>Here we specify that we want to use <code>pootle</code> translation service plugin, and provide two parameters:</p>
<ol>
    <li><code>manage_py_path</code> is the path to <code>manage.py</code> script that comes with Pootle and serves as a command-line API for the local Pootle instance;</li>
    <li><code>project_id</code> is the same project identifier as the one we used in previous step.</li>
</ol>

<p class="notice">Note that if you install Pootle using <code>pip install Pootle</code>, the <code>manage.py</code> script might actually be named <code>pootle</code>, so refer to Pootle documentation. Also, if you install Pootle into a virtual Python environment, you may need to write a simple wrapper script that selects this environment and then calls <code>manage.py</code> (or <code>pootle</code>) with all command-line parameters, and use the path to this wrapper script as a value of <code>manage_py_path</code>. This will allow Serge to run the script from within a proper environment.</p>

<p>Once this is configured, you can run the following commands to push changed .po files to Pootle and pull translations back from Pootle into .po files:</p>

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
        plugin                  pootle

        data
        {
            manage_py_path      /path/to/pootle/manage.py
            project_id          my_project
        }
    }

    # other sync parameters
    # ...
}

jobs
{
    # job 1
    {
        ts_file_path            /var/serge/po/project1/%LOCALE%/%FILE%.po
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
