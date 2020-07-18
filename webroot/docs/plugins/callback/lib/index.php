<?php
    $section = 'callback-plugins';
    $subpage = 'ref-plugin-lib';
    $title = 'Use Custom Perl Library Paths';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');

    //$available_since = '1.5';
    //include($_SERVER['DOCUMENT_ROOT'] . '/../inc/version-selector.php');
?>

<h1><?php echo htmlspecialchars($title) ?></h1>

<p>Plugin source location: <code>&lt;serge_root&gt;/lib/Serge/Engine/Plugin/lib.pm</code></p>

<p>This plugin can inject custom paths into the <code>@INC</code> array so that Perl can find your custom parser or callback plugin in a provided directory. This allows one to keep extra plugins next to your Serge project, and not installed as global Perl modules.</p>

<p>For this plugin to work properly, it must go as a first one in the <code>callback_plugins { ... }</code> section of your configuration file.</p>

<h2>Usage</h2>

<p>Based on the <a href="/docs/organizing-your-data/">suggested directory structure</a> of your Serge server, it is recommended to put your custom modules under <code>/var/serge/data/lib</code> folder, for example:</p>

<figure>
    <figcaption>Directory structure</figcaption>
    <code class="block"><span class="inactive">/var
    /serge
        /data
            /configs
                example-project.serge (see below)
            /db
            </span>/lib
                my_parser.pm
                my_callback_plugin.pm<span class="inactive">
            /ts
            /vcs
</span></code>
</figure>

<p>Then the <code>/var/serge/data/configs/example-project.serge</code> will look like this:</p>

<figure>
    <figcaption>example-project.serge</figcaption>
    <script language="text/x-config-neat">
jobs
{
    :sample-job
    {
        callback_plugins
        {
            :lib
            {
                plugin         lib

                data
                {
                    /*
                    (ARRAY) A list of paths to search libraries in.
                    Paths can be relative to the configuration file,
                    or absolute. Here `../lib` will resolve to
                    `/var/serge/data/lib` path.

                    %ENV:<...>% macros in paths are expanded
                    before each path is converted to an absolute one.
                    */
                    path       ../lib
                }
            }

            /*
            The plugin below can now use a module from a custom
            library directory.

            Note the plugin name starts with `::`. This means
            that the module name is exactly `my_callback_plugin`.
            If you simply say `my_plugin`, Serge will expand the
            module name to `Serge::Engine::Plugin::my_callback_plugin`
            */
            :my-plugin
            {
                plugin         ::my_callback_plugin
            }
        }

        /*
        Here the parser is also a custom one
        (resolved to /var/serge/data/lib/my_parser.pm)
        */
        parser                 ::my_parser

        # other job parameters
        # ...
    }
}
</script>
</figure>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-footer.php') ?>

