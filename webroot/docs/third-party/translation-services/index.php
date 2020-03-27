<?php
    $subpage = 'third-party-ts';
    $title = 'Third-party Integrations: Translation Services';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');
?>

<h1><?php echo htmlspecialchars($title) ?></h1>

<p>While we highly recommend using Serge with <a href="https://evernote.github.io/zing/">Zing</a>, Evernote's own open-source translation platform, you can set it up to work with any other translation service or tool for as long as it meets the following criteria:</p>

<ol>
    <li>Provides a public API</li>
    <li>Works with resource files as a whole, not with their deltas. I.e. you should be able to create and update source resource files on the translation service, and then download full translated files back.</li>
</ol>

<p>Of course, each translation platform or tool is different, and the way they handle localization automation differs as well, so you may want to pilot your translation workflow with multiple systems before committing to a specific one. What's great about Serge is that you're no longer translation service-dependent, and it is much easier to change the tools as you go. Feel free to ask questions on translation platforms in our <a href="https://gitter.im/evernote-serge/general">Gitter chat</a>.</p>

<p>Below we have compiled a list of third-party translation service plugins that need to be installed separately.</p>

<h2>A collection of plugins from Dragos Varovici</h2>

<p>Repository: <a href="https://github.com/dragosv/serge-plugins">https://github.com/dragosv/serge-plugins</a></p>

<p>A prolific coder and an avid Serge enthusiast and contributor, Dragos has created an impressive set of plugins for the following services:</p>

<ul>
    <li><a href="https://crowdin.com/">Crowdin</a> (commercial)</li>
    <li><a href="https://lingohub.com/">LingoHub</a> (commercial)</li>
    <li><a href="https://locize.com/">Locize</a> (commercial)</li>
    <li><a href="https://lokalise.co/">Lokalise</a> (commercial)</li>
    <li><a href="https://www.mojito.global/">Mojito</a> (open-source)</li>
    <li><a href="https://phraseapp.com/">PhraseApp</a> (commercial)</li>
    <li><a href="https://www.transifex.com">Transifex</a> (commercial)</li>
    <li><a href="https://www.weblate.org">Weblate</a> (open-source)</li>
    <li><a href="https://zanata.org">Zanata</a> (open-source)</li>
</ul>

<p>Check out the repository above for the documentation and examples.</p>

<h2>Smartcat</h2>

<p>Repository: <a href="https://github.com/smartcatai/smartcat-serge-sync-plugin">https://github.com/smartcatai/smartcat-serge-sync-plugin</a></p>

<p><a href="https://smartcat.ai/">Smartcat</a> is the first commercial translation platform smart enough (pun intended!) to integrate with Serge and provide their own plugin. This integration has proven to be successful with their several most agile clients. Check out their <a href="https://www.smartcat.ai/blog/how-software-companies-can-set-up-continuous-localization-with-smartcat-serge-xsolla-case-study/">case study</a>.</p>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-footer.php') ?>

