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

        echo '<li'._sel($id).$li_class.'><a href="'.$url.'"'.$a_class.'>'.$title.'</a></li>';
    }

    function _expanded_when($section, $value) {
        return $section == $value ? 'expanded' : 'collapsed';
    }

    require_once('help-topics.php');
    require_once('plugins.php');
?>

<div class="pod">
    <div class="menu">
        <ul>
            <?php _item("",                             "/docs/",                                "What is Serge?") ?>
        </ul>
        <h3>Basic Concepts</h3>
        <ul>
            <?php _item("continuous-localization",      "/docs/continuous-localization/",        "Continuous Localization") ?>
            <?php _item("configuration-files",          "/docs/configuration-files/",            "Configuration Files") ?>
            <?php _item("modular-architecture",         "/docs/modular-architecture/",           "Modular Architecture") ?>
            <?php _item("file-formats",                 "/docs/file-formats/",                   "Supported File Formats") ?>
            <?php _item("version-control",              "/docs/version-control/",                "Version Control") ?>
            <?php _item("translation-service",          "/docs/translation-service/",            "Translation Service") ?>
            <?php _item("localization-cycle",           "/docs/localization-cycle/",             "Localization Cycle") ?>
            <?php _item("localization-server",          "/docs/localization-server/",            "Localization Server") ?>
            <?php _item("command-line-interface",       "/docs/command-line-interface/",         "Command-line Interface") ?>
        </ul>
        <h3>Reference</h3>
        <ul>
            <?php _item("-ref-config-files",            "/docs/configuration-files/syntax/",     "Configuration Files", _expanded_when($section, 'config-files')) ?>
            <ul>
                <?php
                    if ($section == 'config-files') {
                        _item("ref-config-syntax",      "/docs/configuration-files/syntax/",     "File Syntax");
                        _item("ref-config-reference",   "/docs/configuration-files/reference/",  "Reference");
                    }
                ?>
            </ul>

            <?php _item("-ref-plugins",                 "/docs/plugins/parser/$parser_plugins[0]",      "Parser Plugins", _expanded_when($section, 'parser-plugins')) ?>
            <ul>
                <?php
                    if ($section == 'parser-plugins') {
                        foreach ($parser_plugins as $name) {
                            _item("ref-plugin-$name",   "/docs/plugins/parser/$name/",                   $name);
                        }
                    }
                ?>
            </ul>

            <?php _item("-ref-plugins",                 "/docs/plugins/callback/$callback_plugins[0]",     "Callback Plugins", _expanded_when($section, 'callback-plugins')) ?>
            <ul>
                <?php
                    if ($section == 'callback-plugins') {
                        foreach ($callback_plugins as $name) {
                            _item("ref-plugin-$name",   "/docs/plugins/callback/$name/",                   $name);
                        }
                    }
                ?>
            </ul>

            <?php _item("-ref-plugins",                 "/docs/plugins/vcs/$vcs_plugins[0]",          "VCS Plugins", _expanded_when($section, 'vcs-plugins')) ?>
            <ul>
                <?php
                    if ($section == 'vcs-plugins') {
                        foreach ($vcs_plugins as $name) {
                            _item("ref-plugin-$name",   "/docs/plugins/vcs/$name/",                   $name);
                        }
                    }
                ?>
            </ul>

            <?php _item("-ref-plugins",                 "/docs/plugins/ts/$ts_plugins[0]",           "Translation Service<br/>Plugins", _expanded_when($section, 'ts-plugins')) ?>
            <ul>
                <?php
                    if ($section == 'ts-plugins') {
                        foreach ($ts_plugins as $name) {
                            _item("ref-plugin-$name",   "/docs/plugins/ts/$name/",                   $name);
                        }
                    }
                ?>
            </ul>

            <?php _item("help",                         "/docs/help/",                            "Command-line Help", _expanded_when($section, 'help')) ?>
            <ul>
                <?php
                    if ($section == 'help') {
                        foreach ($help_topics as $topic) {
                            _item($topic,               "/docs/help/$topic/",                     $topic);
                        }
                    }
                ?>
            </ul>
        </ul>
        <h3>Extending Serge</h3>
        <ul>
            <?php _item("callbacks",                    "/docs/dev/callbacks/",                  "Callbacks") ?>
            <?php /*
            <?php //_item("dev-plugins",                "/docs/development/plugins/",            "Plugins") ?>
            */ ?>
        </ul>
    </div>

    <div class="body">

        <?php if ($tbd): ?>
        <p class="notice" style="background: #fcc">Content is being developed.</p>
        <?php endif ?>
