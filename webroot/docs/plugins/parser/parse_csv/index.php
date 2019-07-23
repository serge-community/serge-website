<?php
    $section = 'parser-plugins';
    $subpage = 'ref-plugin-parse_csv';
    $title = 'CSV Parser Plugin';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');

    $available_since = '1.3';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/version-selector.php');
?>

<h1><?php echo htmlspecialchars($title) ?></h1>

<p>Plugin source location: <code>&lt;serge_root&gt;/lib/Serge/Engine/Plugin/parse_csv.pm</code></p>

<p>This plugin is used to parse CSV files. A CSV file must have column names listed as a first row, and these names are used to pick the right columns for key, string and, optionally, context and a comment. CSV can have other columns which will be ignored.</p>

<p>Plugin performs CSV validation. In case validation fails, the plugin can send an error report to specified recipients. If no email settings are provided, it will simply report the error in the console output.</p>

<p class="notice">This plugin depends on external Text::CSV_XS module. Run <code>cpan Text::CSV_XS</code> to install it before using this plugin.</p>

<h2>Example</h2>

<figure>
    <figcaption>strings.csv</figcaption>
    <code class="block">Key,String,Context,Comment
<span class="hint">ok_btn_caption</span>,<span class="string">OK</span>,<span class="context">button</span>,<span class="hint">This is a button caption</span>
<span class="hint">cancel_btn_caption</span>,<span class="string">Cancel</span>,<span class="context">button</span>,"<span class="hint">Button caption. Keep it short.</span>"
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
            plugin                   parse_csv

            data
            {
                /*
                (STRING) [OPTIONAL] Name of the column
                that stores string keys (IDs). Column
                names are taken from the first row.
                Default: Key
                */
                column_key           Key

                /*
                (STRING) [OPTIONAL] Name of the column
                that stores source strings. Column
                names are taken from the first row.
                Default: String
                */
                column_string        String

                /*
                (STRING) [OPTIONAL] Name of the column
                that stores context strings. Context
                strings themselves are optional. Column
                names are taken from the first row.
                Default: Context
                */
                column_context       Context

                /*
                (STRING) [OPTIONAL] Name of the column
                that stores comments (hints). Comments
                themselves are optional. Column
                names are taken from the first row.
                Default: Comment
                */
                column_comment       Comment

                /*
                (STRING) [OPTIONAL] End-of-line
                (row separator) char. It is unlikely
                that you will find a CSV that will
                have something beside a new line
                character.
                Default: <new line character>
                */
                end_of_line          `
`

                /*
                (STRING) [OPTIONAL] Column separator
                char. Limited to a single-byte character.
                Default: `,`
                */
                delimiter            `,`

                /*
                (STRING) [OPTIONAL] Quote char.
                The character to quote fields containing
                blanks or binary data. Limited to a
                single-byte character.
                Default: `"`
                */
                quote                `"`

                /*
                (STRING) [OPTIONAL] The character to
                escape certain characters inside
                quoted fields. Limited to a
                single-byte character.
                Default: `"`
                */
                escape               `"`

                /*
                (STRING) [OPTIONAL] Email to send
                error reports on behalf of
                */
                email_from           l10n-robot@acme.org

                /*
                (ARRAY) [OPTIONAL] One or more email
                addresses to send error reports to
                */
                email_to             engineer@acme.org
                                     project-manager@acme.org

                /*
                (STRING) [OPTIONAL] Email subject
                */
                email_subject        Errors found in CSV file
            }
        }

        # other job parameters
        # ...
    }
}
</script>
</figure>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-footer.php') ?>
