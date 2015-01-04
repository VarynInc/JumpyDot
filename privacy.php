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

        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
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
                <h1>Privacy Policy</h1>
                <p>This document sets forth the Jumpy Dot, LLC Online Privacy Policy (the Privacy Policy) for this web site, www.Jumpy Dot, LLC.com (the Site).
                    If you have objections to the Privacy Policy, you should not access or use this Site.
                    The Privacy Policy is subject to change and was last updated on 15-Nov-2014.</p>
                <h5>Collection of Personal Information</h5>
                <p>As a visitor to this Site, you can engage in many activities without providing any personal information. In connection with other activities, Jumpy Dot, LLC may ask you to provide certain information about yourself by filling out and submitting an online form. It is completely optional for you to engage in these activities. If you elect to engage in these activities, however, Blacuburst may ask that you provide us personal information, such as your first and last name, e-mail address, and other personal information. When ordering products or services on the Site, you may be asked to provide a credit card number. Depending upon the activity, some of the information that we ask you to provide is identified as mandatory and some as voluntary. If you do not provide the mandatory data with respect to a particular activity, you will not be able to engage in that activity. </p>
                <p>When you use the Site, Jumpy Dot, LLC or third parties authorized by Jumpy Dot, LLC may also collect certain technical and routing information about your computer to facilitate your use of the Site and its services. For example, we may log environmental variables, such as browser type, operating system, CPU speed, and the Internet Protocol ("IP") address of your computer. We use these environmental variables to facilitate and track your use of the Site and its services. Jumpy Dot, LLC also uses such environmental variables to measure traffic patterns on the Site. Without expressly informing you in each particular circumstance, we do not match such information with any of your personal information. </p>
                <p>When you submit personal information to Jumpy Dot, LLC through this Site, you understand and agree that this information may be transferred across national boundaries and may be stored and processed in any of the countries in which Jumpy Dot, LLC and its affiliates and subsidiaries maintain offices, including without limitation, the United States. You also acknowledge that in certain countries or with respect to certain activities, the collection, transferring, storage and processing of your information may be undertaken by trusted vendors of Jumpy Dot, LLC. Such vendors are bound by contract to not use your personal information for their own purposes or provide it to any third parties.</p>
                <h5>How your Personal Information is Used</h5>
                <p>Jumpy Dot, LLC  may collect information about the use of the Site; such as the types of services used and how many users we receive daily. This information is collected in aggregate form, without identifying any user individually. Jumpy Dot, LLC may use this aggregate, non-identifying statistical data for statistical analysis, marketing or similar promotional purposes. </p>
                <h5>Your Choices with Respect to Personal Information</h5>
                <p>Jumpy Dot, LLC recognizes and appreciates the importance of responsible use of information collected on this Site. Without your consent, Jumpy Dot, LLC will not communicate any information to you regarding products, services and special offers available from Jumpy Dot, LLC, although we may find it necessary to communicate with you regarding your use of the services on this Site. Except in the particular circumstances described in this Privacy Policy, Jumpy Dot, LLC will also not provide your name to other companies or organizations without your consent. </p>
                <p>There are other instances in which Jumpy Dot, LLC may divulge your personal information. Jumpy Dot, LLC may provide your personal information if necessary, in Jumpy Dot, LLC's good faith judgment, to comply with laws or regulations of a governmental or regulatory body or in response to a valid subpoena, warrant or order or to protect the rights of Jumpy Dot, LLC or others. </p>
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