<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . '/../inc/help-topics.php');

	$page = 'documentation';
	include($_SERVER['DOCUMENT_ROOT'] . '/../inc/header.php');
?>

<h1>Getting Started</h1>

<p>At its core, Serge is a <a href="/documentation/help/serge/">command-line tool</a> that can be either run manually and on demand on a developers' computer, or be run continuously on a standalone server. After you have it <a href="/download/">downloaded and installed</a>, you can simply run it by saying `<code>serge</code>` in the command line, which will give you a quick help and a list of available commands. The general command syntax is:</p>

<code class="block"><a href="/documentation/help/serge/">serge</a> <em><a href="#commands">&lt;command&gt;</a></em> <em><a href="#config-files">&lt;configuration-file-or-directory&gt;</a></em></code>

<p>When running any Serge command which expects a configuration file, you can actually provide muiltiple configuration files, or even specify the directory where configuration files with .serge extension are located, and Serge will process all these files.</p>

<h1 id="config-files">Configuration Files</h1>

<p>Configuration files provide all the required information: how to interact with the version control system and <a href="#translation-services">external translation service</a>, where to store the local checkout and .po files, which database to use, which files to process, which parser and additional plugins to use, how to name localized versions of files, and so on.</p>

<p>See the <a href="config/">configuration file reference</a>.</p>

<h1 id="commands">Serge Commands</h1>

<p>Two core Serge commands are <code><a href="/documentation/help/serge-sync/">sync</a></code> and <code><a href="/documentation/help/serge-localize/">localize</a></code>:</p>

<p><img src="/media/sync_steps.png" width="940" height="297" /></p>

<p><code>serge sync</code> will do a full localization+sync cycle against each configuration file:</p>

<ol>
    <li>Pull source files from the remote development repository (<code><a href="/documentation/help/serge-pull/">serge pull</a></code>)</li>
    <li>Pull .po files from <a href="#translation-services">external translation service</a> (<code><a href="/documentation/help/serge-pull-po/">serge pull-po</a></code>)</li>
    <li>Perform a localization cycle (<code><a href="/documentation/help/serge-localize/">serge localize</a></code>):
        <ol>
            <li>Parse specific localizable resource files from the local checkout, extract strings from there and put them into its own Translation Memory database (<em>step 1</em>)</li>
            <li>Parse previously generated .po files and put new translations into TM database (<em>step 2</em>)</li>
            <li>Generate/update .po files that can be further used in an offline or online translation environment (<em>step 3</em>)</li>
            <li>Generate localized copies of source files based on existing translations (<em>step 4</em>)</li>
        </ol>
    </li>
    <li>Push .po files to an <a href="#translation-services">external translation service</a> (<code><a href="/documentation/help/serge-push-po/">serge push-po</a></code>)</li>
    <li>Push generated localized files back to the remote repository (<code><a href="/documentation/help/serge-push/">serge push</a></code>)</li>
</ol>

<p><code>serge localize</code> will just perform its four steps and do no synchronization. While <code>serge sync</code> makes sense in a continuous localization environment, <code>serge localize</code> will likely be used on a local development machine for on-demand resource localization and initial configuration. You can also specify multiple sync sub-commands, for example: `<code>serge pull localize push <em>&lt;configuration-file&gt;</em></code>`.</p>

<p>The full list of available Serge commands:</p>

<ul>
    <?php foreach ($help_topics as $topic): ?>
    <li><a href="/documentation/help/<?php echo $topic ?>/"><?php echo $topic ?></a></li>
    <?php endforeach ?>
</ul>

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

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/footer.php') ?>
