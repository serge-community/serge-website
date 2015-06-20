<?php
    $section = 'callback-plugins';
    $subpage = 'ref-plugin-if';
    $title = 'Generic Conditional Logic Plugin';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');
?>

<h1><?php echo htmlspecialchars($title) ?></h1>

<p>Plugin source location: <code>&lt;serge_root&gt;/lib/Serge/Engine/Plugin/if.pm</code></p>

<p>Plugin always attaches itself to the following callback phase: <code>before_job</code>.</p>
<p>Plugin must also be attached through the configuration file to either of the following phases:</p>
<ul>
    <li><code>after_load_source_file_for_processing</code></li>
    <li><code>after_load_file</code></li>
    <li><code>before_save_localized_file</code></li>
</ul>

<p>This plugin allows to define conditional <em>'if'</em> / <em>'if not'</em> logic, and do some action when a condition is satisfied. This is a base plugin that doesn't change the localization behavior or perform any actions on localized files. Several other descendant plugins, namely <a href="/docs/plugins/process_if/">process_if</a>, <a href="/docs/plugins/replace_strings/">replace_strings</a>, and <a href="/docs/plugins/run_command/">run_command</a>, inherit all the logic of the 'if' plugin and use it to control different callback phases and implement some useful actions on top of it.</p>

<p>However, the 'if' plugin is still useful for one particular task: to raise flags that can be queried in other plugin's conditionals. Flags have a file-wide scope: they are remembered for a particular source file and its localized copies, and are shared across multiple callback plugins within a job. For example, you can set up a generic 'if' plugin tied to <code>after_load_source_file_for_processing</code> phase, which would analyze the source file content and set some flag, in a combination with a <a href="/docs/plugins/run_command/">run_command</a> plugin tied to <code>after_save_localized_file</code> phase that can do something with the localized file only if that particular flag is set (see the example below).</p>

<h2>Example</h2>

<figure>
    <figcaption>example-project.serge</figcaption>
    <script language="text/x-config-neat">
jobs
{
    :sample-job
    {
        callback-plugins
        {
            /*
            Set 'GZIP' flag if file has a '.myext'
            extension, or if there's a 'SERGE_GZIP'
            marker inside this file
            */
            :test-gzip
            {
                plugin  if
                phase   after_load_source_file_for_processing

                data
                {
                    # test file path
                    if
                    {
                        file_matches            \.myext$
                        set_flag                GZIP
                    }

                    # test file contents
                    if
                    {
                        content_matches         \bSERGE_GZIP\b
                        set_flag                GZIP
                    }
                }
            }

            /*
            If the 'GZIP' flag has been set, run an external
            'gzip' command with the path to the localized file
            each time such localized file is saved to disk
            */
            :gzip
            {
                plugin  run_command
                phase   after_save_localized_file

                data
                {
                    if
                    {
                        has_flag                GZIP
                    }

                    /*
                    Command can spawn multiple lines; these
                    line breaks are treated as a regular space.
                    '%FILE%' is replaced with the full path
                    to the file
                    */
                    command                     gzip
                                                < %FILE%
                                                > %FILE%.gz
                }
            }
        }

        # other job parameters
        # ...
    }
}
</script>
</figure>



<p>Logical statements are defined as follows:</p>
<ol>
    <li>
        Plugin's <code>data { ... }</code> section may contain one or more <code>if { ... }</code> blocks. They are combined using logical 'OR'. This means that at least one of them must evaluate to a 'true' value:
        <code class="block">result = (block1 || block2 || block3 || ...)</code>
        Note that if <code>if { ... }</code> block contains <code>set_flag</code> or <code>remove_flag</code> directives, it will always be processed, even if the previous if block already evaluates to a 'true' value.
    </li>

    <li>
        Each <code>if { ... }</code> block can contain one or more statements. All statements must evaluate to 'true' (logical 'AND'):
        <code class="block">blockN = (statement1 &amp;&amp; statement2 &amp;&amp; statement3 &amp;&amp; ...)</code>
        Action statements, like <code>set_flag</code> and <code>remove_flag</code>, are ignored at this point (or you can treat them as always evaluating to 'true').
    </li>

    <li>
        Each positive statement (<code>*_matches</code> and <code>has_flag</code>) can contain one or more matching rules. Multiple rules are combined using logical 'OR':
        <code class="block">statementN = (rule1 || rule2 || rule3 || ...)</code>
    </li>

    <li>
        Each negative statement (<code>*_doesnt_match</code> and <code>has_no_flag</code>) can contain one or more matching rules. Multiple rules are combined using logical 'OR', and then negated:
        <code class="block">statementN = !(rule1 || rule2 || rule3 || ...)</code>
        Which is equivalent to:
        <code class="block">statementN = (!rule1 &amp;&amp; !rule2 &amp;&amp; !rule3 &amp;&amp; ...)</code>
        (which means 'none of the rules should match').
    </li>

    <li>
        <code>has_all_flags</code> statement returns true only if all flags are set (logical 'AND'):
        <code class="block">has_all_flags = (flag1 &amp;&amp; flag2 &amp;&amp; flag3 &amp;&amp; ...)</code>
    </li>

    <li>
        Each rule for <code>*_matches</code> and <code>*_doesnt_match</code> statement represents a regular expression to check a particular value against. Regular expression matches are always case-sensitive.
    </li>

    <li>
        Each rule for <code>has_flag</code>, <code>has_no_flag</code>, and <code>has_all_flags</code> statement represents an exact flag name (plain string, not a regular expression).
    </li>

    <li>
        <code>set_flag</code> and <code>remove_flag</code> actions will take effect in an <code>if { ... }</code> block only when all conditional statements within that block evaluate to 'true'.
    </li>
</ol>

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
            :sample-if-logic
            {
                plugin  if
                phase   after_load_source_file_for_processing

                data
                {
                    if
                    {
                        /*
                        Test if file path matches any of the
                        provided whitespace-separated list
                        of regular expressions.

                        Some phases provide a relative
                        file path to match, while others
                        provide an absolute path. Refer to
                        the documentation on callback phases
                        for more information.
                        */
                        file_matches            \bFOO\b \bBAR\b

                        /*
                        Test if file path doesn't match any of
                        the provided whitespace-separated list
                        of regular expressions.
                        */
                        file_doesnt_match       foo\/bar

                        /*
                        Test if language matches any of the
                        provided whitespace-separated list
                        of regular expressions.

                        Some phases may not provide a language,
                        in this case this statement can't be
                        used (script will show a corresponding
                        error message and bail out). Refer to
                        the documentation on callback phases
                        for more information.
                        */
                        lang_matches            \b\b
                        /*
                        Test if language doesn't match any of
                        the provided whitespace-separated list
                        of regular expressions.
                        */
                        lang_doesnt_match       \bfoo\b

                        /*
                        Test if content matches any of the
                        provided whitespace-separated list
                        of regular expressions.

                        For some phases, 'content' means the
                        content of the file, while for others
                        this will refer to the source or
                        translated string. Refer to
                        the documentation on callback phases
                        for more information.
                        */
                        content_matches         \bfoo\b
                        /*
                        Test if content doesn't match any of
                        the provided whitespace-separated list
                        of regular expressions.
                        */
                        content_doesnt_match    \bfoo\b bar_\d+

                        /*
                        Test if comment matches any of the
                        provided whitespace-separated list
                        of regular expressions.

                        Only few phases pass comment value
                        (which typically refers to translation
                        comment, or hint). Refer to
                        the documentation on callback phases
                        for more information.
                        */
                        comment_matches         \bfoo\b
                        /*
                        Test if comment doesn't match any of
                        the provided whitespace-separated list
                        of regular expressions.
                        */
                        comment_doesnt_match    \bfoo\b

                        /*
                        Test if any of the specified flags
                        have been set by this or descendant
                        plugins within the same job.
                        */
                        has_flag                flag1
                        /*
                        Test if none of the specified flags
                        have been set.
                        */
                        has_no_flag             flag2
                        /*
                        Test if all specified flags
                        have been set.
                        */
                        has_all_flags           flag3 flag4

                        /*
                        if all statements in the same
                        `if {...}` block are true,
                        set all the specified flags.
                        */
                        set_flag                flag5 flag6
                        /*
                        if all statements in the same
                        `if {...}` block are true,
                        remove all the specified flags.
                        */
                        remove_flag             flag7
                    }

                    if
                    {
                        #...
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

