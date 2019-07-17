<?php
    $section = 'callback-plugins';
    $subpage = 'ref-plugin-apply_xslt';
    $title = 'XSLT Transformation Plugin';

    $extra_head = '
        <script src="/media/vendor/codemirror/mode/xml.js"></script>
        <link rel="stylesheet" href="/media/xml/xml.css" />
        <script src="/media/xml/colorize_config.js"></script>
    ';

    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');

    $available_since = '1.4';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/version-selector.php');
?>

<h1><?php echo htmlspecialchars($title) ?></h1>

<p>Plugin source location: <code>&lt;serge_root&gt;/lib/Serge/Engine/Plugin/apply_xslt.pm</code></p>

<p class="notice">Before using the plugin for the first time, install additional Perl modules: <code>XML::LibXSLT</code> and <code>XML::LibXML</code>.</p>

<p>Plugin must be attached through the configuration file to exactly one of the following phases:</p>
<ul>
    <li><code><a href="/docs/dev/callbacks/#after_load_file">after_load_file</a></code></li>
    <li><code><a href="/docs/dev/callbacks/#before_save_localized_file">before_save_localized_file</a></code></li>
    <li><code><a href="/docs/dev/callbacks/#after_serialize_ts_file">after_serialize_ts_file</a></code></li>
    <li><code><a href="/docs/dev/callbacks/#before_deserialize_ts_file">before_deserialize_ts_file</a></code></li>
</ul>

<p>This plugin allows one to do apply XSLT transformations to an XML document. Examples of use: pre-processing source <a href="/docs/plugins/parser/parse_xml/">XML resource files</a> before parsing; post-processing generated localized XML resource files before saving; pre- and post-processing of XML-based translation interchange files (e.g. <a href="/docs/plugins/serializer/serialize_xliff/">XLIFF</a>).</p>

<p>This plugin inherits all the configuration logic from the parent <a href="/docs/plugins/callback/if/">'if' plugin</a> and, if all conditions are met, executes its XSLT logic. Note that all <code>if</code> conditions are optional: if none are provided, the plugin's logic will be always executed.</p>

<h2>Usage</h2>

<figure>
    <figcaption>example-project.serge</figcaption>
    <script language="text/x-config-neat">
jobs
{
    :sample-job
    {
        callback_plugins
        {
            :filter-xml
            {
                plugin                   apply_xslt
                phase                    after_load_file

                data
                {
                    /*
                    (STRING) Path to the XSLT file;
                    can be relative to the configuration
                    file or absolute
                    */
                    apply                ./keep-translatable-nodes.xslt

                    /*
                    (LIST) [OPTIONAL] a list of parameters
                    to pass down to XSLT.
                    */
                    params
                    {
                        /*
                        (STRING) param name and its value;
                        values can contain %CAPTURE:...% macros
                        (see `if` plugin for more information
                        about captures).

                        In XSLT, all such external parameters must
                        first be declared as <xsl:param name="foo" />
                        and then referenced as $foo in the template code.

                        See plugin tests (/t/data/engine/apply_xslt/)
                        for several usage examples.
                        */
                        foo              Some value
                        baz              %CAPTURE:COMMENT:1%
                    }
                }
            }
        }

        # other job parameters
        # ...
    }
}
</script>
</figure>

<p>This example XSLT file that is referenced in the config above filters the resource XML file content by keeping only the <code>resources/string</code> nodes that have a <code>comment="translate"</code> attribute:</p>

<figure>
    <figcaption>keep-translatable-nodes.xslt</figcaption>
    <script language="text/xml"><?xml version="1.0"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output method="xml" indent="yes" />

    <xsl:template match="/">
        <xsl:apply-templates/>
    </xsl:template>

    <xsl:template match="resources">
        <xsl:copy>
            <xsl:apply-templates select="string[@comment='translate']"/>
        </xsl:copy>
    </xsl:template>

    <xsl:template match="string">
        <string>
            <xsl:attribute name="name"><xsl:value-of select="@name"/></xsl:attribute>
            <xsl:value-of select="."/>
        </string>
    </xsl:template>
</xsl:stylesheet>
</script>
</figure>

<p>Example source XML file that the above XSLT transformation can be applied to:</p>

<figure>
    <figcaption>strings.xml (on disk)</figcaption>
    <script language="text/xml"><?xml version="1.0" encoding="utf-8"?>
<resources>
    <string name="string1">Value 1</string>
    <string name="string2">Value 2</string>
    <string name="string3" comment="translate">Value 3</string>
    <string name="string4">Value 4</string>
    <string name="string5">Value 5</string>
    <string name="string6" comment="translate">Value 6</string>
    <string name="string7" comment="exclude">Value 7</string>
</resources>
</script>
</figure>

<p>XML content after in-memory XSLT transformation (this is what will be parsed by Serge, and what will be used as a template when generating localized versions of this resource file):</p>

<figure>
    <figcaption>strings.xml (after in-memory transformation)</figcaption>
    <script language="text/xml"><?xml version="1.0" encoding="utf-8"?>
<resources>
    <string name="string3">Value 3</string>
    <string name="string6">Value 6</string>
</resources>
</script>
</figure>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-footer.php') ?>

