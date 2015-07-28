<?php
    $section = 'callback-plugins';
    $subpage = 'ref-plugin-transform';
    $title = 'Guess Translations From Similar Already Translated Strings';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');
?>

<h1><?php echo htmlspecialchars($title) ?></h1>

<p>Plugin source location: <code>&lt;serge_root&gt;/lib/Serge/Engine/Plugin/transform.pm</code></p>

<p>Plugin attaches itself to the following callback phase: <code>get_translation</code>.</p>

<p>Given a source string to translate, this plugin finds similar strings in the database by trying different transformation combinations, and then guesses the translation for the source string by applying the same chain of transformation to the pre-existing similar translation. Transformations include adjusting whitespace, ending punctuation, HTML tags, or applying different case.</p>

<p>Consider this example: there's a phrase "Hello, world!" in the database, and it is already translated into Russian as "Привет, мир!". Now we get a new string, "HELLO, WORLD". This plugin detects that it can transform "Hello, world!" into "HELLO, WORLD" by uppercasing it first, then removing the ending exclamation mark, and applies the same transformation to the translation. The result, "ПРИВЕТ, МИР", is returned as a guessed translation.</p>

<h2>Usage</h2>

<figure>
    <figcaption>example-project.serge</figcaption>
    <script language="text/x-config-neat">
jobs
{
    :sample-job
    {
        destination_languages            de fr ja ko ru

        callback-plugins
        {
            :fake-translate
            {
                plugin                   transform
                phase                    get_translation

                data
                {
                    /*
                    (BOOLEAN) [OPTIONAL] Should the guessed
                    translations be returned as fuzzy?
                    Default: YES
                    */
                    as_fuzzy_default     YES

                    /*
                    (ARRAY) [OPTIONAL] List of languages
                    for which guessed translations are
                    always returned as fuzzy (despite
                    the `as_fuzzy_default` setting)
                    */
                    as_fuzzy             ja ko

                    /*
                    (ARRAY) [OPTIONAL] List of languages
                    for which guessed translations are
                    always returned as NOT fuzzy (despite
                    the `as_fuzzy_default` setting)
                    */
                    as_not_fuzzy         ru

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

