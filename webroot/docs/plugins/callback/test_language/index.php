<?php
    $section = 'callback-plugins';
    $subpage = 'ref-plugin-test_language';
    $title = 'Test Language Translation Provider';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');

    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/version-selector.php');
?>

<h1><?php echo htmlspecialchars($title) ?></h1>

<p>Plugin source location: <code>&lt;serge_root&gt;/lib/Serge/Engine/Plugin/test_language.pm</code></p>

<p>Plugin always attaches itself to the following callback phases:</p>
<ul>
    <li><code><a href="/docs/dev/callbacks/#can_process_ts_file">can_process_ts_file</a></code></li>
    <li><code><a href="/docs/dev/callbacks/#can_generate_ts_file">can_generate_ts_file</a></code></li>
</ul>

<p>Plugin must be attached through the configuration file to exactly one of the following phases:</p>
<ul>
    <li><code><a href="/docs/dev/callbacks/#get_translation_pre">get_translation_pre</a></code></li>
    <li><code><a href="/docs/dev/callbacks/#get_translation">get_translation</a></code></li>
</ul>

<p>This plugin can automatically generate fake (pseudo) translations from source English strings. It provides two sets of transformations: (a) transliteration and (b) string expansion.</p>

<h3>Transliteration</h3>
<p>Transliteration is done by replacing latin characters with similarly looking Unicode letters with accents. The resulting strings remain readable, though visually more dense than the original English ones. This allows one to test if the application has all strings externalized properly, and whether there are any problems with displaying Unicode symbols. When replacing characters, the plugin tries not to break tags, URLs and various kinds of placeholders. Transliteration is enabled by default, but can be disabled in plugin settings.</p>

<p class="notice">Ŧĥĩš ĩš áŋ ēҳáḿṕļē őḟ ţĥē ŕēšũļţĩŋğ "ţŕáŋšļáţĩőŋ".</p>

<h3>String Expansion</h3>

<p>String Expansion is done by appending a certain amount of 'xxxxxxxxxx' words to the end of the string, depending on the length of the original string. It allows one to these the UI layout against longer strings. For large strings, the expansion ratio is 1.4 (40% extra symbols); for shorter strings this ratio gradually increases to 2.0.</p>

<p>In addition to adding extra symbols, the string gets wrapped with square brackets, which allows one to visually identify if the string is fully visible in the UI, as well as identify places of concatenation. If the source string already uses square brackets (for e.g. some sort of placeholders), parenthesis will be used as start and end markers instead.</p>

<p class="notice">[Ŧĥĩš ĩš áŋ ēҳáḿṕļē őḟ ţĥē ŕēšũļţĩŋğ "ţŕáŋšļáţĩőŋ". xxxxxxxxxx xxxxxxxxxx xx]</p>

<h2>Usage</h2>

<figure>
    <figcaption>example-project.serge</figcaption>
    <script language="text/x-config-neat">
jobs
{
    :sample-job
    {
        destination_languages  test

        callback_plugins
        {
            :fake-translate
            {
                plugin         test_language
                phase          get_translation

                data
                {
                    /*
                    (BOOLEAN) [OPTIONAL] Should the
                    translations be saved into the database,
                    and should TS files be generated
                    and parsed for the test language?
                    Generally you won't need to do that
                    unless for some low-level debugging
                    purposes.
                    Default: NO
                    */
                    save_translations    NO

                    /*
                    (BOOLEAN) [OPTIONAL] Should the
                    transliteration be applied to the
                    resulting translation?
                    Default: YES
                    */
                    transliterate        YES

                    /*
                    (BOOLEAN) [OPTIONAL] Should the
                    translated strings be expanded?
                    Default: NO
                    */
                    expand_length        NO

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

