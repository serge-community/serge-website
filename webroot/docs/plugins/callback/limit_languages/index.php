<?php
    $section = 'callback-plugins';
    $subpage = 'ref-plugin-limit_languages';
    $title = 'Limit Destination Languages on a Per-File Basis';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');
?>

<h1><?php echo htmlspecialchars($title) ?></h1>

<p>Plugin source location: <code>&lt;serge_root&gt;/lib/Serge/Engine/Plugin/limit_languages.pm</code></p>

<p>Plugin always attaches itself to the following callback phases:</p>
<ul>
    <li><code><a href="/docs/dev/callbacks/#after_load_source_file_for_processing">after_load_source_file_for_processing</a></code></li>
    <li><code><a href="/docs/dev/callbacks/#is_file_orphaned">is_file_orphaned</a></code></li>
    <li><code><a href="/docs/dev/callbacks/#can_process_source_file">can_process_source_file</a></code></li>
    <li><code><a href="/docs/dev/callbacks/#can_process_ts_file">can_process_ts_file</a></code></li>
    <li><code><a href="/docs/dev/callbacks/#can_generate_ts_file">can_generate_ts_file</a></code></li>
    <li><code><a href="/docs/dev/callbacks/#can_generate_localized_file">can_generate_localized_file</a></code></li>
</ul>

<p>This plugin allows to map each file to a subset of languages it needs to be localized into. So, in addition to job-wide list of target languages, one can override the list of languages for any specific file, based on rules that examine the file name or its contents.</p>

<h2>Default Behavior</h2>

<p>By default, the plugin provides the following behavior:</p>

<ol>
    <li>By default, each file is localized into all languages specified in the <code>job &rarr; destination_languages</code> parameter.</li>

    <li>When <code>L10N_LIMIT_DESTINATION_LANGUAGES=aa,bb-cc,dd,...</code> string appears in the file, the list of languages ('aa', 'bb-cc', 'dd', ...) is used as a list of languages localization should be limited to.</li>

    <li>When <code>L10N_EXCLUDE_DESTINATION_LANGUAGES=ee,ff-gg,...</code> string appears in the file, the list of languages ('ee', 'ff-gg', ...) is removed from the original list defined in a job.</li>
</ol>

<p>These rules are equivalent to the following plugin configuration:</p>

<figure>
    <figcaption>Default Rules</figcaption>
    <script language="text/x-config-neat">
if
{
    content_matches    \bL10N_LIMIT_DESTINATION_LANGUAGES=([\w,-]*)

    then
    {
        split_by       ,
        limit_to_matched_languages
    }
}

if
{
    content_matches    \bL10N_EXCLUDE_DESTINATION_LANGUAGES=([\w,-]*)

    then
    {
        split_by       ,
        exclude_matched_languages
    }
}
</script>
</figure>

<h2>Custom Rules</h2>

<p>When default rules are not enough, you can implement your own ones, by defining one or more <nobr><code>if { ... }</code></nobr> rules inside plugin's <code>data</code> config section. The <code>if</code> rules are processed top to bottom; each rule can add or remove languages so the most priority rules are placed at the bottom. See the example below:</p>

<figure>
    <figcaption>example-project.serge</figcaption>
    <script language="text/x-config-neat">
jobs
{
    :sample-job
    {
        destination_languages                    da de es es-latam fi
                                                 fr id it ja ko nl pl
                                                 pt pt-br ru sv tr
                                                 zh-cn zh-tw

        callback_plugins
        {
            :sample-control-commands
            {
                plugin                           limit_languages

                data
                {
                    if
                    {
                        # by default, don’t localize
                        # into any language
                        content_matches          .

                        then
                        {
                            exclude_all_languages
                        }
                    }

                    if
                    {
                        # if "LANG_ALL" marker is present
                        # in the file, include all languages
                        # defined for the job
                        # ("\b" means "word boundary"
                        # in regular expressions)
                        content_matches          \bLANG_ALL\b

                        then
                        {
                            include_all_languages
                        }
                    }

                    if
                    {
                        # if "LANG_EUROPE" marker is present
                        # in the file, include European languages
                        content_matches         \bLANG_EUROPE\b

                        then
                        {
                            include_languages   da de es fi fr it nl
                                                pl pt ru sv tr
                        }
                    }

                    if
                    {
                        # if "LANG_APAC" marker is present
                        # in the file, include APAC languages
                        content_matches         \bLANG_APAC\b

                        then
                        {
                            include_languages   id ja ko zh-cn zh-tw
                        }
                    }

                    if
                    {
                        # generic rule to include a specific
                        # set of languages
                        # example: LANG_INCLUDE=ar,de
                        content_matches         \bLANG_INCLUDE=([\w,-]*)

                        then
                        {
                            split_by            ,
                            include_matched_languages
                        }
                    }

                    if
                    {
                        # generic rule to exclude a certain
                        # set of languages
                        # example: LANG_EXCLUDE=pt
                        content_matches         \bLANG_EXCLUDE=([\w,-]*)

                        then
                        {
                            split_by            ,
                            exclude_matched_languages
                        }
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

<h2>Reference</h2>

<figure>
    <figcaption>example-project.serge</figcaption>
    <script language="text/x-config-neat">
jobs
{
    :sample-job
    {
        callback_plugins
        {
            :sample-control-commands
            {
                plugin                              limit_languages

                data
                {
                    /*
                    (ARRAY) [OPTIONAL] List of regular
                    expressions to match the file name
                    against. Any regular expression should
                    match in order for the rule to be
                    considered `true`.
                    */
                    file_matches                    ^foo
                                                    bar$
                    /*
                    (ARRAY) [OPTIONAL] List of regular
                    expressions to match the file name against.
                    None of the expressions should match
                    in order for the rule to be considered
                    `true`.
                    */
                    file_doesnt_match               ^foobar$

                    /*
                    (ARRAY) [OPTIONAL] List of regular
                    expressions to match the file content
                    against. Any regular expression should
                    match in order for the rule to be
                    considered `true`.
                    */
                    content_matches                 \bFOO\b

                    /*
                    (ARRAY) [OPTIONAL] List of regular
                    expressions to match the file content
                    against. None of the expressions should
                    match in order for the rule to be
                    considered `true`.
                    */
                    content_doesnt_match            \bBAR\b

                    /*
                    (STRING) [OPTIONAL] Regular expression
                    to split the extracted list of languages
                    by. In order for this to work, the
                    `file_matches` or `content_matches`
                    regular expressions must have `()`
                    (capturing parentheses) to extract the
                    list of languages.
                    */
                    split_by                        ,

                    /*
                    Once all defined matching rules have
                    been met, the list of languages will be
                    adjusted by one of the provided actions
                    below:
                    */

                    /*
                    (ARRAY) [OPTIONAL] List of languages
                    to limit translation to. This is always
                    a subset of job's `destination_languages`
                    list.
                    */
                    limit_languages                 ar de zh-cn

                    /*
                    (ARRAY) [OPTIONAL] List of languages to
                    include for translation. This is always
                    a subset of job's `destination_languages`
                    list.
                    */
                    include_languages               fr pt-br

                    /*
                    (ARRAY) [OPTIONAL] List of languages to
                    exclude from translation. This is always
                    a subset of job's `destination_languages`
                    list.
                    */
                    exclude_languages               es it

                    /*
                    (BOOLEAN) [OPTIONAL] When languages are
                    extracted from the matched string (see
                    `split_by`), use them as a target list
                    of languages for translation.
                    */
                    limit_to_matched_languages

                    /*
                    (BOOLEAN) [OPTIONAL] When languages are
                    extracted from the matched string (see
                    `split_by`), add these languages to the
                    target list.
                    */
                    include_matched_languages

                    /*
                    (BOOLEAN) [OPTIONAL] When languages are
                    extracted from the matched string (see
                    `split_by`), remove these languages to
                    the target list.
                    */
                    exclude_matched_languages

                    /*
                    (BOOLEAN) [OPTIONAL] Remove all
                    languages (reset the target list)
                    */
                    exclude_all_languages

                    /*
                    (BOOLEAN) [OPTIONAL] Include all
                    languages defined in job's
                    `destination_languages` list.
                    */
                    include_all_languages
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

