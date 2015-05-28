<?php
    $subpage = 'translation-service';
    $title = 'Translation Service';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');
?>

<h1>Integration with External Translation Services</h1>

<p>A part of Serge's <a href="/docs/localization-cycle/">localization+sync cycle</a> is a two-way synchronization with an external translation service. Specifically, two steps, <code><a href="/docs/help/serge-pull-po/">pull-po</a></code> and <code><a href="/docs/help/serge-push-po/">push-po</a></code>, are used to get translated .po files from an push these files back to external translation service.</p>

<p>A translation service can potentially be:</p>

<ul>
    <li>An external localization vendor that allows uploading and downloading files through their proprietary API</li>
    <li>A self-hosted or SaaS translation platform that can leverage the use of crowdsourcing (volunteers) or paid translators</li>
    <li>A simple storage for .po files shared with external translators (for offline translation)</li>
</ul>

<p>Such functionality is realized by the means of &lsquo;translation service plugins&rsquo;, which need to know how to send a specified directory of .po files to an external service and how to get the files back into file system.</p>

<p>Serge comes with the ready-to use plugin for <a href="http://pootle.translatehouse.org/">Pootle</a> — a free open-source online translation server software (which we use <a href="https://translate.evernote.com/">at Evernote</a> with little modifications). You can use plugin's code (located in <code>&lt;serge_root&gt;/lib/Serge/Sync/Plugin/TranslationService/pootle.pm</code>) as a reference implementation for your own plugins.</p>

<p>Note that Serge is very flexible when it comes to <a href="/docs/configuration-files/">configuration</a>. You can send select translation projects to a localization vendor, while using crowdsourcing service to translate the rest.</p>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-footer.php') ?>
