<?php
    $section = 'parser-plugins';
    $subpage = 'ref-plugin-parse_js';
    $title = 'Generic JavaScript Object Parser Plugin';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');

    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/version-selector.php');
?>

<h1><?php echo htmlspecialchars($title) ?></h1>

<p>Plugin source location: <code>&lt;serge_root&gt;/lib/Serge/Engine/Plugin/parse_js.pm</code></p>

<p>This plugin is used to parse JavaScript object properties in <code>"key" : "value"</code> format. It is also suitable to parse string maps in Go, since their syntax is very similar. Each key-value pair must be on its own line. If the line ends with a comment, it will be extracted as an additional hint as well. If the string key is identical to the string itself, it will not be used as a hint (since such a hint adds no value).</p>

<p>Note that this parser supports only a subset of syntax and does no validation. It is targeted for arbitrary source code files. If your resource file is rather a well-formed JSON that can be strictly validated, you can use the <a href="/docs/plugins/parser/parse_json_keyvalue/">parse_json_keyvalue</a> plugin instead.</p>

<h2>Code Examples</h2>

<figure>
    <figcaption>example.js</figcaption>
    <code class="block">var localizations = {
    // whitespace before and afer colon is ignored:
    "<span class="hint">key1</span>" : "<span class="string">string 1</span>",
    "<span class="hint">key2</span>": "<span class="string">string 2</span>",
    "<span class="hint">key3</span>":"<span class="string">string 3</span>",

    // You can add extra comment after a particular line that
    // will be extracted. Comments have to start with `//`.
    // Space around `//` is ignored:
    "<span class="hint">key4</span>": "<span class="string">string 4</span>", // <span class="hint">additional comment for string 4</span>
    "<span class="hint">key5</span>": "<span class="string">string 5</span>",//<span class="hint">additional comment for string 5</span>
    "<span class="hint">key6</span>": "<span class="string">string 6</span>",    // <span class="hint">additional comment for string 6</span>

    // single quotes around string literals are supported
    // for both keys and values:
    '<span class="hint">key7</span>': '<span class="string">string 7</span>',

    // a mix of single and double quotes is allowed:
    '<span class="hint">key8</span>': "<span class="string">string 8</span>",
    "<span class="hint">key9</span>": '<span class="string">string 9</span>',

    // unquoted key names are allowed as well:
    <span class="hint">key10</span>: "<span class="string">string 10</span>"
};
</code>
</figure>

<p class="notice">Note: multi-line strings (strings with concatenation) are not supported.</p>

<h2>Usage</h2>

<figure>
    <figcaption>example-project.serge</figcaption>
    <script language="text/x-config-neat">
jobs
{
    :sample-job
    {
        parser
        {
            plugin               parse_js
        }

        # other job parameters
        # ...
    }
}
</script>
</figure>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-footer.php') ?>