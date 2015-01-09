<?php
require_once('procs/common.php');
$search = getPostOrRequestVar('q', null);
if ($search != null) {
    header('location:/allgames.php?q=' . $search);
    exit;
}
processTrackBack();
$showSubscribe = getPostOrRequestVar('s', '0');
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

            var enginesisSiteId = <?php echo($siteId);?>,
                serverStage = "<?php echo($stage);?>",
                enginesisGameListId = 6,
                enginesisHomePagePromoId = 2;

            function initApp() {
                var serverHostDomain = 'jumpydot' + serverStage + '.com',
                    showSubscribe = '<?php echo($showSubscribe);?>';

                document.domain = serverHostDomain;
                window.EnginesisSession = enginesis(enginesisSiteId, 0, 0, 'enginesis.' + serverHostDomain, '', '', 'en', enginesisCallBack);
                EnginesisSession.gameListListGames(enginesisGameListId, null);
                EnginesisSession.promotionItemList(enginesisHomePagePromoId, EnginesisSession.getDateNow(), null);
                if (showSubscribe == '1') {
                    showSubscribePopup();
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
                            handleNewsletterServerResponse(succeeded);
                            break;
                        case "PromotionItemList":
                            if (succeeded == 1) {
                                promotionItemListResponse(enginesisResponse.results.result);
                            }
                            break;
                        case "GameListListGames":
                            if (succeeded == 1) {
                                gameListGamesResponse(enginesisResponse.results.result, "HomePageGamesArea", null, false);
                            }
                            break;
                        default:
                            break;
                    }
                }
            }

            head.ready(function() {
                initApp();
            });
            head.js("/js/modernizr.custom.74056.js", "/js/jquery.min.js", "/js/bootstrap.min.js", "/js/ie10-viewport-bug-workaround.js", "/js/common.js", "/js/enginesis.js", "/js/ShareHelper.js");

            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
            ga('create', 'UA-57520503-1', 'auto');
            ga('send', 'pageview');

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
            <div id="PromoCarousel" class="carousel slide col-sm-8" data-ride="carousel">
              <ol class="carousel-indicators">
                  <li data-target="#PromoCarousel" data-slide-to="0" class="active"></li>
                  <li data-target="#PromoCarousel" data-slide-to="1"></li>
                  <li data-target="#PromoCarousel" data-slide-to="2"></li>
                  <li data-target="#PromoCarousel" data-slide-to="3"></li>
              </ol>
              <div class="carousel-inner" role="listbox">
                <div class="item active">
                  <div class="sliderContainer" style="background:url(/images/promos/JumpyDotPromoHome.jpg) center center;
          background-size:cover;">
                    <div class="carousel-caption">
                      <h3>Welcome to JumpyDot!</h3>
                      <p class="sliderCaption">Welcome to JumpyDot! We aim for content that is fun for all ages and performs on the most popular platforms. Check back for updates. Follow us!</p>
                      <p><a class="btn btn-md btn-danger" href="JavaScript:showSubscribePopup();" role="button">Sign up now</a></p>
                    </div>
                  </div>
                </div>
                <div class="item">
                  <div class="sliderContainer" style="background:url(/images/promos/MatchMasterPromoHome.jpg) center center;
          background-size:cover;">
                    <div class="carousel-caption">
                      <h3>Match Master 3000</h3>
                      <p class="sliderCaption">A match game like no other: 8 different play patterns organized into a quest for the Match Master crown.</p>
                      <p><a class="btn btn-md btn-danger" href="/play.php?gameid=MatchMaster3000" role="button">Play Now &gt;</a></p>
                    </div>
                  </div>
                </div>
                <div class="item">
                  <div class="sliderContainer" style="background:url(/images/promos/TopChefPromoHome.jpg) center center;
          background-size:cover;">
                    <div class="carousel-caption">
                      <h3>Top Chef Memory Challenge</h3>
                      <p class="sliderCaption">A Top Chef knows the recipe for success. Test your skills in the ultimate memory challenge.</p>
                      <p><a class="btn btn-md btn-danger" href="http://www.bravotv.com/media/games/top-chef-memory-challenge/index.html" role="button">Play Now &gt;</a></p>
                    </div>
                  </div>
                </div>
                  <div class="item">
                      <div class="sliderContainer" style="background:url(/images/promos/Blog1PromoHome.jpg) center center;
          background-size:cover;">
                          <div class="carousel-caption">
                              <h3>Blog Post:</h3>
                              <p class="sliderCaption">Blog Post: Fresh Crops and Free Content: How the “Chipotle Scarecrow” App Broke Ground</p>
                              <p><a class="btn btn-md btn-danger" href="/blog/?p=83" role="button">More &gt;</a></p>
                          </div>
                      </div>
                  </div>
              </div>
              <a class="left carousel-control" href="#PromoCarousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="right carousel-control" href="#PromoCarousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span class="sr-only">Next</span>
              </a>
            </div><!-- /.carousel -->
            <div id="ad300" class="col-sm-4 col-md-2">
                <div id="boxAd300" class="ad300">
                    <iframe src="<?php echo($webServer);?>/common/ad300.html" frameborder="0" scrolling="no" style="width: 300px; height: 250px; overflow: hidden; z-index: 9999; left: 0px; bottom: 0px; display: inline-block;"></iframe>
                </div>
                <p id="ad300-subtitle" class="text-right"><small>Advertisement</small></p>
            </div>
        </div><!-- row -->
    </div><!-- /top-promo-area -->
    <div class="container marketing">
        <div id="HomePageGamesArea" class="row">
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