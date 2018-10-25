<?php
require_once('procs/common.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>JumpyDot: Play. Anywhere.</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Access-Control-Allow-Origin" content="*">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="expires" content="0" />
    <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
    <meta http-equiv="pragma" content="no-cache" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="mobile-web-app-capable" content="yes" />
    <meta name="description" content="At Jumpy Dot, we are building games for the masses – we aim for content that is fun for all ages and technology that performs on all the most popular platforms. Cross platform friendly technologies have created an opportunity to re-invent online games for an audience that moves seamlessly between computers, tablets, and smart-phones.">
    <meta name="author" content="JumpyDot">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/carousel.css" rel="stylesheet">
    <link href="/css/jumpydot.css" rel="stylesheet">
    <link rel="icon" href="/favicon.ico">
    <link rel="icon" type="image/png" href="/favicon-48x48.png" sizes="48x48"/>
    <link rel="icon" type="image/png" href="/favicon-196x196.png" sizes="196x196">
    <link rel="icon" type="image/png" href="/favicon-160x160.png" sizes="160x160">
    <link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96">
    <link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
    <link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
    <link rel="apple-touch-icon" href="/apple-touch-icon-60x60.png" sizes="60x60"/>
    <link rel="apple-touch-icon" href="/apple-touch-icon-72x72.png" sizes="72x72"/>
    <link rel="apple-touch-icon" href="/apple-touch-icon-76x76.png"/>
    <link rel="apple-touch-icon" href="/apple-touch-icon-76x76.png" sizes="76x76"/>
    <link rel="apple-touch-icon" href="/apple-touch-icon-114x114.png" sizes="114x114"/>
    <link rel="apple-touch-icon" href="/apple-touch-icon-120x120.png" sizes="120x120"/>
    <link rel="apple-touch-icon" href="/apple-touch-icon-152x152.png" sizes="152x152"/>
    <link rel="shortcut icon" href="/favicon-196x196.png">
    <meta property="fb:app_id" content="" />
    <meta property="og:title" content="JumpyDot: Play. Anywhere.">
    <meta property="og:url" content="http://www.jumpydot.com">
    <meta property="og:site_name" content="JumpyDot">
    <meta property="og:description" content="At Jumpy Dot, we are building games for the masses – we aim for content that is fun for all ages and technology that performs on all the most popular platforms. Cross platform friendly technologies have created an opportunity to re-invent online games for an audience that moves seamlessly between computers, tablets, and smart-phones.">
    <meta property="og:image" content="http://www.jumpydot.com/images/1200x900.png"/>
    <meta property="og:image" content="http://www.jumpydot.com/images/sitelogo-1024.png"/>
    <meta property="og:image" content="http://www.jumpydot.com/images/1200x600.png"/>
    <meta property="og:image" content="http://www.jumpydot.com/images/600x600.png"/>
    <meta property="og:image" content="http://www.jumpydot.com/images/2048x1536.png"/>
    <meta property="og:type" content="game"/>
    <meta name="twitter:card" content="photo"/>
    <meta name="twitter:site" content="@jumpydot"/>
    <meta name="twitter:creator" content="@jumpydot"/>
    <meta name="twitter:title" content="JumpyDot: Play. Anywhere."/>
    <meta name="twitter:image:src" content="http://www.jumpydot.com/images/600x600.png"/>
    <meta name="twitter:domain" content="jumpydot.com"/>
    <script src="js/head.min.js"></script>
    <script type="text/javascript">

        head.ready(function() {
            initApp();
        });
        head.js("js/modernizr.custom.74056.js", "/js/jquery.min.js", "/js/bootstrap.min.js", "/js/ie10-viewport-bug-workaround.js", "/js/common.js", "/js/enginesis.js", "/js/ShareHelper.js");

        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
        ga('create', 'UA-55025061-1', 'auto');
        ga('send', 'pageview');
    </script>
</head>
<body>
<div class="navbar-wrapper">
    <div class="container">
        <nav class="navbar navbar-default navbar-static-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/"><img src="/images/logosmall.png" border="0" /></a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="/">Home</a></li>
                        <li><a href="/allgames.php">All Games</a></li>
                        <li><a href="/coupons.php">Coupons &amp; Offers</a></li>
                        <li><a href="/blog/?page_id=48">Blog</a></li>
                        <li><a href="/blog/#our-team">About</a></li>
                    </ul>
                    <form class="navbar-form navbar-right" role="search" method="GET" action="/allgames.php">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Search" name="q">
                        </div>
                        <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                    </form>
                </div>
            </div>
        </nav>
    </div>
</div><!-- /.navbar-wrapper -->
<div class="container marketing">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1>Terms of Use</h1>
                <h5>Acceptance of Terms</h5>
                <p>Welcome to the web site (the "Site") of Jumpy Dot LLC ("Jumpy Dot"). On this web site, Jumpy Dot makes available to you a wide range of information, software, products, downloads, documents, communications, files, text, graphics, publications, content, and services. The Terms of Use are subject to change. This document was last updated on 15-Nov-2014.
                    PLEASE READ THE TERMS OF USE CAREFULLY BEFORE USING THIS WEBSITE. By accessing and using this web site in any way, including, without limitation, browsing the web site, using any information, using any content, using any services, downloading any materials, and/or placing an order for products or services, you agree to and are bound by the terms of use described in this document ("Terms of Use"). IF YOU DO NOT AGREE TO ALL OF THE TERMS AND CONDITIONS CONTAINED IN THE TERMS OF USE, DO NOT USE THIS WEBSITE IN ANY MANNER. The Terms of Use are entered into by and between Jumpy Dot and you. If you are using the web site on behalf of your employer, you represent that you are authorized to accept these Terms of Use on your employer's behalf. Jumpy Dot reserves the right, at Jumpy Dot's sole discretion, to change, modify, update, add, or remove portions of the Terms of Use at any time without notice to you. Please check these Terms of Use for changes. Your continued use of this web site following the posting of changes to the Terms of Use will mean you accept those changes.</p>
                <h5>Use of Materials Limitations</h5>
                <p>All materials contained in the web site are the copyrighted property of Jumpy Dot, its subsidiaries, affiliated companies and/or third-party licensors. All trademarks, service marks, and trade names are proprietary to Jumpy Dot, or its subsidiaries or affiliated companies and/or third-part licensors.
                    Unless otherwise specified, the materials and services on this web site are for your personal and non-commercial use, and you may not modify, copy, distribute, transmit, display, perform, reproduce, publish, license, create derivative works from, transfer, or sell any information, software, products or services obtained from the web site without the written permission from Jumpy Dot.</p>
                <h5>Privacy Policy</h5>
                <p>Jumpy Dot's Privacy Policy can be found at www.jumpydot.com/Privacy.php.</p>
                <h5>No Unlawful or Prohibited Use</h5>
                <p>As a condition of your use of the web site, you will not use the web site for any purpose that is unlawful or prohibited by these terms, conditions, and notices. You may not use the Services in any manner that could damage, disable, overburden, or impair any Jumpy Dot server, or the network(s) connected to any Jumpy Dot server, or interfere with any other party's use and enjoyment of the web site You may not attempt to gain unauthorized access to services, materials, other accounts, computer systems or networks connected to any Jumpy Dot server or to the web site, through hacking, password mining or any other means. You may not obtain or attempt to obtain any materials or information through any means not intentionally made available through the web site.</p>
                <h5>Copyright and Trademark Information</h5>
                <p>COPYRIGHT NOTICE: Copyright &copy; 2015 Jumpy Dot, LLC., All Rights Reserved.</p>
                <p>Third-party trademarks are used solely for distributing the games herein and no license or affiliation is implied. All copyrights are held by the respective owners.</p>
            </div>
        </div>
    </div>
    <hr/>
    <footer>
        <div class="panel panel-default">
            <div class="panel-heading">
                <span class="pull-left"><img src="/images/logosmall.png" border="0"/></span>
                <p class="pull-right"><a href="#">Back to top</a></p>
                <div class="social">
                    <ul>
                        <li><a href="http://www.facebook.com/jumpydot" title="Follow JumpyDot on Facebook"><div class="facebook sprite"></div></a></li>
                        <li><a href="http://twitter.com/@jumpydot" title="Follow JumpyDot on Twitter"><div class="twitter sprite"></div></a></li>
                        <li><a href="https://plus.google.com/b/113355649232770457323" title="Follow JumpyDot on Google Plus"><div class="gplus sprite"></div></a></li>
                        <li><a href="https://www.linkedin.com/company/jumpy-dot" title="Follow JumpyDot on LinkedIn"><div class="linkedin sprite"></div></a></li>
                        <li><a href="http://www.youtube.com/channel/UC45mWPk8hgiOuEu_b9LFggA" title="Follow JumpyDot on YouTube"><div class="youtube sprite"></div></a></li>
                        <li><a href="http://www.pinterest.com/jumpydot/jumpydot-games/" title="Follow JumpyDot on Pinterest"><div class="pinterest sprite"></div></a></li>
                    </ul>
                </div> <!-- end social -->
                <div id="footer-nav" class="text-center"><span class="glyphicon glyphicon-eye-open"></span> <a href="/privacy.php">Privacy</a> <span class="glyphicon glyphicon-info-sign"></span> <a href="/tos.php">Terms</a>  <span class="glyphicon glyphicon-question-sign"></span> <a href="/blog/#our-team">About JumpyDot</a> <span class="glyphicon glyphicon-comment"></span> <a href="/blog/#contact">Contact</a></div>
                <div><p style="font-size: smaller;"><br/>
                        At Jumpy Dot, we are building games for the masses – we aim for content that is fun for all ages and technology that performs on all the most popular platforms. Cross platform friendly technologies have created an opportunity to re-invent online games for an audience that moves seamlessly between computers, tablets, and smart-phones. Jumpy Dot aims to take advantage of that flow, creating games that play anywhere.
                        If you have a game you would like to see featured on our site please contact us using the <a href="/blog/#contact">contact form</a>.
                    </p></div>
                <div class="nav navbar-inline">
                    <ul>
                        <li><a href="/">Home</a></li>
                        <li><a href="/allgames.php">All Games</a></li>
                        <li><a href="/coupons.php">Coupons &amp; Offers</a></li>
                        <li><a href="/blog/?page_id=48">Blog</a></li>
                        <li><a href="/blog/#our-team">About</a></li>
                    </ul>
                </div>
                <p class="copyright small text-center">Copyright &copy; 2015 Jumpy Dot, LLC</p>
            </div>
        </div>
    </footer>
</div><!-- /.container -->
</body>
</html>