<?php
    $subpage = 'localization-server';
    $title = 'Localization Server';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');
?>

<h1>Localization Server</h1>

<p>Localization server is a server which continuously runs Serge and is configured to have proper access to your <a href="/docs/version-control/">version control</a> infrastructure. For example, for Git-based setups this means that you need to have Git properly configured there, with all the necessary public keys. If you decide to host a public-facing translation server software like <a href="http://pootle.translatehouse.org/">Pootle</a>, it will typically be the same server.</p>

<p>For better security, we recommend to setup a separate user to run localization-related scripts on behalf of.</p>

<p>Assuming your server runs under Linux-based OS, and your Serge configuration files are stored in e.g. <code>/usr/local/share/serge</code> folder, and the user is named <code>l10n</code>, a bare-bones setup would be to create a system-wide crontab file <code>/etc/cron.d/serge</code> with the following contents:</p>

<figure>
    <figcaption>/etc/cron.d/serge</figcaption>
    <code class="block wrap">*/5 * * * * l10n serge sync /usr/local/share/serge >/var/log/serge.log 2>&amp;1</code>
</figure>

<p>The cron job above will run every 5 minutes and try to launch a new Serge sync cycle for all configuration files in the specified directory.</p>

<p class="notice">Note: in the scenario above, one needs to make sure that only one copy of Serge is running at a time. This is why we're <em>overwriting</em> the same log file (<code>/var/log/serge.log</code>) — this file is locked exclusively, and thus the other instance will fail untill the previous copy finishes execution. If you want to <em>append</em> to a log instead, you need another approach to implement a 'one instance at a time' requirement (for example, use a wrapper script in a combination with <code>flock</code> utility).</p>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-footer.php') ?>
