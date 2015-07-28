<?php
    $section = 'parser-plugins';
    $subpage = 'ref-plugin-parse_wxl';
    $title = 'WiX Installer .WXL parser plugin';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');
?>

<h1><?php echo htmlspecialchars($title) ?></h1>

<p>Plugin source location: <code>&lt;serge_root&gt;/lib/Serge/Engine/Plugin/parse_wxl.pm</code></p>

<p>This plugin parses <a href="http://wixtoolset.org/documentation/manual/v3/howtos/ui_and_localization/make_installer_localizable.html">WiX Installer .WXL files</a>.</p>

<h2>Code Examples</h2>

<figure>
    <figcaption>sample.wxl</figcaption>
    <code class="block">&lt;?xml version="1.0" encoding="utf-8"?&gt;
&lt;WixLocalization Culture="<em>en-us</em>" xmlns="..."&gt;
    &lt;String Id="string_id"&gt;<span class="string">string</span>&lt;/String&gt;
    &lt;String Id="string_id"&gt;<span class="string">string</span>&lt;/String&gt;
    ...
&lt;/WixLocalization&gt;
</code>
</figure>

<p class="notice">Limitation: the <code>Culture="<em>...</em>"</code> attribute value is not being replaced automatically. This can now be done before file is saved by the means of <a href="/docs/plugins/callback/replace_strings/">replace_strings</a> plugin.</p>

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
            plugin               parse_wxl
        }

        /*
        Byte-order-mark (BOM) needs to be present
        in the output file
        */
        output_bom           YES

        # other job parameters
        # ...
    }
}
</script>
</figure>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-footer.php') ?>