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
        /* DEBUG: remove this feature before opening in production! */
        $ok = file_exists($_SERVER['DOCUMENT_ROOT'] . "$url/index.php");
        $a_class = $ok ? '' : 'class="err"';
        /* DEBUG */

        echo '<li'._sel($id).'><a href="'.$url.'"'.$a_class.'>'.htmlspecialchars($title).'</a></li>';
    }

    require_once('help-topics.php');
    require_once('plugins.php');
?>

<div class="pod">
    <div class="menu">
        <h3>Basic Concepts</h3>
        <ul>
            <?php _item("",                             "/docs/",                                "Getting Started") ?>
            <?php _item("continuous-localization",      "/docs/continuous-localization/",        "Continuous Localization") ?>
            <?php _item("localization-cycle",           "/docs/localization-cycle/",             "Localization Cycle") ?>
            <?php _item("version-control",              "/docs/version-control/",                "Version Control") ?>
            <?php _item("translation-service",          "/docs/translation-service/",            "Translation Service") ?>
            <?php _item("command-line-interface",       "/docs/command-line-interface/",         "Command-line Interface") ?>
            <?php _item("configuration-files",          "/docs/configuration-files/",            "Configuration Files") ?>
        </ul>
        <h3>Reference</h3>
        <ul>
            <?php _item("help",                         "/docs/help/",                           "Command-line Help") ?>
            <ul>
                <?php
                    if ($section == 'help') {
                        foreach ($help_topics as $topic) {
                            _item($topic, "/docs/help/$topic/",  $topic);
                        }
                    }
                ?>
            </ul>
            <?php _item("-ref-plugins",                 "/docs/plugins/$parser_plugins[0]",      "Parser Plugins") ?>
            <ul>
                <?php
                    if ($section == 'parser-plugins') {
                        foreach ($parser_plugins as $name) {
                            _item("ref-plugin-$name", "/docs/plugins/$name/",  $name);
                        }
                    }
                ?>
            </ul>
            <?php _item("-ref-plugins",                 "/docs/plugins/$control_plugins[0]",     "Control Plugins") ?>
            <ul>
                <?php
                    if ($section == 'control-plugins') {
                        foreach ($control_plugins as $name) {
                            _item("ref-plugin-$name", "/docs/plugins/$name/",  $name);
                        }
                    }
                ?>
            </ul>
            <?php _item("ref-config",                   "/docs/configuration-files/reference/",  "Configuration File Format") ?>
        </ul>
        <?php /*
        <h3>Extending Serge</h3>
        <ul>
            <?php //_item("dev-plugins",                  "/docs/development/plugins/",            "Plugins") ?>
            <?php //_item("dev-callbacks",                "/docs/development/callbacks/",          "Callbacks") ?>
        </ul>
        */ ?>
    </div>

    <div class="body">

