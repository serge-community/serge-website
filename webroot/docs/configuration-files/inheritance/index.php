<?php
    $section ='config-files';
    $subpage = 'ref-config-inheritance';
    $title = 'Configuration File Inheritance';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');
?>

<h1>Configuration File Inheritance</h1>

<p>As you will later see from <a href="/docs/configuration-files/reference/">Serge configuration file reference</a>, there are many configuration parameters that are likely to be shared among different localization jobs. So if you're using Serge to localize more than one simple project with files of just one type, then you're going to have multiple configuration files, and it makes sense to externalize common settings and reference them in multiple places.</p>

<p>Serge configuration files support a powerful way to externalize common settings, and then inherit and override them at any level of your configuration tree. Consider the following example:</p>

<figure>
    <figcaption>example-project.serge</figcaption>
    <script language="text/x-config-neat">
inc
{
    job-common
    {
        parameter1      value 1
        parameter2      value 2
        parameter3      foo bar
    }
}

jobs
{
    # first job
    {
        @inherit        .#inc/job-common

        parameter2      new value
        parameter4      value 4
    }

    # second job
    {
        @inherit        .#inc/job-common

        -parameter2
        -parameter3

        parameter4      value 4
    }

    # third job
    {
        @inherit        .#inc/job-common

        +parameter3     baz etc
    }
}
</script>
</figure>

<p>Here, the <code>@inherit</code> directive tells which settings to inherit the current block structure from. <code>.#inc/common</code> indicates that we need to take the current configuration file (<code>.</code>) and search for <code><nobr>inc &rarr; job-common</nobr></code> block in it, then use its contents to populate the block that contains the <code>@inherit</code> directive, then apply overrides described in that block.</p>

<p>Adding a minus sign before any parameter name (for example, <code>-parameter2</code>) removes the parameter. Similarly, adding a plus sign (e.g., <code>+parameter3</code>) treats the value as an array, and appends the new value to the end of that array.</p>

<p>While Serge files allow you to contain an <code>inc</code> block where you can keep your common includes, you can also externalize them into a separate file (and this file can have any arbitrary structure):</p>

<figure>
    <figcaption>common.serge.inc</figcaption>
    <script language="text/x-config-neat">
job-common
{
    parameter1      value 1
    parameter2      value 2
    parameter3      foo bar
}
</script>
</figure>

<figure>
    <figcaption>example-project.serge</figcaption>
    <script language="text/x-config-neat">
jobs
{
    # first job
    {
        @inherit        common.serge.inc#job-common

        parameter2      new value
        parameter4      value 4
    }

    # second job
    {
        @inherit        common.serge.inc#job-common

        -parameter2
        -parameter3

        parameter4      value 4
    }

    # third job
    {
        @inherit        common.serge.inc#job-common

        +parameter3     baz etc
    }
}
</script>
</figure>

<p>Given the example above, once all inheritance instructions are applied, the structure of example-project.serge file will be interpreted by Serge as following:</p>

<figure>
    <figcaption>example-project.serge</figcaption>
<script language="text/x-config-neat">
jobs
{
    # first job
    {
        parameter1      value 1
        parameter2      new value
        parameter3      foo bar
        parameter4      value 4
    }

    # second job
    {
        parameter1      value 1
        parameter4      value 4
    }

    # third job
    {
        parameter1      value 1
        parameter2      value 2
        parameter3      foo bar baz etc
    }
}
</script>
</figure>

<h2>Multiple Inheritance</h2>

<p>The <code>@inherit</code> directive allows one to specify more than one block reference. Each block is interpreted from left to right (the first inherited block structure is applied, then the second one, and so on). Each next inherited block overrides settings accumulated previously. This allows you to have some global settings in a separate file, then some common local setting defined in a particular configuration file that may override global settings. Consider the example below:</p>

<figure>
    <figcaption>common.serge.inc</figcaption>
    <script language="text/x-config-neat">
job-common
{
    parameter1      value 1
    parameter2      value 2
    parameter3      foo bar
}
</script>
</figure>

<figure>
    <figcaption>example-project.serge</figcaption>
<script language="text/x-config-neat">
inc
{
    job-common
    {
        parameter1      local value 1
        parameter2      local value 2
    }
}

jobs
{
    # first job
    {
        @inherit        common.serge.inc#job-common .#inc/job-common
        parameter1      job-specific value 1
        parameter4      value 4
    }
}
</script>
</figure>

<p>Given these two files, the resulting interpreted structure will be:</p>

<figure>
    <figcaption>example-project.serge</figcaption>
<script language="text/x-config-neat">
inc
{
    job-common
    {
        parameter1      local value 1
        parameter2      local value 2
    }
}

jobs
{
    # first job
    {
        parameter1      job-specific value 1
        parameter2      local value 2
        parameter3      foo bar
        parameter4      value 4
    }
}
</script>
</figure>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-footer.php') ?>
