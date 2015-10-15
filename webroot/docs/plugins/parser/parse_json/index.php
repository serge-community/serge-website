<?php
    $section = 'parser-plugins';
    $subpage = 'ref-plugin-parse_json';
    $title = 'Generic JSON Tree Parser Plugin';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');
?>

<h1><?php echo htmlspecialchars($title) ?></h1>

<p>Plugin source location: <code>&lt;serge_root&gt;/lib/Serge/Engine/Plugin/parse_json.pm</code></p>

<p>This plugin is used to parse arbitrary JSON objects. It uses regular expressions as a configuration paramater to match translatable nodes in the JSON object tree.</p>

<p>If your JSON is a plain dictionary in <code>"key" : "value"</code> format, where all keys need to be translated, use the <a href="/docs/plugins/parser/parse_json_keyvalue/">parse_json_keyvalue</a> plugin instead.</p>

<p>In case JSON format validation fails, the plugin can send an error report to specified recipients. If no email settings are provided, it will simply report the error in the console output.</p>

<h2>Code Examples</h2>

<figure>
    <figcaption>products.json</figcaption>
    <code class="block">{
    "description" => "Product list",
    "<span class="hint">products</span>": [
        {
            "sku": "P001",
            "price": 1.23,
            "<span class="hint">title</span>": "<span class="string">First Product</span>"
            "<span class="hint">description</span>": "<span class="string">First Product Description</span>"
        },
        {
            "sku": "P002",
            "price": 2.34,
            "<span class="hint">title</span>": "<span class="string">Second Product</span>"
            "<span class="hint">description</span>": "<span class="string">Second Product Description</span>"
        },
        //...
    ],
    //...
}
</code>
</figure>

<p>Please see the example configuration file below to learn why only <code>title</code> and certain <code>description</code> nodes are extracted here for translation.</p>

<h2>Node Paths</h2>

<p>When JSON document is parsed, each node in it is given its path, and this path is what <code>path_matches</code> and <code>path_doesnt_match</code> <a href="http://www.regular-expressions.info/">regular expressions</a> should match against (see the example configuration file). This is how the paths are constructed, given the example JSON file above:</p>

<figure>
    <figcaption>products.json (internal 'path => value' representation)</figcaption>
    <code class="block"><span class="nop" >description</span>             => <span class="nop"   >Product list</span>
<span class="nop" >products[0]/sku</span>         => <span class="nop"   >P001</span>
<span class="nop" >products[0]/price</span>       => <span class="nop"   >1.23</span>
<span class="hint">products[0]/title</span>       => <span class="string">First Product</span>
<span class="hint">products[0]/description</span> => <span class="string">First Product Description</span>
<span class="nop" >products[1]/sku</span>         => <span class="nop"   >P001</span>
<span class="nop" >products[1]/price</span>       => <span class="nop"   >1.23</span>
<span class="hint">products[1]/title</span>       => <span class="string">Second Product</span>
<span class="hint">products[1]/description</span> => <span class="string">Second Product Description</span>
//...
</code>
</figure>

<p>The constructed path to a node is also extracted as a hint along with the corresponding string.</p>

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
            plugin                   parse_json

            data
            {
                /*
                (ARRAY) [OPTIONAL] One or more regular
                expressions to match the node path against;
                if any of the regular expressions match,
                the node value is extracted for translation.

                Note that '/', '[', and ']' symbols need
                to be escaped in a regular expression.

                In the example below, we want to extract
                all `title` and `description` terminal nodes
                no matter where they are located in the
                object tree.
                */
                path_matches         \/(title|description)$

                /*
                (ARRAY) [OPTIONAL] One or more regular
                expressions to match the node path against;
                if any of the regular expressions match,
                the node value is NOT extracted for translation.

                In the example below, we want to skip
                (prevent from being translated) the top-level
                `description` terminal node.
                */
                path_doesnt_match    ^description$

                /*
                (STRING) [OPTIONAL] Email to send
                error reports on behalf of
                */
                email_from           l10n-robot@acme.org

                /*
                (ARRAY) [OPTIONAL] One or more email
                addresses to send error reports to
                */
                email_to             engineer@acme.org
                                     project-manager@acme.org

                /*
                (STRING) [OPTIONAL] Email subject
                */
                email_subject        Errors found in JSON file
            }
        }

        # other job parameters
        # ...
    }
}
</script>
</figure>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-footer.php') ?>
