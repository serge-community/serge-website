<?php

    $uri = $_SERVER['REQUEST_URI'];
    $uri = preg_replace('/\?.*/', '', $uri); # remove query parameters
    $uri = preg_replace('/index\.php$/', '', $uri); # remove 'index.php' at the end

    $version_root = '';
    $option = '';
    $matches = array();
    if (preg_match('/\/(v\/[\d\.-]+\/)/', $uri, $matches)) { # check for /v/X.X/ folder at the end of the URI
        $version_root = '../../';
        $option = $matches[1];
    }

    #echo "[$uri][$version_root][$option]";

    $latest_caption = 'Latest';
    $versions_dir = $_SERVER['DOCUMENT_ROOT'] . $uri . $version_root . 'v/';
    if (file_exists($versions_dir)) {
        $dirs = array_reverse(scandir($versions_dir));
        array_pop($dirs); // remove '..'
        array_pop($dirs); // remove '.'
    } else {
        $dirs = array();

        if ($available_since != '') {
            $latest_caption = "Since $available_since";
        }
    }
    if ($available_since == '') {
        $available_since = '1.0';
    }
?>

<div class="doc-version-container">
    <div class="doc-version">
        <script>
            $(function() {
                $('#doc-version').on('change', function(e) {
                    window.location = e.target.value;
                });
            });
        </script>
        <select id="doc-version">
            <option value="<?php echo $version_root ?>" onchange=""><?php echo $latest_caption ?></option>
            <?php
                $last_value = end($dirs);
                foreach ($dirs as $version) {
                    $subdir = "v/$version/";
                    $sel = ($subdir == $option) ? ' selected' : '';
                    $version_print = preg_replace('/-/', '&ndash;', $version); # replace hyphen with short dash

                    $caption = "$version_print and below";
                    if ($last_value == $version && $available_since != '') {
                        if ($version == $available_since) {
                            $caption = "$version_print";
                        } else {
                            $caption = "$version_print &mdash; $available_since";
                        }
                    }
                    echo "<option value=\"$version_root$subdir\"$sel>$caption</option>\n";
                }
            ?>
        </select>
    </div>
</div>
