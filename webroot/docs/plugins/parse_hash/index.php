<?php
    $section = 'parser-plugins';
    $subpage = 'ref-plugin-parse_hash';
    $title = 'Perl/PHP/Ruby Associative Array (Hash) Parser Plugin';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');
?>

<h1><?php echo htmlspecialchars($title) ?></h1>

<p>This plugin is used to parse associative arrays (aka hashes) in <code>'key' => 'value'</code> format which are used in Perl, PHP, and Ruby.</p>

<h2>Code Examples</h2>

<figure>
    <figcaption>Perl: example.pl</figcaption>
    <code class="block">my $localizations = {
    '<span class="hint">key1</span>' => '<span class="string">string</span>',
    '<span class="hint">key2</span>' => '<span class="string">string</span>',
    key3 => 'value', # barewords are not supported, skipped
    'key4' => 12345, # non-string values are not supported, skipped
    "key5" => "string", # double-quoted strings are not supported
    #...
};
</code>
</figure>

<figure>
    <figcaption>PHP: example.php</figcaption>
    <code class="block">$localizations = array(
    '<span class="hint">key1</span>' => '<span class="string">string</span>',
    '<span class="hint">key2</span>' => '<span class="string">string</span>',
    #...
);
</code>
</figure>

<figure>
    <figcaption>Ruby: example.rb</figcaption>
    <code class="block">localizations = {
    '<span class="hint">key1</span>' => '<span class="string">string</span>',
    '<span class="hint">key2</span>' => '<span class="string">string</span>',
    #...
}
</code>
</figure>

<p class="notice">Limitation: both key and value need to be encased in a single quotation mark symbols. Double-quoted strings or any other language-specific means to denote a string are not supported; symbols (in Ruby) or barewords (in Perl) are not supported, too. Neither supported are multi-line strings.</p>

<h2>Usage</h2>

<figure>
    <figcaption>example-project.serge</figcaption>
    <script language="text/x-config-neat">
jobs
{
    :sample-job
    {
        plugin               parse_hash

        # other job parameters
        # ...
    }
}
</script>
</figure>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-footer.php') ?>

