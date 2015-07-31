<?php
    $section ='config-files';
    $subpage = 'ref-config-syntax';
    $title = 'Configuration File Syntax';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');
?>

<h1>Configuration File Syntax</h1>

<p>These are the main highlights of the configuration files used in Serge:</p>
<ul>
    <li>Clean, easy-to read syntax</li>
    <li>Flexible inheritance/override mechanism to reuse common settings</li>
    <li>Ability to reference environment variables (reuse the same configuration files in multiple scenarios)</li>
    <li>Schema-based config file validation</li>
</ul>

<p class="notice">Internally, Serge uses <a href="https://github.com/iafan/Config-Neat">Config::Neat</a> library that implements this format, so you can always use its own documentation as an additional source of information about the format and its implementation details.</p>

<h2>Tree Structure</h2>

<p>Serge configuration file represents a tree structure. There can be sections, nested sub-sections, and parameter-value definitions on each level. Sections are denoted with curly braces. Everything between <code>{</code> and <code>}</code> is considered an inner structure of the section. Section and parameter names technically can consist of any characters except whitespace.</p>

<script language="text/x-config-neat">
section
{
    parameter1          value 1

    subsection
    {
        parameter2      value 2
        parameter3      value 3
    }
}
</script>

<h2>Arrays of Objects</h2>

<p>Some sections have an empty name (you can treat these structures as <em>arrays of objects</em>). Consider the following structure, which defines an array of jobs:</p>

<script language="text/x-config-neat">
jobs
{
    {
        # job 1 parameters
        # ...
    }

    {
        # job 2 parameters
        # ...
    }
}
</script>

<p>For such array entries that originally don't have a name, one can still provide <em>labels</em>: names that start with a colon. Such labels can later help you override parts of the config:</p>

<script language="text/x-config-neat">
jobs
{
    :job1
    {
        # job 1 parameters
        # ...
    }

    :job2
    {
        # job 2 parameters
        # ...
    }
}
</script>

<h2>Comments</h2>

<p>In addition to single-line comments starting with <code>#</code>, one can define multi-line comments with <code>/*</code> and <code>*/</code>:</p>

<script language="text/x-config-neat">
# single-line comment

parameter1      value 1 # single-line comment

/*
    This is a sample
    multi-line comment
*/
parameter2      value 2
</script>

<h2>Boolean Values</h2>

<p>Boolean parameters are defined as <code>YES</code> or <code>NO</code>:</p>

<script language="text/x-config-neat">
parameter1      YES
parameter2      NO
</script>

<p>You can omit 'YES' value altogether, and use just the paramater name as a flag. The example below is identical to the one above:</p>

<script language="text/x-config-neat">
parameter1      # no value means 'YES'
parameter2      NO
</script>

<h2>Strings</h2>

<p>String parameters generally don't have to be wrapped into any quotes. But if the string has leading or trailing spaces, or multiple spaces in between, the string needs to be wrapped with <code>`</code> symbols (<em>verbatim quotes</em>):</p>

<script language="text/x-config-neat">
# The following string value evaluates to 'This is a string':
parameter1      This is a string

# The following string value also evaluates to 'This is a string',
# because whitespace is normalized by default:
parameter2      This is    a   string

# The following string value evaluates to 'This is    a   string  ',
# because the string is enclosed in verbatim quotes:
parameter3      `This is    a   string  `
</script>

<p>If the string is long, it can spawn multiple lines, provided all lines start at the same character position as the first line. Since whitespace is normalized by default, each line break and its surrounding spaces will be converted to a single space:</p>

<script language="text/x-config-neat">
parameter1      Localization is the process of adapting
                a product or content to a specific locale
                or market.
</script>

<h2>Arrays of Strings</h2>

<p>Arrays of strings are defined the same way as strings. It's config schema that internally decides whether to treat a parameter as a string or array. Array items are separated by whitespace. If any array item needs to have space in between, or evaluate to a space or an empty value, use verbatim quotes:</p>

<script language="text/x-config-neat">
# The following evaluates to ('This', 'is', 'an', 'array'):
parameter1      This is an array

# The following also evaluates to ('This', 'is', 'an', 'array')
# because whitespace is normalized by default:
parameter2      This is    an   array

# The following evaluates to ('This', 'is an', 'array', ''):
parameter3      This `is an` array ``

# The following evaluates to ('This is an array'):
parameter4      `This is an array`
</script>

<p>Arrays, like strings, can also spawn multiple lines:</p>

<script language="text/x-config-neat">
languages       ar bn ca cs da de el es et eu fi fr ga gl he
                hr hu id it ja ko lv ms nl no pl pt pt-br ro
                ru sh sl sr sv th tr uk vi zh-cn zh-tw
</script>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-footer.php') ?>
