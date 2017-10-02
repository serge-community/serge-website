<?php
    $section = 'parser-plugins';
    $subpage = 'ref-plugin-parse_go';
    $title = '.Go String Map Parser Plugin';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');
?>

<h1><?php echo htmlspecialchars($title) ?></h1>

<p>Plugin source location: <code>&lt;serge_root&gt;/lib/Serge/Engine/Plugin/parse_go.pm</code></p>

<p>This plugin is used to parse key-value string pairs in native Go source files.</p>

<p>Plugin supports extracting one- or multi-line <code>// ...</code> style comments that go immediately above the key-value line. Also, plugin allows to specify the string context by appending <code>##<em>context</em></code> at the end of the key name (see the example below).</p>

<p>Supported string values are regular strings (enclosed in double quotes) and raw strings (enclosed in backticks). Regular strings can have Unicode symbols escaped as <code>\uNNNN</code> or bytes escaped as <code>\xNN</code>, according to Go specification. Raw strings can span multiple lines.</p>

<h2>Code Examples</h2>

<figure>
    <figcaption>strings.go</figcaption>
    <code class="block">package main

func init() {
	locpool.Resources["en"] = map[string]string{
        // <span class="hint">H1 Heading</span>
        "<span class="hint">WelcomeMessage</span>##<span class="context">title</span>": "<span class="string">Welcome!</span>",

        // <span class="hint">{NAME} is the name of the user</span>
        "<span class="hint">HelloUser</span>": "<span class="string">Hello, {NAME}!</span>",

        // <span class="hint">{X} is the number of files,</span>
        // <span class="hint">{Y} is the number of folders,</span>
        // <span class="hint">{COMMAND} in the ID of the command</span>
        "<span class="hint">XFilesFoundInYFolders</span>": `<span class="string">{X_PLURAL:{X} file|{X} files}
found in {Y_PLURAL:{Y} folder|{Y} folders}.
Do you want to {COMMAND:copy|move|delete} {X:them|it|them}?</span>`,

        //...
	}
}
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
            plugin                   parse_go
        }

        callback_plugins
        {
            # for the example strings.go file above, change the
            # language key name before saving the localized file
            :rewrite-language-key
            {
                plugin               replace_strings
                phase                before_save_localized_file

                data
                {
                    replace          `locpool\.Resources\["en`
                                     `locpool\.Resources\["%LANG%`
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
