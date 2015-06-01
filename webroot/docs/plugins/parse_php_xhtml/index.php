<?php
    $section = 'parser-plugins';
    $subpage = 'ref-plugin-parse_php_xhtml';
    $title = 'PHP/XHTML Static Content Parser Plugin';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');
?>

<h1><?php echo htmlspecialchars($title) ?></h1>

<p>This plugin is used to parse [X]HTML/XML documents, including documents with embedded PHP and JavaScript code.</p>

<p>Plugin does full XML parsing/validation, so the document must be a XHTML/XML document with balanced tags. When it comes to PHP, these are replaced with special plain-text markers or HTML attributes to make resulting HTML valid. In case validation fails, the plugin can send an error report to specified recipients. If no email settings provided, it will simply report the error in the console output.</p>

<p>By default, the following contents are extracted:</p>
<ol>
    <li>Inner HTML of these tags: <code>&lt;h1&gt;</code>...<code>&lt;h7&gt;</code>, <code>&lt;p&gt;</code>, <code>&lt;li&gt;</code>, <code>&lt;dt&gt;</code>, <code>&lt;dd&gt;</code>, <code>&lt;label&gt;</code>, and <code>&lt;option&gt;</code></code>;</li>
    <li>Values of the following attributes: <code>&lt;alt&gt;</code>, <code>&lt;title&gt;</code>;</li>
    <li><code>value</code> attribute of the <code>&lt;input&gt;</code> tag, whose <code>type</code> attribute is one of the following: <code>text</code>, <code>search</code>, <code>email</code>, <code>submit</code>, <code>reset</code>, or <code>button</code>;</li>
    <li><code>placeholder</code> attribute for any <code>&lt;input&gt;</code> tags;</li>
    <li>strings inside <code>_('')</code>, <code>__('')</code>, and <code>___('')</code> wrapper functions (which can be used in embedded PHP or JavaScript). Strings can be single- or double-quoted.</li>
</ol>

<p>If the extracted candidate string for translation consists only of a PHP include, it is ignored.</p>

<p>In addition to implicit extraction rules listed above, one can add <em>localization hints</em> — special tag attributes that can adjust the string extraction</p>
<ul>
    <li><code>lang="en"</code> attribute on a tag means that the entire Inner HTML of the tag needs to be extracted for translation. It also prohibits this tag to be extracted as a part of some parent tag implicit extraction rule.</li>
    <li><code>lang=""</code> attribute means that the tag's attributes and entire tag subtree should be skipped. It also prohibits this tag to be extracted as a part of some parent tag implicit extraction rule.</li>
</ul>

<p>To control segmentation (for example, to split large paragraph into multiple separately translated sentences, one can use <code>&lt;span lang="en"&gt;...&lt;/span&gt;</code> and <code>&lt;div lang="en"&gt;...&lt;/div&gt;</code> wrappers.</p>

<p>Also, if either <code>context</code> or <code>data-l10n-context</code> attribute is present in a tag, its value is used as a context for the translatable string. Similarly, <code>hint</code> or <code>data-l10n-hint</code> attribute can be used to specify hint for the translatable string.</p>

<h2>Code Examples</h2>

<figure>
    <figcaption>example.php</figcaption>
    <code class="block">&lt;p data-l10n-context="<span class="context">context</span>" data-l10n-hint="<span class="hint">hint</span>"&gt;<span class="string">string</span>&lt;/p&gt;

&lt;h1&gt;<span class="string">string</span>&lt;/h1&gt;

&lt;p&gt;<span class="string">string</span>&lt;/p&gt;
&lt;p lang=""&gt;string&lt;/p&gt;

&lt;img alt="<span class="string">string</span>" title="<span class="string">string</span>" src="..." /&gt;

&lt;p&gt;
    outer string
    &lt;span lang=""&gt;inner string&lt;/span&gt;
&lt;/p&gt;
&lt;p&gt;
    &lt;span lang="en"&gt;<span class="string">outer string</span>&lt;/span&gt;
    &lt;span lang=""&gt;inner string&lt;/span&gt;
    &lt;/p&gt;

&lt;p&gt;
    <span class="string">Click here: &lt;a href="http://sample.com"&gt;http://sample.com&lt;/a&gt;</span>
&lt;/p&gt;
&lt;p&gt;
    &lt;span lang="en"&gt;<span class="string">Click here:</span>&lt;/span&gt;
    &lt;a href="http://sample.com"&gt;http://sample.com&lt;/a&gt;
&lt;/p&gt;

&lt;input type="search" placeholder="<span class="string">string</span>"&gt;
&lt;input type="text" value="<span class="string">string</span>"&gt;

&lt;div&gt;string&lt;/div&gt;
&lt;div lang="en"&gt;<span class="string">string</span>&lt;/div&gt;

&lt;?php
    echo "string";
    echo _("<span class="string">string</span>");
    echo __('<span class="string">string</span>');
    echo ___('<span class="string">string</span>');
?&gt;

&lt;script type="text/javascript"&gt;
    alert("string");
    alert(___('<span class="string">string</span>'));
&lt;/script&gt;

</code>
</figure>

<h2>Usage</h2>

<figure>
    <figcaption>example-project.serge</figcaption>
    <script language="text/x-config-neat">
jobs
{
    :sample-job
    {
        plugin                 parse_php_xhtml

        data
        {
            /*
                Optional: should the parser decode all numeric
                and named entities and replace them with
                final Unicode symbols?

                Default is NO
            */
            expand_entities    NO

            /*
                Optional: once the localized file is about
                to be saved, should we try to parse it again and,
                if parsing fails, prohibit it from being saved
                and report an error?

                This is useful as a final sanity check,
                but can significantly increase processing time
                on large projects.

                Default is NO
            */
            validate_output    NO

            # email to send error reports on behalf of
            email_from         l10n-robot@acme.org

            # one or more email addresses
            # to send error reports to
            email_to           website-engineer@acme.org
                               website-project-manager@acme.org

            # email subject
            email_subject      Errors found in JSON file
        }

        # other job parameters
        # ...
    }
}
</script>
</figure>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-footer.php') ?>

