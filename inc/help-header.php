<?php
    require_once('help-topics.php');

    $page = 'documentation';
    $subselection = 1;
    include('header.php');

    function helpMenuSel($help_page) {
        global $command;
        return ($command == $help_page) ? ' class="selected"' : '';
    }

?>

<div class="pod">
    <div class="menu">
        <ul>
            <?php foreach ($help_topics as $topic): ?>
            <li<?php echo helpMenuSel($topic) ?>><a href="../<?php echo $topic ?>/"><?php echo $topic ?></a></li>
            <?php endforeach ?>
        </ul>
    </div>

    <div class="body">
        <h1 class="top command"><code><?php echo $command ?></code></h1>

