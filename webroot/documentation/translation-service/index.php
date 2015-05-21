<?php
    $subpage = 'translation-service';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');
?>

<h1>Translation Service</h1>

<p>...</p>

<?php /*

<h1 id="translation-services">Integration with External Translation Services</h1>

<p><code><a href="/documentation/help/serge-pull-po/">serge pull-po</a></code> and <code><a href="/documentation/help/serge-push-po/">serge push-po</a></code> commands are used to synchronize the generated .po files with the external translation service. Currently Serge has been tailored to work primarily with <a href="https://github.com/translate/pootle/">Pootle server</a> by the means of its command-line API (shell script), but you can create plugins that will do any synchronization tasks specific to your environment. Please use Pootle plugin as an example (see <code>&lt;serge_root&gt;/lib/Serge/Sync/Plugin/TranslationService/pootle.pm</code>).</p>

<h2>How Does This Work?</h2>

<p>When you run <code>serge pull-po &lt;config&gt;</code> and <code>serge push-po &lt;config&gt;</code>, serge will first determine the synchronization settings, as follows:</p>

<ol>
    <li>Serge gets the path to the local .po synchronization script from <code>sync &rarr; pootle_manage_py_path</code> parameter in the configuration file. Though the parameter name implies that it expects a path to <code>manage.py</code> script that comes with Pootle, you can specify a path to any arbitrary binary or script with executable permissions here (let's call it <code><em>the_script</em></code>).</li>

    <li>Serge gets the <code>sync &rarr; external_project_id</code> parameter that specifies the project id (in case of Pootle it is a unique subfolder containing the .po files). If you're integrating Serge with your own translation environment, this parameter can hold any arbitrary string (id or file path) that helps you identify the subset of .po files to synchronize (let's call it <code><em>the_project</em></code>).</li>
</ol>

<h2>Pulling Changes From External Translation Services</h2>

<p>On <code>pull-po</code> command, Serge will execute the following shell command:

<code class="block"><em>the_script</em> sync_stores <nobr>--project=<em>the_project</em></nobr> <nobr>[--language=<em>xx</em>]</nobr> <nobr>[--overwrite]</nobr></code>

<em>the_script</em>, knowing the root folder with the .po files and the passed subfolder name, is expected to pull .po files from the external system.</p>

<p>For optimization purposes, one or more <code>--language=<em>xx</em></code> parameters may be provided. The script is expected to deal with .po files for these target languages only.</p>

<p>The <code>--overwrite</code> parameter will be provided if Serge is itself run with <code>--force</code> option. The script is expected to disable all optimizations and process all .po files.</p>

<h2>Pushing Changes To External Translation Services</h2>

<p>On <code>push-po</code>, Serge will execute this:

<code class="block"><em>the_script</em> update_stores --project=<em>the_project</em> <nobr>[--language=<em>xx</em>]</nobr> <nobr>[--force]</nobr></code>

<em>the_script</em> is expected to push the changes in local .po files to the external system.</p>

<p>For optimization purposes, one or more <code>--language=<em>xx</em></code> parameters may be provided. The script is expected to deal with .po files for these target languages only.</p>

<p>The <code>--force</code> parameter will be provided if Serge is itself run with <code>--force</code> option. The script is expected to disable all optimizations and process all .po files.</p>

*/ ?>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-footer.php') ?>
