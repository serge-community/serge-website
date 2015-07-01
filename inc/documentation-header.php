<?php
    $page = 'documentation';
    if (isset($subpage)) {
        $subselection = 1;
    }

    $head = '
        <script src="/media/vendor/codemirror/codemirror.js"></script>
        <script src="/media/vendor/codemirror/runmode.js"></script>

        <script src="/media/configneat/configneat.js"></script>
        <link rel="stylesheet" href="/media/configneat/configneat.css" />

        <script src="/media/vendor/jquery/jquery-2.1.1.min.js"></script>

        <script src="/media/configneat/colorize_config.js"></script>
    ';

    include('header.php');

    function _sel($id) {
        global $subpage;
        return ($id == $subpage) ? ' class="selected"' : '';
    }

    function _item($id, $url, $title, $li_class = '') {
        /* DEBUG: remove this feature before opening in production! */
        $ok = file_exists($_SERVER['DOCUMENT_ROOT'] . "$url/index.php");
        $a_class = $ok ? '' : 'class="err"';
        /* DEBUG */
        $li_class = $li_class != '' ? ' class="'.$li_class.'"' : '';

        echo '<li'._sel($id).$li_class.'><a href="'.$url.'"'.$a_class.'>'.htmlspecialchars($title).'</a></li>';
    }

    function _expanded_when($section, $value) {
        return $section == $value ? 'expanded' : 'collapsed';
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
            <?php _item("-ref-config-files",            "/docs/configuration-files/syntax/",     "Configuration Files",
                        _expanded_when($section, 'config-files')) ?>
            <ul>
                <?php
                    if ($section == 'config-files') {
                        _item("ref-config-syntax",            "/docs/configuration-files/syntax/",     "File Syntax");
                        _item("ref-config-reference",         "/docs/configuration-files/reference/",  "Reference");
                    }
                ?>
            </ul>

            <?php _item("-ref-plugins",                 "/docs/plugins/$parser_plugins[0]",      "Parser Plugins",
                        _expanded_when($section, 'parser-plugins')) ?>
            <ul>
                <?php
                    if ($section == 'parser-plugins') {
                        foreach ($parser_plugins as $name) {
                            _item("ref-plugin-$name", "/docs/plugins/$name/",  $name);
                        }
                    }
                ?>
            </ul>

            <?php _item("-ref-plugins",                 "/docs/plugins/$callback_plugins[0]",     "Callback Plugins",
                        _expanded_when($section, 'callback-plugins')) ?>
            <ul>
                <?php
                    if ($section == 'callback-plugins') {
                        foreach ($callback_plugins as $name) {
                            _item("ref-plugin-$name", "/docs/plugins/$name/",  $name);
                        }
                    }
                ?>
            </ul>

            <?php _item("help",                         "/docs/help/",                           "Command-line Help",
                        _expanded_when($section, 'help')) ?>
            <ul>
                <?php
                    if ($section == 'help') {
                        foreach ($help_topics as $topic) {
                            _item($topic, "/docs/help/$topic/",  $topic);
                        }
                    }
                ?>
            </ul>
        </ul>
        <?php /*
        <h3>Extending Serge</h3>
        <ul>
            <?php //_item("dev-plugins",                "/docs/development/plugins/",            "Plugins") ?>
            <?php //_item("dev-callbacks",              "/docs/development/callbacks/",          "Callbacks") ?>
        </ul>
        */ ?>
    </div>

    <div class="body">

