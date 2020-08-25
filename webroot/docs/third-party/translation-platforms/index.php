<?php
    $subpage = 'third-party-ts';
    $title = 'Translation Platforms';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');
?>

<h1><?php echo htmlspecialchars($title) ?></h1>

<p>Serge supports multiple translation services. You have a choice of self-hosted or managed translation platforms, free or commercial. Each translation platform or tool is different, and the way they handle localization automation differs as well, so you may want to pilot your translation workflows with different systems before committing to a specific one.</p>

<h2>Zing</h2>

<p><a href="https://evernote.github.io/zing/">Zing</a> is Evernote's own free open-source TMS/CAT tool, tailored to work with Serge. This is a self-hosted solution; no commercial support is provided. Zing plugin is included with Serge.</p>

<h2>Smartcat</h2>

<p><a href="https://smartcat.ai/">Smartcat</a> is a commercial translation platform integrated with Serge and supporting Serge as a part of their subscription. Smartcat plugin is included with Serge. Check out their case study:

<p class="notice"><a href="https://www.smartcat.ai/blog/how-software-companies-can-set-up-continuous-localization-with-smartcat-serge-xsolla-case-study/">How software companies can set up continuous localization with Smartcat & Serge: Xsolla case study</a></p>

<h2>Third-party Plugins</h2>

<p>Plugins repository: <a href="https://github.com/dragosv/serge-plugins">https://github.com/dragosv/serge-plugins</a></p>

<p>Dragos Varovici, an independent contributor, created a list of plugins for the following translation platforms:</p>

<ul>
    <li><strong>Crowdin</strong> (commercial)</li>
    <li><strong>LingoHub</strong> (commercial)</li>
    <li><strong>Locize</strong> (commercial)</li>
    <li><strong>Lokalise</strong> (commercial)</li>
    <li><strong>Mojito</strong> (open-source)</li>
    <li><strong>Phrase</strong> (commercial)</li>
    <li><strong>Transifex</strong> (commercial)</li>
    <li><strong>Weblate</strong> (open-source)</li>
    <li><strong>Zanata</strong> (open-source)</li>
</ul>

<p>Check out the repository above for the documentation and examples.</p>

<h2>Adding Support For Other Platforms</h2>

<p>Serge is an open platform, which means you can set it up to work with any other translation service or tool for as long as it meets the following criteria:</p>

<ol>
    <li>Provides a public remotely accessible API or a command-line interface.</li>
    <li>Works with "permanent" projects, not job-based ones. You should be able create a project once and then modify it at will by adding, removing, or re-uploading modified resource files.</li>
</ol>

<p>Your contributions are welcome!</p>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-footer.php') ?>

