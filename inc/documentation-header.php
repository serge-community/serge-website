<?php
    $page = 'documentation';
    if (isset($subpage)) {
        $subselection = 1;
    }
    include('header.php');

    function _sel($id) {
        global $subpage;
        return ($id == $subpage) ? ' class="selected"' : '';
    }

    function _item($id, $url, $title) {
        echo '<li'._sel($id).'><a href="'.$url.'">'.htmlspecialchars($title).'</a></li>';
    }

?>

<div class="pod">
    <div class="menu">
        <ul>
            <?php _item("",          "/documentation/",                       "Getting Started") ?>
            <?php _item("config",    "/documentation/config/",                "Configuration Files") ?>
            <?php _item("callbacks", "/documentation/development/callbacks/", "Callbacks") ?>
        </ul>
    </div>

    <div class="body">

