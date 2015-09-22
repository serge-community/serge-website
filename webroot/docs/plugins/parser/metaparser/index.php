<?php
    $section = 'parser-plugins';
    $subpage = 'ref-plugin-metaparser';
    $title = 'Metaparser Plugin';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');
?>

<h1><?php echo htmlspecialchars($title) ?></h1>

<p>Plugin source location: <code>&lt;serge_root&gt;/lib/Serge/Engine/Plugin/metaparser.pm</code></p>

<p>This plugin can be used to parse different key-value file formats, in which each line can represent a comment, a key-value pair, or have keys and values following each other on separate lines. Examples of file formats that can be parsed this ways are: .ini, .inc, .properties, .dtd, and various associative array representations in different languages. Note that for some of the common formats Serge offers dedicated parser plugins, which might better support particular format intricacies and require no configuration.</p>

<p>Plugin exports a bunch of configuration parameters &mdash; regular expressions &mdash; used to identify lines with comments, split keys and values, reset comment context, join multiline strings, and so on. See the sample configuration file below for further documentation.</p>

<h2>Code Examples</h2>

<figure>
    <figcaption>example.ini</figcaption>
    <code class="block">; global comment
# another global comment
[section]

; <span class="hint">localization note</span>
<span class="hint">foo</span>=<span class="string">Foo</span>
<span class="hint">bar</span> = <span class="string">Bar</span>
; <span class="hint">localization note 2 line 1</span>
; <span class="hint">localization note 2 line 2</span>
<span class="hint">baz</span>= <span class="string">Baz</span>

[subsection]
# <span class="hint">comment</span>
<span class="hint">etc</span> =<span class="string">Etc\nEtc2\nEtc3</span>
</code>
</figure>

<h2>Usage</h2>

<figure>
    <figcaption>example-project.serge</figcaption>
    <script language="text/x-config-neat">
jobs
{
    :sample-job
    {
        parser
        {
            plugin               metaparser

            data
            {
                /*
                Parse .ini files
                */
                hint             ^\s*[;#]\s*(.*)\s*$        #    ; foo
                keyvalue         ^(\S+)\s*=\s*(.*)\s*$      #    foo = bar
                localize         ^(\S+\s*=\s*)(.*)(\s*)$
                reset            ^\s*$                      #    blank line
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
    <figcaption>multiparser-reference.serge</figcaption>
    <script language="text/x-config-neat">
jobs
{
    :sample-job
    {
        parser
        {
            plugin               metaparser

            data
            {
                /*
                Regular expression to detect a hint (comment) line.
                The first captured group is extracted as a hint
                (see how brackets work in regular expressions).

                Hint lines are accumulated and used as a multi-line
                hint string for the string that follows these comments.
                */
                hint             ^#\s*(.+)$

                /*
                Regular expression to detect a key-only line.
                The first captured group is extracted as a key value.

                Useful for file formats that have keys and values on
                different lines following each other.

                You should only use `key` and `value` regular expressions
                or one `keyvalue` expression.
                */
                key              ^KEY=(.*)$

                /*
                Regular expression to detect a value-only line.
                The first captured group is extracted as a string value.

                Useful for file formats that have keys and values on
                different lines following each other.

                You should only use `key` and `value` regular expressions
                or one `keyvalue` expression.
                */
                value            ^VALUE=(.*)$

                /*
                Regular expression to detect a key-value pair line.
                The first captured group is extracted as a key.
                The second captured group is extracted as a string value.

                Useful for file formats that have keys and values on the same
                line (this is try for the absoulte majority of localizable
                file formats).

                If you use `keyvalue` parameter, then you shouldn't use
                neither `key`, nor `value` ones.
                */
                keyvalue         ^(.*?)=(.*?)$

                /*
                Regular expression, which is a slight modification to the
                `value` or `keyvalue` regular expressions (depending on what
                you use for a particular format), used to split the line into
                three parts: prefix, localizable string, and suffix. The suffix
                part is optional, if empty. This regular expression is used
                to replace the original value with the translation.
                */
                localize         ^(.*?=)(.*?)$

                /*
                Regular expression to detect a context line.
                The first captured group is extracted as a context value.

                Context lines are not accumulated; the last value is exported
                with the translatable unit.
                */
                context          ^#\s*context:\s*(.+)$

                /*
                Regular expression to reset hint context. By default,
                accumulated hint lines are only reset after both key and value
                are detected. This regular expression can also be used to
                reset hints on e.g. blank lines or other section delimiters.
                */
                reset            ^\s*$

                /*
                Regular expression to detect a flag that tells parser to skip
                the following key-value entry (not export it for translation).
                */
                skip             ^#\s*skip\s*$

                /*
                Regular expression to join multi-line strings. This expression
                is applied against the entire source file before it is parsed,
                and all the occurrences of the matched strings are replaced with
                the empty value.
                */
                multiline        \$

                /*
                List of regular expressions to rewrite the string value before
                it is sent for translation. Each line contains three values:
                from, to, and regexp flags
                */
                unescape        &lt;    <  g
                unescape        &gt;    >  g
                unescape        &quot;  "  g
                unescape        &amp;   &  g

                /*
                List of regular expressions to rewrite the string value before
                it is sent for translation. Each line contains three values:
                from, to, and regexp flags
                */
                escape          &  &amp;   g
                escape          "  &quot;  g
                escape          >  &gt;    g
                escape          <  &lt;    g
            }
        }

        # other job parameters
        # ...
    }
}
</script>
</figure>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-footer.php') ?>