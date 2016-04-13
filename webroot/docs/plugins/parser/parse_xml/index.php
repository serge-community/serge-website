<?php
    $section = 'parser-plugins';
    $subpage = 'ref-plugin-parse_xml';
    $title = 'Generic XML Parser Plugin';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');
?>

<h1><?php echo htmlspecialchars($title) ?></h1>

<p>Plugin source location: <code>&lt;serge_root&gt;/lib/Serge/Engine/Plugin/parse_xml.pm</code></p>

<p>This plugin is used to parse arbitrary XML data structures, including the ones that contain HTML inside CDATA sections, which also needs to be parsed. It uses regular expressions as a configuration parameter to match translatable nodes in the JSON object tree, and to identify the nodes, whose content needs to be treated as HTML which needs to be parsed additionally using the <a href="/docs/plugins/parser/parse_php_xhtml/">parse_php_xhtml</a> parser.</p>

<p>In case XML format validation fails, the plugin can send an error report to specified recipients. If no email settings are provided, it will simply report the error in the console output.</p>

<h2>Code Examples</h2>

<figure>
    <figcaption>products.xml</figcaption>
    <code class="block">&lt;products&gt;
    &lt;description&gt;Product list&lt;/description&gt;
    &lt;items&gt;
        &lt;item sku="P001"&gt;
            &lt;price&gt;1.23&lt;/price&gt;
            &lt;title&gt;<span class="string">First Product</span>&lt;/title&gt;
            &lt;description&gt;&lt;![CDATA[
                &lt;p&gt;<span class="string">First Product Description</span>&lt;/p&gt;
            ]]&gt;&lt;/description&gt;
        &lt;/item&gt;
        &lt;item sku="P002"&gt;
            &lt;price&gt;2.34&lt;/price&gt;
            &lt;title&gt;<span class="string">Second Product</span>&lt;/title&gt;
            &lt;description&gt;&lt;![CDATA[
                &lt;p&gt;<span class="string">Second Product Description</span>&lt;/p&gt;
            ]]&gt;&lt;/description&gt;
        &lt;/item&gt;
    &lt;/items&gt;
&lt;/products&gt;
</code>
</figure>

<p>Please see the example configuration file below to learn why only <code>title</code> and certain <code>description</code> nodes are extracted here for translation.</p>

<h2>Node Paths</h2>

<p>When XML document is parsed, each node in it is given its path, and this path is what <code>path_matches</code> and <code>path_doesnt_match</code> <a href="http://www.regular-expressions.info/">regular expressions</a> should match against (see the example configuration file). This is how the paths are constructed, given the example JSON file above:</p>

<figure>
    <figcaption>products.xml (internal 'path => value' representation)</figcaption>
    <code class="block"><span class="nop" >products/description</span>               => <span class="nop"   >Product list</span>
<span class="nop" >products/items/item[0]/sku</span>         => <span class="nop"   >P001</span>
<span class="nop" >products/items/item[0]/price</span>       => <span class="nop"   >1.23</span>
<span class="hint">products/items/item[0]/title</span>       => <span class="string">First Product</span>
<span class="hint">products/items/item[0]/description</span> => <span class="string">First Product Description</span>
<span class="nop" >products/items/item[1]/sku</span>         => <span class="nop"   >P002</span>
<span class="nop" >products/items/item[1]/price</span>       => <span class="nop"   >2.34</span>
<span class="hint">products/items/item[1]/title</span>       => <span class="string">Second Product</span>
<span class="hint">products/items/item[1]/description</span> => <span class="string">Second Product Description</span>
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
            plugin                   parse_xml

            data
            {
                /*
                (ARRAY) One or more regular expressions to
                match the node path against; if any of the
                regular expressions match, the node value
                is extracted for translation.

                Note that '/', '[', and ']' symbols need
                to be escaped in a regular expression.

                In the example below, we want to extract
                all `title` and `description` terminal nodes
                no matter where they are located in the
                object tree.
                */
                node_match           \/(title|description)$

                /*
                (ARRAY) [OPTIONAL] One or more regular
                expressions to match the node path against;
                if any of the regular expressions match,
                the node value is NOT extracted for
                translation.

                In the example below, we want to skip
                (prevent from being translated) the top-level
                `description` terminal node.
                */
                node_exclude         ^products\/description$

                /*
                (ARRAY) [OPTIONAL] One or more regular
                expressions to match the node path against;
                if any of the regular expressions match,
                the node value is considered an HTML
                (usually it is wrapped as CDATA),
                which needs to be processed by
                `parse_php_xhtml` parser
                */
                node_html            \/description$

                /*
                (STRING) [OPTIONAL] The XML dialect to
                optimize for.

                Accepted values: 'generic', 'android' or
                'indesign'. Default value: 'generic'

                'generic': no special treatment is necessary;

                'android': in this mode, do Android-specific
                apostrophe and quote escaping/unescaping;

                'indesign': in this mode, 'LINE SEPARATOR'
                (U+2028) Unicode character is stripped
                from the strings; also, leading and trailing
                whitespace in text nodes is preserved.
                */
                xml_kind             generic

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
                email_subject        Errors found in XML file
            }
        }

        # other job parameters
        # ...
    }
}
</script>
</figure>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-footer.php') ?>
