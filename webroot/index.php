<?php
    $page = 'index';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/header.php');
?>

<a href="/docs/"><div class="graphic-bg"></div></a>
<div class="graphic"></div>

<div class="table">
    <div style="width: 360px; padding-right: 80px">
        <h1>Continuous Localization <nobr>Made Easy</nobr></h1>

        <p><strong>Serge</strong> (<strong>S</strong>tring <strong>E</strong>xtraction and <strong>R</strong>esource <strong>G</strong>eneration <strong>E</strong>ngine) is a continuous localization solution that allows you to configure robust localization automation scenarios in minutes, and integrate localization processes into your everyday development, content authoring and CI/CD workflows.</p>

        <p>Your team can focus on maintaining resource files in a single source language, and Serge will take care of keeping all localized resources in sync and translated, without relying on third-party systems.</p>

        <p>By means of writing platform-agnostic connectors, Serge can be used to enable continuous localization for any externally stored content: your marketing website, blog, CMS, help center, documentation, app store descriptions.</p>

        <p>Serge is used by large enterprises and smaller teams alike, helping them reach their global audiences without sacrificing the speed of product development.</p>

        <p><a href="/docs/" class="cta-button">Get Started</a></p>
    </div>

    <div>
        <h1>What problem does it solve?</h1>

        <p>When you decide to automate your localization process, you usually look at the proprietary automation APIs provided by a translation platform of your choice. This <em>last-mile</em> integration is what Serge does for you, providing the following benefits:</p>

        <ul>
            <li><strong>Ease of maintenance.</strong> Instead of writing custom scripts, you are writing configuration files (once) and rarely have to touch them again.</li>
            <li><strong>No vendor lock-in.</strong> Having Serge between your source code and an external translation platform system allows you to switch to another one anytime, keeping all your existing automation in place. <a href="/docs/third-party/translation-platforms/">Check out the list of supported translation platforms</a>.</li>
            <li><strong>Security.</strong> You will never have to give external TMS access to your code repository, and third parties will not see your original source files. Serge creates intermediate translation files that contain only the translatable content. There's no way for an external vendor to break your resource files, and you never have to deal with any merge conflicts.</li>
            <li><strong>Flexibility.</strong> You can easily deal with logical projects spawning multiple repositories and file formats.</li>
            <li><strong>Advanced localization workflows.</strong> With Serge, many things that were typically tricky to implement, are possible: multi-step localization with intermediate languages, simultaneous localization of multiple code branches, conditional file processing based on their contents, and so on.</li>
            <li><strong>Extensibility.</strong> With modular architecture, you're not limited to what one TMS has to offer; you can create custom parsers, synchronization plugins for other version control systems and TMS, while keeping the majority of your localization automation intact.</li>
        </ul>
    </div>
</div>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/footer.php') ?>
