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
    <script src="/js/head.min.js"></script>
    <script type="text/javascript">

        head.ready(function() {
            initApp();
        });
        head.js("/js/modernizr.custom.74056.js", "/js/jquery.min.js", "/js/bootstrap.min.js", "/js/ie10-viewport-bug-workaround.js", "/js/common.js", "/js/enginesis.js", "/js/ShareHelper.js");

        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
        ga('create', 'UA-55025061-1', 'auto');
        ga('send', 'pageview');

        function initApp() {
            window.EnginesisSession = enginesis(<?php echo($siteId);?>, 0, 0, '-l', '', '', 'en', enginesisCallBack);
        }

        function showSubscribePopup () {
            var popup = document.getElementById("popupScrim"),
                subscribeFrame = document.getElementById("popupFrame");

            if (popup != null && subscribeFrame != null) {
                popup.style.display = 'block';
                subscribeFrame.style.display = 'block';
            }
        }

        function hideSubscribePopup () {
            var popup = document.getElementById("popupScrim"),
                subscribeFrame = document.getElementById("popupFrame");

            if (popup != null && subscribeFrame != null) {
                popup.style.display = 'none';
                subscribeFrame.style.display = 'none';
            }
        }

        function setPopupMessage (message, className) {
            var messageElement = document.getElementById("popupMessageArea"),
                messageArea = document.getElementById("popupMessageResponse");
            if (messageElement != null && messageArea != null) {
                messageElement.style.display = 'block';
                messageArea.style.display = 'block';
                messageArea.innerText = message;
                if (className != null) {
                    messageArea.className = className;
                }
            }
        }

        function popupCloseClicked () {
            hideSubscribePopup();
            setPopupMessage("", "popupMessageResponseOK");
        }

        function popupSubscribeClicked () {
            var email = document.getElementById("emailInput").value;
            if (isValidEmail(email)) {
                setPopupMessage("Subscribing " + email + " with the server...", "popupMessageResponseOK");
                EnginesisSession.newsletterAddressAssign(email, '', '', '2', null); // the newsletter category id for JumpyDot/General is 2
            } else {
                setPopupMessage("Your email " + email + " looks bad. Can you try again?", "popupMessageResponseError");
            }
        }

        function enginesisCallBack (enginesisResponse) {
            var succeeded,
                errorMessage;

            if (enginesisResponse != null && enginesisResponse.fn != null) {
                succeeded = enginesisResponse.results.status.success;
                errorMessage = enginesisResponse.results.status.message;
                switch (enginesisResponse.fn) {
                    case "NewsletterAddressAssign":
                        if (succeeded == 1) {
                            setPopupMessage("You are subscribed - Thank you!", "popupMessageResponseOK");
                            window.setTimeout(hideSubscribePopup, 2000);
                        } else {
                            setPopupMessage("Server reports an error: " + errorMessage, "popupMessageResponseError");
                        }
                        break;
                    default:
                        break;
                }
            }
        }

    </script>
</head>
<body>
<div id="popupScrim">
    <div id="popupFrame">
        <div class="popupCloseButton" onclick="JavaScript:popupCloseClicked();"><img src="/images/CloseButton.png" width="24" height="24" border="0"/></div>
        <img src="/images/JumpyDotBallIcon120x120.png" class="logoImg">
        <h3>Join Our Mailing List?</h3>
        <p>Sign up for email updates and we will let you know when we have new games, prizes, interesting things to say. We will not abuse this privilege.</p>
        <div class="popupFieldGroup">
            <input type="email" name="email" class="required email" id="emailInput" placeholder="Your email address"/><input type="submit" value="Subscribe" name="subscribe" id="subscribeButton" class="button"  onclick="popupSubscribeClicked();"/>
        </div>
        <div id="popupMessageArea">
            <div id="popupMessageResponse" class="popupMessageResponseError">This is the response from the server</div>
        </div>
    </div>
</div>
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
<div class="container top-promo-area">
    <div class="row">
        <div id="Missing" class="col-sm-8">
            <h2>System Error</h2>
            <p>Something went wrong and our code could not handle your request. It could be a bug or it could be a system fault. We should check our logs soon.</p>
            <p>Please feel free to try again, but if the issue persists then give us some time to fix the error. If you like please send us an email explaining what you did so we can expedite our corrective action.</p>
        </div><!-- /.Missing -->
        <div id="ad300" class="ad300 col-sm-4 col-md-2">
            <p id="ad300-subtitle" class="text-center"><small>Advertisement</small></p>
        </div>
    </div><!-- row -->
</div><!-- /.carousel -->
<div class="container marketing">
    <div class="row">
        <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
                <img class="thumbnail-img" src="/games/closestToThePin/promo-1.png" alt="Game Title">
                <div class="caption">
                    <h3>Closest to the Pin</h3>
                    <p>This is the description of the game, why we like it, why you should like it, and most importantly why you should play it right now. Get to it!</p>
                    <p><a href="#" class="btn btn-primary btn-success" role="button">Play Now!</a></p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
                <img class="thumbnail-img" src="/games/zamBeeZee/promo-zambeezee.jpg" alt="Game Title">
                <div class="caption">
                    <h3>Zam BeeZee</h3>
                    <p>This is the description of the game, why we like it, why you should like it, and most importantly why you should play it right now. Get to it!</p>
                    <p><a href="#" class="btn btn-primary btn-success" role="button">Play Now!</a></p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
                <img class="thumbnail-img" src="/games/MatchMaster3000/promo-matchmaster.png" alt="Game Title">
                <div class="caption">
                    <h3>Match Master 3000</h3>
                    <p>This is the description of the game, why we like it, why you should like it, and most importantly why you should play it right now. Get to it!</p>
                    <p><a href="#" class="btn btn-primary btn-success" role="button">Play Now!</a></p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
                <img class="thumbnail-img" src="/games/RealHousewivesMemoryChallenge/promo-rh.png" alt="Game Title">
                <div class="caption">
                    <h3>Real Housewives Memory Challenge</h3>
                    <p>This is the description of the game, why we like it, why you should like it, and most importantly why you should play it right now. Get to it!</p>
                    <p><a href="#" class="btn btn-primary btn-success" role="button">Play Now!</a></p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
                <img class="thumbnail-img" src="/games/stacker/promo-stacker.png" alt="Game Title">
                <div class="caption">
                    <h3>Awards Stacker</h3>
                    <p>This is the description of the game, why we like it, why you should like it, and most importantly why you should play it right now. Get to it!</p>
                    <p><a href="#" class="btn btn-primary btn-success" role="button">Play Now!</a></p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
                <img class="thumbnail-img" src="/games/closestToThePin/promo-1.png" alt="Game Title">
                <div class="caption">
                    <h3>Game Title</h3>
                    <p>This is the description of the game, why we like it, why you should like it, and most importantly why you should play it right now. Get to it!</p>
                    <p><a href="#" class="btn btn-primary btn-success" role="button">Play Now!</a></p>
                </div>
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