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
        <h3>Basic Concepts</h3>
        <ul>
            <?php _item("",                             "/documentation/",                                "Getting Started") ?>
            <?php _item("continuous-localization",      "/documentation/continuous-localization/",        "Continuous Localization") ?>
            <?php _item("localization-cycle",           "/documentation/localization-cycle/",             "Localization Cycle") ?>
            <?php _item("version-control",              "/documentation/version-control/",                "Version Control") ?>
            <?php _item("translation-service",          "/documentation/translation-service/",            "Translation Service") ?>
            <?php _item("command-line-interface",       "/documentation/command-line-interface/",         "Command-line Interface") ?>
            <?php _item("configuration-files",          "/documentation/configuration-files/",            "Configuration Files") ?>
        </ul>
        <h3>Reference</h3>
        <ul>
            <?php _item("help",                         "/documentation/help/",                           "Command-line Help") ?>
            <?php _item("ref-config",                   "/documentation/configuration-files/reference/",  "Configuration File Format") ?>
            <?php //_item("ref-plugins",                  "/documentation/plugins/",                        "Parser Plugins") ?>
            <?php //_item("ref-plugins",                  "/documentation/plugins/",                        "Control Plugins") ?>
            <?php //_item("ref-plugins",                  "/documentation/plugins/",                        "Filter Plugins") ?>
        </ul>
        <?php /*
        <h3>Extending Serge</h3>
        <ul>
            <?php //_item("dev-plugins",                  "/documentation/development/plugins/",            "Plugins") ?>
            <?php //_item("dev-callbacks",                "/documentation/development/callbacks/",          "Callbacks") ?>
        </ul>
        */ ?>
    </div>

    <div class="body">

