<?php
require_once('../services/common.php');
processTrackBack();
$gameId = getPostOrRequestVar('id', '');
if ($gameId == '') {
    $gameId = getPostOrRequestVar('gameid', '');
}
if ($gameId == '') {
    $gameId = getPostOrRequestVar('game_id', '');
}
if ($gameId == '') {
    $gameId = getPostOrRequestVar('gameId', '');
}
if ($gameId == '') {
    $gameId = getPostOrRequestVar('gameName', '');
}
if ($gameId == '') {
    $gameId = getPostOrRequestVar('gamename', '');
}
if ($gameId == '') {
    $gameId = getPostOrRequestVar('g', '');
}
if ($gameId == '') {
    header("Location: /allgames.php");
}
$gameWidth = 1024;
$gameHeight = 768;
$gameDescription = '';
$gameInfo = null;
$receivedGameInfo = false;
$gameContainerHTML = '';
$isPlayBuzzSpecialCase = false;

    // get game info: we need the game info immediately in order to build the page
    // TODO: GameGet only works for numeric game_id, if game name we need to call GameGetByName

    if (is_numeric($gameId)) {
        $response = callEnginesisAPI('GameGet', $enginesisServer . '/index.php', array('site_id' => $siteId, 'game_id' => $gameId, 'response' => 'json'));
    } else {
        $response = callEnginesisAPI('GameGetByName', $enginesisServer . '/index.php', array('site_id' => $siteId, 'game_name' => $gameId, 'response' => 'json'));
    }
    if ($response != null) {
        $responseObject = json_decode($response);
        if ($responseObject != null) {
            if ($responseObject->results->status->success == '0') {
                header("Location: /missing.php");
                exit(0);
            } else {
                $gameInfo = $responseObject->results->result[0];
                if ($gameInfo != null) {
                    $receivedGameInfo = true;
                    $gameId = $gameInfo->game_id;
                    $gameName = $gameInfo->game_name;
                    $title = $gameInfo->title;
                    $gameImg = 'http://enginesis.jumpydot.com/games/' . $gameName . '/images/600x450.png';
                    $gameImg2 = 'http://enginesis.jumpydot.com/games/' . $gameName . '/images/586x308.png';
                    $gameThumb = 'http://enginesis.jumpydot.com/games/' . $gameName . '/images/50x50.png';
                    $gameLink = 'http://www.jumpydot.com/play.php?gameid=' . $gameId;
                    $gameOGLink = 'http://www.jumpydot.com/play/' . $gameId;
                    $gameDesc = $gameInfo->short_desc;
                    $gameContainerHTML = setGameContainer($gameInfo, $enginesisServer, $siteId, $gameId);
                }
            }
        }
    }
    if ( ! $receivedGameInfo) {
        header("Location: /missing.php");
        exit(0);
    }

    function setGameContainer ($gameInfo, $enginesisServer, $siteId, $gameId) {
        // generate the necessary HTML to setup the game container div

        $width = $gameInfo->width;
        $height = $gameInfo->height;
        $bgcolor = '#' . $gameInfo->bgcolor;
        $pluginId = $gameInfo->game_plugin_id;
        $allowScroll = $gameInfo->popup == 0 ? 'no' : 'yes';
        if ($pluginId == 9) { // embed
            $gameContainerHTML = '<div id="gameContainer-iframe" style="position: relative; margin: 0 auto; width: 100%; height: 100%;">' . $gameInfo->game_link . '</div>';
        } else {
            if ($pluginId == 10) { // canvas
                if (strpos($gameInfo->game_link, '://') > 0) {
                    $gameLink = $gameInfo->game_link;
                } else {
                    $gameLink = $enginesisServer . '/games/' . $gameInfo->game_name . '/' . $gameInfo->game_link;
                }
            } else {
                $gameLink = $enginesisServer . '/games/play.php?site_id=' . $siteId . '&game_id=' . $gameId;
            }
            $gameContainerHTML = '<iframe id="gameContainer-iframe" src="' . $gameLink . '" allowfullscreen scrolling="' . $allowScroll . '" width="' . $width . '" height="' . $height . '" border="0"></iframe>';
        }
        return $gameContainerHTML;
    }

    // TODO: Setup Facebook app and add     <heta property="fb:app_id" content="###" />
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo($title);?> on JumpyDot.com</title>
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
    <meta name="viewport" content="width=device-width, initial-scale=1, minimal-ui">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="mobile-web-app-capable" content="yes" />
    <meta name="description" content="<?php echo($gameDesc);?>">
    <meta name="author" content="JumpyDot">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/carousel.css" rel="stylesheet">
    <link href="/css/jumpydot.css" rel="stylesheet">
    <link rel="icon" href="<?php echo($gameThumb);?>">
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
    <link rel="shortcut icon" href="<?php echo($gameThumb);?>">
    <meta property="og:title" content="<?php echo($title);?> on JumpyDot.com">
    <meta property="og:url" content="<?php echo($gameOGLink);?>">
    <meta property="og:site_name" content="JumpyDot">
    <meta property="og:description" content="<?php echo($gameDesc);?>">
    <meta property="og:image" content="<?php echo($gameImg);?>"/>
    <meta property="og:image" content="<?php echo($gameImg2);?>"/>
    <meta property="og:image" content="<?php echo($gameThumb);?>"/>
    <meta property="og:type" content="game"/>
    <meta name="twitter:card" content="photo"/>
    <meta name="twitter:site" content="@jumpydot"/>
    <meta name="twitter:creator" content="@jumpydot"/>
    <meta name="twitter:title" content="<?php echo($title);?> on JumpyDot.com"/>
    <meta name="twitter:image:src" content="<?php echo($gameImg);?>"/>
    <meta name="twitter:domain" content="jumpydot.com"/>
    <script src="/js/head.min.js"></script>
    <script type="text/javascript">

        var enginesisServer = '';
        head.ready(function() {
            initApp();
        });
        head.js("/js/modernizr.custom.74056.js", "/js/jquery.min.js", "/js/bootstrap.min.js", "/js/ie10-viewport-bug-workaround.js", "/js/common.js", "/js/enginesis.js", "/js/ShareHelper.js");

        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
        ga('create', 'UA-55025061-1', 'auto');
        ga('send', 'pageview');
        ga('send', 'event', 'game', 'play', '<?php echo($gameId);?>', 1);

        function initApp() {
            var gameId = "<?php echo($gameId);?>",
                serverStage = "<?php echo($serverStage);?>",
                serverHostDomain = 'jumpydot' + serverStage + '.com';

            enginesisServer = 'enginesis.' + serverHostDomain;
            document.domain = serverHostDomain;
            window.EnginesisSession = enginesis(<?php echo($siteId);?>, 0, 0, enginesisServer, '', '', 'en', enginesisCallBack);
            EnginesisSession.siteListGamesRandom(24, null);
            EnginesisSession.developerGet(<?php echo($gameInfo->developer_id);?>);
            setGameContainer();
            if (EnginesisSession.isTouchDevice()) {
                window.addEventListener('orientationchange', resetGameFrameSize, false);
            }
            // window.addEventListener('resize', resetGameFrameSize, false); // we are hoping the responsive page will handle this for us
        }

        function enginesisCallBack (enginesisResponse) {
            var succeeded,
                errorMessage;

            if (enginesisResponse != null && enginesisResponse.fn != null) {
                succeeded = enginesisResponse.results.status.success;
                errorMessage = enginesisResponse.results.status.message;
                switch (enginesisResponse.fn) {
                    case "NewsletterAddressAssign":
                        handleNewsletterServerResponse(succeeded);
                        break;
                    case "DeveloperGet":
                        setGameDeveloper(enginesisResponse.results.result[0]);
                        break;
                    case "SiteListGamesRandom":
                        if (succeeded == 1) {
                            gameListGamesResponse(enginesisResponse.results.result, "PlayPageGamesArea", 9, false);
                        }
                        break;
                    default:
                        break;
                }
            }
        }

        function setGameDeveloper (developerInfo) {
            var developerInfoDiv = document.getElementById("gameDeveloper");
            if (developerInfoDiv != null) {
                if (developerInfo.logo_img_url != null && developerInfo.logo_img_url != '') {
                    developerInfoDiv.innerHTML = "<h4>Developed By:</h4><p><a href=\"" + developerInfo.web_site_url + "\" target=\"_new\"><img src=\"http://www.enginesis.com" + developerInfo.logo_img_url + "\" width=100 height=50 style=\"margin-right: 20px;\"/></a></p>";
                } else {
                    developerInfoDiv.innerHTML = "<h4>Developed By:</h4><p><a href=\"" + developerInfo.web_site_url + "\" target=\"_new\">" + developerInfo.organization_name + "</a></p>";
                }
            }
        }

        function resetGameFrameSize () {
            fitGameToFullScreen();
            window.location.reload();
        }

        function showOnlyTheGame (showFlag) {
            // show/hide all divs except the gameContainer
            var hideTheseElements = ['playgame-navbar', 'playgame-InfoPanel', 'playgame-BottomPanel'],
                unwantedElement,
                elementDiv,
                showStyle;

            if (showFlag) {
                showStyle = 'none';
            } else {
                showStyle = 'block';
            }
            for (unwantedElement in hideTheseElements) {
                elementDiv = document.getElementById(hideTheseElements[unwantedElement]);
                if (elementDiv != null) {
                    elementDiv.style.display = showStyle;
                }
            }
            fitGameToFullScreen();
        }

        function fitGameToFullScreen () {
            // Resize the game containers to the full extent of the available window, then let the game deal with that stage size.
            var elementDiv,
                width,
                height;

            width = window.innerWidth;
            height = window.innerHeight;
            elementDiv = document.getElementById("gameContainer-iframe");
            if (elementDiv != null) {
                elementDiv.style.width = width + "px";
                elementDiv.style.maxWidth = width + "px";
                elementDiv.style.height = height + "px";
                elementDiv.style.maxHeight = height + "px";
            }
            elementDiv = document.getElementById("gameContainer");
            if (elementDiv != null) {
                elementDiv.style.width = width + "px";
                elementDiv.style.maxWidth = width + "px";
                elementDiv.style.height = height + "px";
                elementDiv.style.maxHeight = height + "px";
            }
            elementDiv = document.getElementById("topContainer");
            if (elementDiv != null) {
                elementDiv.style.margin = "0";
                elementDiv.style.padding = "0";
                elementDiv.style.top = "0";
                elementDiv.style.left = "0";
                elementDiv.style.width = width + "px";
                elementDiv.style.maxWidth = width + "px";
                elementDiv.style.height = height + "px";
                elementDiv.style.maxHeight = height + "px";
            }
            elementDiv = document.body;
            if (elementDiv != null) {
                elementDiv.style.margin = "0";
                elementDiv.style.padding = "0";
                elementDiv.style.top = "0";
                elementDiv.style.left = "0";
                elementDiv.style.width = width + "px";
                elementDiv.style.maxWidth = width + "px";
                elementDiv.style.height = height + "px";
                elementDiv.style.maxHeight = height + "px";
            }
        }

        function setGameContainer () {
            var gameContainerDiv = document.getElementById("gameContainer"),
                gameContainerIframe,
                requiredAspectRatio,
                width = <?php echo($gameInfo->width);?>,
                height = <?php echo($gameInfo->height);?>,
                pluginId = <?php echo($gameInfo->game_plugin_id);?>,
                isTouchDevice = EnginesisSession.isTouchDevice(),
                embedOnTouchDevice = false;

            // we want to size the container to the size of the game and center it in the panel div.

            EnginesisSession.gameWidth = width;
            EnginesisSession.gameHeight = height;
            if (height < width) {
                requiredAspectRatio = height / width;
            } else {
                requiredAspectRatio = width / height;
            }
            EnginesisSession.gameAspectRatio = requiredAspectRatio; // cache the ideal aspect ratio to use when the frame is resized
            EnginesisSession.gamePluginId = pluginId;
            if (gameContainerDiv != null) {
                embedOnTouchDevice = isTouchDevice && EnginesisSession.gamePluginId == 9;
                if (EnginesisSession.gamePluginId == 9) {
                    gameContainerDiv.style['overflow-y'] = "scroll";
                    gameContainerDiv.style['overflow-x'] = "hidden";
                    gameContainerDiv.style['-webkit-overflow-scrolling'] = "touch";
                    if (isTouchDevice) {
                        // if we are on mobile and this is an Embed type game, just embed the game link directly into the div.
                        showOnlyTheGame(true);
                    }
//                    gameContainerDiv.style.width = width + "px";
//                    gameContainerDiv.style.maxWidth = width + "px";
//                    gameContainerDiv.style.height = height + "px";
//                    gameContainerDiv.style.maxHeight = height + "px";
                    gameContainerDiv.style.paddingTop = "0";
                    // insertAndExecute("gameContainer", gameData.game_link);
                } else {
//                    if (EnginesisSession.gamePluginId == 10) {
//                        if (gameData.game_link.indexOf('://') > 0) {
//                            gameLink = gameData.game_link;
//                        } else {
//                            gameLink = enginesisHost + "/games/" + gameData.game_name + "/" + gameData.game_link;
//                        }
//                    } else {
//                        gameLink = enginesisHost + "/games/play.php?site_id=<?php //echo($siteId);?>//&game_id=<?php //echo($gameId);?>//";
//                    }
//                    gameContainerDiv.innerHTML = "<iframe id=\"gameContainer-iframe\" src=\"" + gameLink + "\" allowfullscreen scrolling=\"" + allowScroll + "\" width=\"" + width + "\" height=\"" + height + "\"/>";
                }
                if (isTouchDevice && EnginesisSession.gamePluginId == 10) {
                    showOnlyTheGame(true);
                } else if ( ! embedOnTouchDevice) {
                    if (gameContainerDiv.clientWidth >= width) { // the game will fit the available space
                        gameContainerIframe = document.getElementById("gameContainer-iframe");
                        if (gameContainerIframe != null) {
                            gameContainerIframe.style.width = width + "px";
                            gameContainerIframe.style.maxWidth = width + "px";
                            gameContainerIframe.style.height = height + "px";
                            gameContainerIframe.style.maxHeight = height + "px";
                        }
                        gameContainerDiv.style.width = width + "px";
                        gameContainerDiv.style.maxWidth = width + "px";
                        gameContainerDiv.style.height = height + "px";
                        gameContainerDiv.style.maxHeight = height + "px";
                    } else if ( ! (EnginesisSession.gamePluginId == 9)) { // iframe game does not fit
                        gameContainerDiv.style.paddingTop = (requiredAspectRatio * 100) + "%";
                    }
                }
            }
        }
    </script>
</head>
<body>
<div id="fb-root"></div>
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
<div id="playgame-navbar" class="navbar-wrapper">
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
                        <li><a href="/">Home</a></li>
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
<div id="topContainer" class="container top-promo-area">
    <div id="gameContainer" class="row"><?php echo($gameContainerHTML);?></div>
    <div id="playgame-InfoPanel" class="row">
        <div class="panel panel-default">
            <div class="panel-body">
                <div id="gameInfo">
                <?php
                if ($receivedGameInfo) {
                    $shareFacebook = '<li><a href="https://www.facebook.com/sharer/sharer.php?u=' . $gameOGLink . '" target="_blank" title="Share ' . $title . ' with your Facebook network"><div class="facebook-small"></div></a></li>';
                    $shareGoogle = '<li><a href="https://plus.google.com/share?url=' . $gameLink . '" target="_blank" title="Share ' . $title . ' with your Google Plus circles"><div class="gplus-small"></div></a></li>';
                    $shareTwitter = '<li><a href="http://twitter.com/share?text=Play ' . $title . ' on JumpyDot.com:&url=' . $gameLink . '&via=jumpydot" target="_blank" title="Share ' . $title . ' with your Twitter followers"><div class="twitter-small"></div></a></li>';
                    $shareEmail = '<li><a href="mailto:?subject=Check out ' . $title . ' on JumpyDot.com&body=I played ' . $title . ' on JumpyDot.com and thought you would like to check it out: ' . $gameLink . '" title="Share ' . $title . ' by email"><div class="email-small"></div></a></li>';
                    echo('<div class="social-game-info"><ul>' . $shareFacebook . $shareGoogle . $shareTwitter . $shareEmail . '</ul></div><h2>' . $title . '</h2><p>' . $gameInfo->long_desc . '</p>');
                } else {
                    echo('<p>No information regarding your request. Please check your entry.</p>');
                }
                ?>
                </div>
                <div id="gameDeveloper">
                </div>
            </div>
        </div>
    </div>
</div><!-- /top-promo-area -->
<div id="playgame-BottomPanel" class="container marketing">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Other games you may like:</h3>
            </div>
        </div>
    </div><!-- row -->
    <div id="PlayPageGamesArea" class="row">
    </div>
    <div id="bottomAd" class="row">
        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <!-- JumpyDot Responsive -->
        <ins class="adsbygoogle"
             style="display:block"
             data-ad-client="ca-pub-9118730651662049"
             data-ad-slot="5571172619"
             data-ad-format="auto"></ins>
        <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
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