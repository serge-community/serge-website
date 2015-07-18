<?php
    $title = 'Documentation';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/help-topics.php'); # to list topics below
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');
?>

<h1>What Is Serge?</h1>

<p>At its core, Serge is a <a href="/docs/command-line-interface/">command-line tool</a> that can be either run manually on a developer's computer, or automatically (e.g. as a cron job) <a href="/docs/localization-server/">on a server</a>, to achieve <a href="/docs/continuous-localization/">continuous localization integration</a>. After you have it <a href="/download/">downloaded and installed</a>, you can simply run it by saying `<code>serge</code>` in the command line, which will give you a <a href="/docs/help/serge/">quick help</a> and a <a href="/docs/command-line-interface/#available-commands">list of available commands</a>.</p>

<p>All localization-related settings need to be described in <a href="/docs/configuration-files/">configuration files</a>. When run against a configuration file, Serge will perform one <a href="/docs/localization-cycle/">localization cycle</a>, bring localized resources in sync with their source, generate new ones, and apply all known translations that come from .po files. It will handle synchronization with your <a href="/docs/version-control/">version control system</a>, automatically pulling and pushing changes, and will also synchronize with an external <a href="/docs/translation-service/">translation service</a>.</p>

<p>Serge has a <a href="/docs/modular-architecture/">modular architecture</a> and supports many <a href="/docs/file-formats/">file formats</a> out of the box.</p>

<h1>Why Is It Called So?</h1>

<p>&lsquo;<strong>SERGE</strong>&rsquo; stands for &lsquo;<strong>S</strong>tring <strong>E</strong>xtraction and <strong>R</strong>esource <strong>G</strong>eneration <strong>E</strong>ngine&rsquo;.</p>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-footer.php') ?>
