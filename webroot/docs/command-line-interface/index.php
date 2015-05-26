<?php
    $subpage = 'command-line-interface';
    $title = 'Command-Line Interface';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');
?>

<h1>Command-Line Interface</h1>

<p>The general command syntax is:</p>

<code class="cli">serge <em><a href="#available-commands">&lt;command&gt;</a></em> <em><a href="/docs/configuration-files/">&lt;configuration-file-or-directory&gt;</a></em></code>

<p>When running any Serge command which expects a configuration file, you can actually provide muiltiple configuration files, or even specify the directory where configuration files with .serge extension are located, and Serge will process all these files.</p>

<p>Example (run 'push' command on 'my-ios-client.serge' and 'my-mac-client.serge' configuration files):</p>
<code class="cli">serge push my-ios-client.serge my-mac-client.serge</code>

<p>Example (run 'sync' command on all files with '.serge' extension in the current directory):</p>
<code class="cli">serge sync .</code>

<p>Sync-related commands can be specified one after another. In the example below we run 'pull', and then 'localize' command on 'my-ios-client.serge' configuration file:</p>
<code class="cli">serge pull localize my-ios-client.serge</code>


<h1 id="available-commands">List of Available Serge Commands</h1>

<ul>
    <?php
        include_once($_SERVER['DOCUMENT_ROOT'] . '/../inc/help-topics.php');
        foreach ($help_topics as $topic):
    ?>
    <li><a href="/docs/help/<?php echo $topic ?>/"><?php echo $topic ?></a></li>
    <?php
        endforeach
    ?>
</ul>



<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-footer.php') ?>
