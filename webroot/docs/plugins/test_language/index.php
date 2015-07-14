<?php
    $section = 'callback-plugins';
    $subpage = 'ref-plugin-test_language';
    $title = 'Test (Fake) Language Translation Provider';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');
?>

<h1><?php echo htmlspecialchars($title) ?></h1>

<p>Plugin source location: <code>&lt;serge_root&gt;/lib/Serge/Engine/Plugin/test_language.pm</code></p>

<p>Plugin always attaches itself to the following callback phase: <code>can_process_po</code>.</p>

<p>Plugin must be attached through the configuration file to exactly one of the following phases:</p>
<ul>
    <li><code>get_translation_pre</code></li>
    <li><code>get_translation</code></li>
</ul>

<p>This plugin can automatically generate fake translations from source English strings by replacing latin characters with similarly looking Unicode letters with accents. The resulting strings remain readable, though visiually more dense than the original English ones. This allows one to test if the application has all strings externalized properly, and whether there are any problems with displaying Unicode symbols. When replacing characters, the plugin tries not to break tags and various kinds of placeholders.</p>

<p class="notice">Ŧĥĩš ĩš áŋ ēҳáḿṕļē őḟ ţĥē ŕēšũļţĩŋğ "ţŕáŋšļáţĩőŋ".</p>

<h2>Usage</h2>

<figure>
    <figcaption>example-project.serge</figcaption>
    <script language="text/x-config-neat">
jobs
{
    :sample-job
    {
        destination_languages  test

        callback-plugins
        {
            :fake-translate
            {
                plugin         test_language
                phase          get_translation

                data
                {
                    /*
                    (BOOLEAN) [OPTIONAL] Should the
                    translations be saved into the database?
                    Generally you won't need to save
                    such translations into the database
                    unless for some low-level debugging
                    purposes.
                    Default: NO
                    */
                    save_translations    NO

                    /*
                    (STRING) [OPTIONAL] Target language name.
                    This plugin will kick in when the target
                    language if job's `destination_languages`
                    parameter matches this value
                    Default: test
                    */
                    language             test

                    /*
                    [OPTIONAL] A dictionary of predefined
                    translations
                    */
                    translations
                    {
                        # source         (STRING) translation
                        foo              bAr
                        baz              EtC
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

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-footer.php') ?>

