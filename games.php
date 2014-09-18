<!DOCTYPE html>
<html>
<head>
    <title>JumpyDot Games</title>
    <style>
        body {
            font: 16px 'gill sans', helvetica, sans-serif;
            color: #000000;
            margin: 0;
            padding: 0;
        }

        header {
            width: 100%;
            border-bottom: 12px;
            background-color: #f2f2f2;
        }

        header, footer {
            border-color: #707070;
            border-style: solid;
            border-width: 1px;
        }

        #facts .details {
            border-color: #707070;
            border-style: solid;
            border-width: 0;
        }

        h1#title {
            text-align: center;
            margin: 0;
            padding: 0;
        }

        h2 #TitleTopGames {
            text-align: center;
            margin: 0;
            padding: 2;
            background-color: #f2f2f2;
        }

        p#tagline {
            text-align: center;
            margin: 0;
            padding: 0;
        }

        p#subtitle {
            font-size: small;
            color: #5d5d5d;
            text-align: center;
            margin: 0;
            padding: 0;
        }

        footer {
            border-top-width: 1px;
            text-align: center;
            bottom: 0;
            font-size: 9px;
            color: #5d5d5d;
            background-color: #f2f2f2;
            width: 100%;
        }

        footer .copyright {
            margin: 0;
        }

        pre, code {
            background: #ddd;
            font: 0.9em/1em courier, monospace;
        }

        #sample {
            margin-bottom: 75px;
        }

        #facts .details pre, #facts .details code {
            background: #e1e3e6;
        }

        pre {
            border-radius: 1em;
            padding: 1em;
            margin: 0;
        }

        #facts {

        }

        li {
            margin-top: 1em;
        }

        li:first-child {
            margin-top: 0;
        }

        #facts li:before {
            content: 'Fact: ';
            font-weight: bold;
        }

        #facts .details {
            background: #eff4ff;
            border-left-width: 1px;
            padding: 1em;
            margin: 12px 0;
            -webkit-border-radius: 5px;
            -webkit-box-shadow: 0 0 8px #ccc;
        }

        #facts .details p:first-child {
            margin-top: 0;
        }

        #facts .details p:last-child {
            margin-bottom: 0;
        }

        em {
            color: red;
        }

        .PrimaryGamePromo {
            width: 320px;
            padding: 8px;
        }

        .GameTitle {
            width: 300px;
            font: 18px 'gill sans', helvetica, sans-serif;
            font-weight: bold;
            margin-bottom: 0;
        }

        .GameDesc {
            width: 300px;
            font-size: 14px;
            margin: 0.5em;
        }

    </style>
</head>
<body>
    <header>
        <h1 id="title">JumpyDot Games</h1>
        <p id="tagline">Play. Anywhere.</p>
        <p id="subtitle">Addictive games engineered for all platforms.</p>
    </header>
    <div id="contentArea">
        <section id="mainPromo">
            <div id="mainPromoContent">
                This is the main promo.
            </div>
            <div id="mainAd">
                This is the main ad spot.
            </div>
        </section>
        <section id="PrimaryContent">
            <h2 id="TitleTopGames">Top Games</h2>
            <div class="PrimaryGamePromo">
                <p class="GameTitle">Closest To The Pin</p>
                <img class="GameImg" src="/games/closestToThePin/promo-1.png" width="300" height="225" border="0"/>
                <p class="GameDesc">Test your golf skills with the 7 iron. The pressure is on you, and you have only one swing. Can you get closest to the pin?</p>
                <p class="GameStats">Icons describing game status.</p>
                <p class="PlayNowButton">PLAY</p>
            </div>
        </section>
        <section id="secondaryContent">
            <h2>Other Games</h2>
            <div class="secondarygamepromo">
                <p class="gametitle">Title of Game</p>
                <p class="gameimg">Game promo Img</p>
                <p class="gamedesc">A short teaser description of the game.</p>
                <p class="gamestats">Icons describing game status.</p>
                <p class="playnowbutton">PLAY</p>
            </div>
        </section>
    </div>
    <footer>
        <p class="copyright">Copyright &copy; 2014 <a href="https://twitter.com/jumpydot">JumpyDot</a></p>
    </footer>
<script type="text/javascript">
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', '']);
    _gaq.push(['_trackPageview']);

    (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();
</script>
</body>
</html>
