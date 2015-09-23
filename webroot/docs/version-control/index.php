<?php
    $subpage = 'version-control';
    $title = 'Version Control';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');
?>

<h1>Version Control</h1>

<p>A part of Serge's <a href="/docs/localization-cycle/">localization cycle</a> is a two-way synchronization with a version control system (VCS). Serge automatically pulls changes from VCS before processing source files, and pushes localized files back to VCS.</p>

<p>Serge currently supports the following VCS:</p>

<ul>
    <li>SVN</li>
    <li>Git</li>
    <li>Gerrit (Git-based code review system)</li>
    <li>Mercurial</li>
</ul>

<p>Each system is supported by the means of <a href="/docs/plugins/vcs/<?php echo $vcs_plugins[0] ?>">VCS plugins</a>, and you can write your own VCS integration plugins. You can use existing plugins code (located in <code>&lt;serge_root&gt;/lib/Serge/Sync/Plugin/VCS</code> folder) as inspiration.</p>

<p>VCS are defined on a per-<a href="/docs/configuration-files/">configuration file</a> basis. So you can have some translation projects working with Git, and others with SVN, for example. Also, each translation project can define one or more repositories to pull data from.</p>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-footer.php') ?>
