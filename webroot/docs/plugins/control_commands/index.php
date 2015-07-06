<?php
    $section = 'callback-plugins';
    $subpage = 'ref-plugin-control_commands';
    $title = 'Do Actions Based on Commands Provided in .PO Comments';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');
?>

<h1><?php echo htmlspecialchars($title) ?></h1>

<p>Plugin source location: <code>&lt;serge_root&gt;/lib/Serge/Engine/Plugin/control_commands.pm</code></p>

<p>Plugin always attaches itself to the following callback phase: <code>rewrite_parsed_po_item</code>.</p>

<p>This plugin allows one to do database-wide operations on internal Serge database based on special commands provided externally as translators' comments in .po files. This basically allows you to admin strings/items/translations right from within the translation interface. Obviously, when this plugin is active, ability to add comments to any translation unit should only be given to trusted translators.</p>

<p>Here are the supported commands:</p>
<dl>
    <dt><code>@ </code>Text</dt>
    <dd>Set (or replace existing) extra comment for the entire item (all language-specific units).</dd>

    <dt><code>@ </code></dt>
    <dd>Clear the extra comment for the item.</dd>

    <dt><code>+ </code>Text</dt>
    <dd>Append extra comment paragraph (<code>\n\n</code> + text) for the entire item (all language-specific units).</dd>

    <dt><code>#</code>tag1</dt>
    <dd>Add (append) `#tag1` to the end of the comment.</dd>

    <dt><code>-#</code>tag2</dt>
    <dd>Remove `#tag2` from the comment.</dd>

    <dt><code>@skip</code></dt>
    <dd>Skip string (mark as skipped in Serge database, which will remove it from all .po files on the next localization cycle).</dd>

    <dt><code>@remove_all</code></dt>
    <dd>Remove exact translations for the same source string from all items in the Serge database.</dd>
</dl>

<h2>Usage</h2>

<figure>
    <figcaption>example-project.serge</figcaption>
    <script language="text/x-config-neat">
jobs
{
    :sample-job
    {
        callback-plugins
        {
            :sample-control-commands
            {
                plugin                   control_commands

                data
                {
                    /*
                    (BOOLEAN) [OPTIONAL] When comment
                    is changed for the item, should all
                    its existing translations be marked
                    as fuzzy?
                    Default is YES
                    */
                    set_fuzzy_on_comment_change     YES
                }
            }
        }

        # other job parameters
        # ...
    }
}
</script>
</figure>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-footer.php') ?>

