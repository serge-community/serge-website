<?php
    $section = 'ts-plugins';
    $subpage = 'ref-plugin-smartcat_v2';
    $title = 'Smartcat Synchronization Plugin (Version 2)';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');

    #$available_since = '1.4';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/version-selector.php');
?>

<h1><?php echo htmlspecialchars($title) ?></h1>

<p>Plugin source location: <code>&lt;serge_root&gt;/lib/Serge/Sync/Plugin/TranslationService/smartcat_v2.pm</code></p>

<p>This plugin provides integration with <a href="https://smartcat.ai/">Smartcat</a>, an all-in-one localization platform.</p>

<p><a href="https://github.com/smartcatai/smartcat-serge-bootstrap">Use this bootstrap localization project</a> to get started with Serge and Smartcat in minutes. Before using this plugin, install the Smartcat command-line tool, <code>smartcat-cli</code>, by running the following command:</p>

<code class="cli">cpan Smartcat::App</code>

<p>On <code><a href="/docs/help/serge-push-ts/">push-ts</a></code> sync step, Serge will upload generated .po files to a specified Smartcat project. Respectively, on <code><a href="/docs/help/serge-pull-ts/">pull-ts</a></code> sync step, Serge will download all new translations from the same Smartcat project into local .po files.</p>

<h2>Usage</h2>

<figure>
    <figcaption>example-project.serge</figcaption>
    <script language="text/x-config-neat">
sync
{
    ts
    {
        plugin                   smartcat_v2

        data
        {
            /*
            Provide the base API server URL here.
            Note that the trailing slash must be omitted.
            Options are:
            https://smartcat.ai       (Europe)
            https://us.smartcat.ai    (North America)
            https://ea.smartcat.ai    (Asia)
            You will know the server your account is on
            by just signing into your account
            and looking at the URL.
            Default: https://smartcat.ai
            */
            base_url             https://smartcat.ai

            /*
            Provide your account ID as it is displayed on
            your `Settings > API` page once you sign into
            your Smartcat account.
            */
            account_id           12345678-abcd-9876-5432-abcdef012345

            /*
            Go to `Settings > API` page in your account,
            and generate an API key. Key name can be anything,
            e.g. 'Serge', and the auto-generated secret part
            of the key is what needs to be added here.
            */
            token                1_AaBbCcDdEeFfGgHhIiJjKkLlM

            /*
            Provide the project ID to synchronize data with.
            To get the ID, navigate to the target project and take
            it's ID from the URL. For example, if the URL is
            https://us.smartcat.ai/projects/
            01234567-890a-bcde-f012-34567890abcd/files then the ID
            will be 01234567-890a-bcde-f012-34567890abcd
            */
            project_id           01234567-890a-bcde-f012-34567890abcd

            /*
            [OPTIONAL] Write plugin activity log to the specified
            file (enable this only if requested by Smartcat support).
            Default: NO
            */
            debug                NO
        }
    }

    # other sync parameters
    # ...
}
</script>
</figure>

<p class="notice">When working with Smartcat, always use the <a href="/docs/plugins/serializer/serialize_po">serialize_po</a> serializer for translation interchange files (which is the default one, so you don't have to specify it in your localization jobs).</p>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-footer.php') ?>

