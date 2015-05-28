<?php
    $subpage = 'version-control';
    $title = 'Version Control';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');
?>

<h1>Version Control</h1>

<p>A part of Serge's <a href="/docs/localization-cycle/">localization+sync cycle</a> is a two-way synchronization with a version control system (VCS). Specifically, two steps, <code><a href="/docs/help/serge-pull/">pull</a></code> and <code><a href="/docs/help/serge-push/">push</a></code>, are used to get source files from VCS and place localized files back to VCS.</p>

<p>Serge currently supports the following VCS:</p>

<ul>
    <li>SVN</li>
    <li>Git</li>
    <li>Gerrit (Git-based code review system)</li>
</ul>

<p>Each system is supported by its own &lsquo;VCS plugin&rsquo;, and you can write your own VCS integration plugins. You can use existing plugin code (located in <code>&lt;serge_root&gt;/lib/Serge/Sync/Plugin/VCS</code> folder) as an inspiration.</p>

<p>Serge comes with the ready-to use plugin for <a href="http://pootle.translatehouse.org/">Pootle</a> — a free open-source online translation server software (which we use <a href="https://translate.evernote.com/">at Evernote</a> with little modifications). You can use plugin's code (located in <code>&lt;serge_root&gt;/lib/Serge/Sync/Plugin/TranslationService/pootle.pm</code>) as a reference implementation for your own plugins.</p>

<p>VCS are defined on a per-<a href="/docs/configuration-files/">configuration file</a> basis. So you can have some translation projects working with Git, and others with SVN, for example. Also, each translation project can define one or more repositories to pull data from.</p>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-footer.php') ?>
