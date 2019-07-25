<?php
    $page = 'index';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/header.php');
?>

<div class="motto">Free, Open-Source Solution for Continuous Localization</div>
<a href="/docs/"><div class="graphic-bg"></div></a>
<div class="graphic"></div>

<div class="table">
    <div style="width: 410px; padding-right: 80px">
        <h1>In a Nutshell</h1>

        <p><strong style="cursor: help" title="'Serge' stands for 'String Extraction and Resource Generation Engine'">Serge</strong> helps you set up a seamless continuous localization process for your software in a fully automated and scalable fashion.</p>

        <p>It allows developers to concentrate on maintaining resource files in just one language (e.g. English), and will take care of keeping all localized resources in sync and translated.</p>

        <p>Serge is developed and maintained by <a href="http://evernote.com/">Evernote</a>, where it works non-stop to help deliver various Evernote clients, websites and marketing materials in 25 languages.</p>

        <p class="cta"><a href="/docs/">Learn more &rarr;</a></p>
    </div>

    <div style="width: 520px">
        <h1>Watch the Video</h1>

        <p>This is a recording of the presentation we did at IMUG meetup. It gives an overview of what Serge is and how you can use it in your team:</p>

        <p><iframe width="520" height="293" src="https://www.youtube.com/embed/bC3wECRgLog" frameborder="0" allowfullscreen="allowfullscreen"></iframe></p>
    </div>
</div>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/footer.php') ?>
