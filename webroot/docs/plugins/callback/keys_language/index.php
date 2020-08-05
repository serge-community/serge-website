<?php
    $section = 'callback-plugins';
    $subpage = 'ref-plugin-keys_language';
    $title = 'Generate Globally Unique Keys as Translations';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');

    $available_since = '1.4';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/version-selector.php');
?>

<h1><?php echo htmlspecialchars($title) ?></h1>

<p>Plugin source location: <code>&lt;serge_root&gt;/lib/Serge/Engine/Plugin/keys_language.pm</code></p>

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

<p>and optionally, to the following phase:</p>

<ul>
    <li><code><a href="/docs/dev/callbacks/#add_hint">add_hint</a></code></li>
</ul>

<p>This plugin allows you to generate resource files with unique MD5-hash keys as 'translations'. Keys are generated based on the initial seed string (provided in plugin settings), database namespace, relative file path, and source string key, and are stable across multiple localization cycle runs. The same auto-generated keys can be exposed in string comments (hints) on your translation server, or exported into an external database or static file from Serge database.</p>

<p>Unique string keys can be treated as global identifiers across multiple products, platforms or assets. Having them in localized resource files allows to easily map them to internal in-product string keys, which are not guaranteed to be globally unique.</p>

<p>Having an ability to globally address strings can enable some advanced string handling techniques:</p>

<ul>
    <li>A/B copy testing: connect to an external A/B framework to get string variants for the given unique key</li>
    <li>Dynamic and in-context translation preview: in internal instrumented builds, get localizations dynamically from a translation server and allow the user to navigate to a string on a translation server by selecting a string in the client.</li>
    <li>Dynamic translation delivery: use additional instrumentation in a production environment to push strings down to client applications.</li>
    <li>Localization quality feedback: use additional instrumentation in a production environment to allow users report translation issues by selecting a specific string in the client application.</li>
</ul>

<h2>Example</h2>

<p>Imagine you have the following source file:</p>

<figure>
    <figcaption>resources/en/strings.ini</figcaption>
    <code class="block">ok_btn_caption=OK
cancel_btn_caption=Cancel
upgrade_btn_caption=Upgrade
...
</code>
</figure>

<p>Then the auto-generated localized file for the special <code>keys</code> language will look like this:</p>

<figure>
    <figcaption>resources/keys/strings.ini</figcaption>
    <code class="block">ok_btn_caption=f602a38e53fb52d8cdba3b639b6e4de8
cancel_btn_caption=60bcde5cd1555ce0bae8e0c87b2f651e
upgrade_btn_caption=12e954946cfc4a74632d1e6727d54bae
...
</code>
</figure>

<p>With that, you can get a global key of the string by getting its 'translation' for the <code>keys</code> language. Consider the following example code:</p>

<figure>
    <figcaption>Source pseudo-code</figcaption>
    <code class="block">// An instrumented translation lookup function
function getTranslation(localKey, language) {
    // get the global string key by querying
    // the 'keys' language in bundled resources
    let globalKey = getTranslationFromResources(localKey, 'keys');

    // get dynamic translation for the given global key
    // and target user locale from e.g. remote server
    return getLiveTranslation(globalKey, language);
}
</code>
</figure>

<p>If you call the function above to get the translation for a local key named <code>ok_btn_caption</code> and target user locale <code>de</code> as follows: <code>getTranslation('ok_btn_caption', 'de')</code>, it will, in turn, load the up-to-date translation for the given locale from the remote server by the global <code>f602a38e53fb52d8cdba3b639b6e4de8</code> key.</p>

<p>The example above is provided only to help you visualize the concept. Fetching each string independently from a translation server is not the best idea. The main point here is that your client-side code and your server-side infrastructure can consistently address all the localized strings.</p>

<h2>Usage</h2>

<figure>
    <figcaption>example-project.serge</figcaption>
    <script language="text/x-config-neat">
jobs
{
    :sample-job
    {
        destination_languages  keys

        callback_plugins
        {
            :generate-global-keys
            {
                plugin         keys_language

                phase          add_hint
                               get_translation_pre

                data
                {
                    /*
                    (BOOLEAN) [OPTIONAL] Should the
                    translations be saved into the database?
                    You will likely need this if you want
                    to export these keys directly from Serge
                    database.
                    Default: NO
                    */
                    save_translations    NO

                    /*
                    (STRING) [OPTIONAL] Target language name.
                    This plugin will kick in when the target
                    language in job's `destination_languages`
                    parameter matches this value.
                    Default: keys
                    */
                    language             keys

                    /*
                    (STRING) [OPTIONAL] Initial 'seed' string
                    to calculate the key hash. Can be used to
                    ensure key disambiguation across multiple
                    Serge databases. It can be any string, for
                    example, database name or source language.
                    Default: empty string
                    */
                    seed                 en

                    /*
                    (BOOLEAN) [OPTIONAL] If source string keys
                    (IDs) are used to generate the global key,
                    should the string itself take part in global
                    key calculation?
                    Setting it to NO makes all strings sharing
                    the same source key get the same global
                    key as well; setting it to YES will ensure
                    that different strings will get different
                    global keys even if their source keys stay
                    the same.
                    A good example when you might want to set
                    it to YES is A/B testing: you need to
                    automatically change the global key
                    as soon as the source string is changed
                    under the same source key to avoid old
                    A/B test variants to be applied to an
                    already modified string.
                    Default: NO
                    */
                    seed_with_string     NO

                    /*
                    (STRING) [OPTIONAL] How the global key
                    should be formatted? By default, it
                    is a bare MD5 hash, but one might want
                    to add some suffix or prefix to
                    distinguish such keys from other hash-like
                    strings. The format string must contain the
                    %HASH% macro.
                    Default: %HASH%
                    */
                    string_format        `{STR:%HASH%}`

                    /*
                    (STRING) [OPTIONAL] How the hint
                    should be rendered when plugin is attached
                    to add_hint phase? By default, it is a bare
                    MD5 hash, but one might want to add some
                    more verbose explanatory message. The format
                    string must contain the %HASH% macro.
                    Default: %HASH%
                    */
                    hint_format          `Global ID: {STR:%HASH%}`
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

