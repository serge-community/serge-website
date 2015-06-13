<?php
    $section = 'parser-plugins';
    $subpage = 'ref-plugin-parse_rc';
    $title = 'Windows .RC Parser Plugin';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');
?>

<h1><?php echo htmlspecialchars($title) ?></h1>

<p>Plugin source location: <code>&lt;serge_root&gt;/lib/Serge/Engine/Plugin/parse_rc.pm</code></p>

<p>This plugin is used to parse <a href="https://msdn.microsoft.com/en-us/library/windows/desktop/aa380599(v=vs.85).aspx">Windows .RC files (resource definition scripts)</a>.</p>

<p>Supported structures are:</p>
<ol>
    <li><code>CAPTION</code> records in dialog headers;</li>
    <li>Contents of <code>BEGIN</code>...<code>END</code> blocks inside <code>MENU</code>, <code>DIALOG</code>, <code>DIALOGEX</code>, and <code>STRINGTABLE</code> records.</li>
</ol>

<p>Both record type preceding the translatable string, and string ID that goes after it, are combined into a hint and provided with the string.</p>

<h2>Code Examples</h2>

<figure>
    <figcaption>example.rc</figcaption>
    <code class="block">
IDD_MSG_DLG DIALOGEX ...
STYLE ...
<span class="hint">CAPTION</span> "<span class="string">string</span>"
BEGIN
    <span class="hint">LTEXT</span>         "<span class="string">string</span>",<span class="hint">IDC_MSGBOX_HEADER</span>,...
    <span class="hint">LTEXT</span>         "<span class="string">string</span>",<span class="hint">IDC_MSGBOX_HEADER_TEXT</span>,...
    <span class="hint">PUSHBUTTON</span>    "<span class="string">string</span>",<span class="hint">IDC_MSGBOX_BUTTON</span>,...
END

IDM_MAIN_MENU MENU
BEGIN
    POPUP "<span class="string">string</span>"
    BEGIN
        <span class="hint">MENUITEM</span> "<span class="string">string</span>",    <span class="hint">APPCMD_1</span>
        MENUITEM SEPARATOR
        <span class="hint">MENUITEM</span> "<span class="string">string</span>",    <span class="hint">APPCMD_2</span>
        <span class="hint">POPUP</span> "<span class="string">string</span>"
        BEGIN
            <span class="hint">MENUITEM</span> "<span class="string">string</span>",    <span class="hint">APPCMD_3</span>
            <span class="hint">MENUITEM</span> "<span class="string">string</span>",    <span class="hint">APPCMD_4</span>
        END
    END
END

STRINGTABLE
BEGIN
    <span class="hint">IDS_1</span> "<span class="string">string</span>"
    <span class="hint">IDS_2</span> "<span class="string">string</span>"
    ...
END
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
        parser
        {
            plugin               parse_rc
        }

        # other job parameters
        # ...
    }
}
</script>
</figure>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-footer.php') ?>