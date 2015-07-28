<?php
    $subpage = 'translation-service';
    $title = 'Translation Service';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');
?>

<h1>Integration with External Translation Services</h1>

<p>A part of Serge's <a href="/docs/localization-cycle/">localization cycle</a> is a two-way synchronization with an external translation service. Serge automatically pulls translated .po files from external translation service and pushes updated .po files back.</p>

<p>A translation service can potentially be:</p>

<ul>
    <li>An external localization vendor that allows uploading and downloading files through their proprietary API</li>
    <li>A self-hosted or SaaS translation platform that can leverage the use of crowdsourcing (volunteers) or paid translators</li>
    <li>A simple storage for .po files shared with external translators (for offline translation)</li>
</ul>

<p>Such functionality is realized by the means of <a href="/docs/plugins/ts/<?php echo $ts_plugins[0] ?>">translation service plugins</a>, which need to know how to send a specified directory of .po files to an external service and how to get the files back into file system.</p>

<p>At Evernote, we use Serge in a combination with <a href="http://pootle.translatehouse.org/">Pootle</a> — a free open-source online translation server software that you can host on your translation server.</p>

<p>Note that Serge is very flexible when it comes to <a href="/docs/configuration-files/">configuration</a>. You can send select translation projects to a localization vendor, while using crowdsourcing service to translate the rest.</p>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-footer.php') ?>
