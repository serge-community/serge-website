<?php
    $title = 'Documentation';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/help-topics.php'); # to list topics below
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');
?>

<h1>Getting Started</h1>

<p>At its core, Serge is a <a href="/docs/command-line-interface/">command-line tool</a> that can be either run manually on a developer's computer, or automatically (e.g. as a cron job) <a href="/docs/localization-server/">on a server</a>, to achieve <a href="/docs/continuous-localization/">continuous localization integration</a>. After you have it <a href="/download/">downloaded and installed</a>, you can simply run it by saying `<code>serge</code>` in the command line, which will give you a <a href="/docs/help/serge/">quick help</a> and a <a href="/docs/command-line-interface/#available-commands">list of available commands</a>.</p>

<p>All localization-related settings need to be described in <a href="/docs/configuration-files/">configuration files</a>. When run against a configuration file, Serge will perform one <a href="/docs/localization-cycle/">localization cycle</a>, bring localized resources in sync with their source, generate new ones, and apply all known translations that came from translation files. It will handle synchronization with your <a href="/docs/version-control/">version control system</a>, automatically pulling and pushing changes, and will also synchronize with an external <a href="/docs/translation-service/">translation service</a>.</p>

<p>Serge has a <a href="/docs/modular-architecture/">modular architecture</a> and supports many <a href="/docs/file-formats/">file formats</a> out of the box.</p>

<p>Serge is not only about replacing source text with translated one: it is a powerful text processing pipeline that ensures that the final result of its work can be used in your product without any further post-processing.</p>

<h1>Watch the Video</h1>

<p>This is a recording of the presentation we did at the <a href="http://www.imug.org/">IMUG</a> meetup. It gives an overview of Serge, its key features, and gives insights of how you can use it in your team:</p>

<p><iframe width="724" height="543" src="https://www.youtube.com/embed/bC3wECRgLog" frameborder="0" allowfullscreen="allowfullscreen"></iframe></p>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-footer.php') ?>
