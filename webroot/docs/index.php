<?php
    $title = 'Documentation';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/help-topics.php'); # to list topics below
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');
?>

<h1>What Is Serge?</h1>

<p>At its core, Serge is a <a href="/docs/command-line-interface/">command-line tool</a> that can be either run manually on a developer's computer, or automatically (e.g. as a cron job) <a href="/docs/localization-server/">on a server</a>, to achieve <a href="/docs/continuous-localization/">continuous localization integration</a>. After you have it <a href="/download/">downloaded and installed</a>, you can simply run it by saying `<code>serge</code>` in the command line, which will give you a <a href="/docs/help/serge/">quick help</a> and a <a href="/docs/command-line-interface/#available-commands">list of available commands</a>.</p>

<p>All localization-related settings need to be described in <a href="/docs/configuration-files/">configuration files</a>. When run against a configuration file, Serge will perform one <a href="/docs/localization-cycle/">localization cycle</a>, bring localized resources in sync with their source, generate new ones, and apply all known translations that came from translation files. It will handle synchronization with your <a href="/docs/version-control/">version control system</a>, automatically pulling and pushing changes, and will also synchronize with an external <a href="/docs/translation-service/">translation service</a>.</p>

<p>Serge has a <a href="/docs/modular-architecture/">modular architecture</a> and supports many <a href="/docs/file-formats/">file formats</a> out of the box.</p>

<p>Serge is not only about replacing source text with translated one: it is a powerful text processing pipeline that ensures that the final result of its work can be used in your product without any further post-processing.</p>

<h1>Why is it called so?</h1>

<p>&lsquo;<strong>SERGE</strong>&rsquo; stands for &lsquo;<strong>S</strong>tring <strong>E</strong>xtraction and <strong>R</strong>esource <strong>G</strong>eneration <strong>E</strong>ngine&rsquo;.</p>

<h1>What problem does it solve?</h1>

<p>When you decide to automate your localization process, you usually look at the automation APIs provided by a Translation Managemet System (TMS) of your choice, and start writing and maintaining your own integration between that TMS and your version control system (VCS). This <em>last-mile</em> integration is what Serge does for you, providing the following benefits:</p>

<ul>
    <li><strong>Ease of maintenance.</strong> Instead of writing custom scripts, you are writing configuration files (once) and rarely have to touch them again.</li>
    <li><strong>No vendor lock-in.</strong> Having Serge between your source code and an external TMS system allows you to switch to another TMS anytime, keeping all your existing automation in place. Serge can readily supports several <a href="/docs/third-party/translation-services/">third-party TMS</a>.</li>
    <li><strong>Security.</strong> You will never have to give external TMS access to your code repository, and third parties will not see your original source files. Serge creates intermediate translation files that contain only the translatable content. There's no way for an external vendor to break your resource files, and you never have to deal with any merge conflicts.</li>
    <li><strong>Flexibility.</strong> You can easily deal with logical projects spawning multiple repositories and file formats.</li>
    <li><strong>Advanced localization workflows.</strong> With Serge, many things that are usually hard to implement, are possible: multi-step localization with intermediate languages, simultaneous localization of multiple code branches, conditional file processing based on their contents, and so on.</li>
    <li><strong>Extensibility.</strong> With modular architecture, you're not limited to what one TMS has to offer; you can create custom parsers, synchronization plugins for other version control systems and TMS, while keeping the majority of your localization automation intact.</li>
</ul>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-footer.php') ?>
