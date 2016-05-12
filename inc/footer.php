
        </div><!-- /content -->

        <div class="footer">
            <div class="copyright">
                &copy; 2014&ndash;<?php echo date("Y"); ?> <a href="//evernote.com/">Evernote Corporation</a>.<br/>
                All rights reserved.
            </div>
            <div class="license">
                Serge is licensed under Standard Perl License (dual <a href="http://dev.perl.org/licenses/gpl1.html">GPL</a> / <a href="http://dev.perl.org/licenses/artistic.html">Artistic License</a>)<br/>
                Serge.io website and Serge documentation are licensed under <a href="https://creativecommons.org/licenses/by/4.0/">CC BY 4.0</a>
            </div>
            <ul class="social-buttons">
                <li><iframe src="https://ghbtns.com/github-btn.html?user=evernote&amp;repo=serge&amp;type=watch&amp;count=true" allowtransparency="true" frameborder="0" scrolling="0" width="110" height="20"></iframe></li>
                <?php /*
                <li><div class="fb-like" data-href="https://serge.io/" data-width="120px" data-height="20px" data-layout="button_count" data-action="like"></div></li>
                <li><a href="https://twitter.com/share" class="twitter-share-button" data-url="http://serge.io/" data-dnt="true"></a></li>
                */ ?>
            </ul>
        </div>
    </div><!-- /wrapper -->

    <?php /*
    <!-- Facebook -->
    <script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
    <!-- /Facebook -->

    <!-- Twitter -->
    <script>
        !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';
        if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';
        fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');
    </script>
    <!-- /Twitter -->
    */ ?>

    <script src="/media/vendor/anchorjs/anchor.min.js"></script>
    <script>
        anchors.options = {
            placement: 'left',
            icon: '#'
        };
        anchors.add('h1, h2, h3, h4');
    </script>

    <!-- Google Analytics -->
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-285778-98', 'auto');
        ga('send', 'pageview');
    </script>
    <!-- /Google Analytics -->

    <script type="text/javascript" src="https://cdn.jsdelivr.net/docsearch.js/1/docsearch.min.js"></script>
    <script type="text/javascript">
        docsearch({
            apiKey: '5daa61caf4ab880c9c7b40e02da858da',
            indexName: 'serge',
            inputSelector: '#search',
            autocompleteOptions: {
                hint: false<?php /*,
                debug: true*/?>
            }
        });
    </script>
    <script src="/media/vendor/LinkToSelection.min.js"></script>
</body>
</html>