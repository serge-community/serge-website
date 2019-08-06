<?php
    $subpage = 'localization-server';
    $title = 'Localization Server';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');
?>

<h1>Localization Server</h1>

<p>Localization server is a server which continuously runs Serge and is configured to have proper access to your <a href="/docs/version-control/">version control</a> infrastructure. For example, for Git-based setups this means that you need to have Git properly configured there, with all the necessary public keys. If you decide to host a public-facing translation server software like <a href="/docs/guides/zing/">Zing</a>, it will typically be the same server.</p>

<p>For better security, we recommend to setup a separate user to run localization-related scripts on behalf of.</p>

<p>Assuming your server runs under Unix-based OS, and your Serge configuration files are stored in e.g. <code>/var/serge/data/configs</code> folder (see <a href="/docs/organizing-your-data/">Organizing your data</a>), a bare-bones setup would be to create a simple wrapper script, <code>/usr/local/bin/serge-endless-sync</code>, that will run the localization in an endless loop, like this:</p>

<figure>
    <figcaption>/usr/local/bin/serge-endless-sync</figcaption>
    <code class="block"><span class="cm-comment">#!/bin/bash</span>
<span class="cm-keyword">while :</span>
<span class="cm-keyword">do</span>
    <span class="cm-comment"># run the localization cycle (and rewrite the log)</span>
    serge sync /var/serge/data/configs >/var/log/serge.log 2>&amp;1

    <span class="cm-comment"># clean up orphaned translation interchange files (and append to the log)</span>
    serge clean-ts /var/serge/data/configs >>/var/log/serge.log 2>&amp;1

    <span class="cm-keyword">echo</span> "Waiting 10 seconds till the next cycle. Press [Ctrl+C] to stop..."
    <span class="cm-keyword">sleep</span> 10
<span class="cm-keyword">done</code>
</figure>

<p>For testing purposes, you can run this script directly from the command line. In the actual production environment, you will need to run it as a daemon so that it starts automatically after system reboot. You may also want to add some log rotation instead of rewriting the <code>/var/log/serge.log</code> file on each cycle.</p>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-footer.php') ?>
