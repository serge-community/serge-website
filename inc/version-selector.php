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

    $dirs = array_reverse(scandir($_SERVER['DOCUMENT_ROOT'] . $uri . $version_root . 'v/'));
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
            <option value="<?php echo $version_root ?>" onchange="">Latest</option>
            <?php
                foreach ($dirs as $version) {
                    if (($version != '.') && ($version != '..')) {
                        $subdir = "v/$version/";
                        $sel = ($subdir == $option) ? ' selected' : '';
                        $version = preg_replace('/-/', '&ndash;', $version); # replace hyphen with short dash
                        echo "<option value=\"$version_root$subdir\"$sel>$version</option>\n";
                    }
                }
            ?>
        </select>
    </div>
</div>
