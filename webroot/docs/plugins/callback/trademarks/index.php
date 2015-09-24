<?php
    $section = 'callback-plugins';
    $subpage = 'ref-plugin-trademarks';
    $title = 'Add "Do Not Alter Trademarks" Comment';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');
?>

<h1><?php echo htmlspecialchars($title) ?></h1>

<p>Plugin source location: <code>&lt;serge_root&gt;/lib/Serge/Engine/Plugin/trademarks.pm</code></p>

<p>Plugin always attaches itself to the following callback phase: <code>add_dev_comment</code>.</p>

<p>Given a list of trademarks names, this plugin will add a 'Please do not alter trademarks (...)' message to developer comments for each string that has any of such trademark names.</p>

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
            :detect-trademarks
            {
                plugin               trademarks

                data
                {
                    /*
                    (ARRAY) List of trademark names
                    */
                    trademarks       `ACME Corp.` FooProduct
                                     BarFeature
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

