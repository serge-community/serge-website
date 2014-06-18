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

<p>Configuration files provide all the required information: how to interact with the version control system and external translation service, where to store the local checkout and .po files, which database to use, which files to process, which parser and additional plugins to use, how to name localized versions of files, and so on.</p>

<p>TBD</p>

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

<h1 id="translation-services">Integration with External Translation Services</h1>

<p>TBD</p>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/footer.php') ?>
