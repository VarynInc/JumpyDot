/**
 * Common JavaScript utility functions used across JumpyDot.com
 *
 *
 */

/**
 * isValidEmail determines if an email address appears to be a valid format
 * @param email
 * @returns {boolean}
 */
function isValidEmail (email) {
    var re = /\S+@\S+\.\S+/;
    return re.test(email);
}

/**
 * compareTitle is an array sort function to alphabetize the array by title
 * @param a
 * @param b
 * @returns {number}
 */
function compareTitle (a, b) {
    if (a.title < b.title) {
        return -1;
    } else if (a.title > b.title) {
        return 1;
    } else {
        return 0;
    }
}

/**
 * insertAndExecute inserts HTML text into the provided <div id="id"> and if that new HTML includes any script tags they will get evaluated.
 * @param id: element to insert new HTML text into.
 * @param text: the new HTML text to insert into id.
 */
function insertAndExecute(id, text) {
    document.getElementById(id).innerHTML = text;
    var scripts = document.getElementById(id).getElementsByTagName("script");
    for (var i = 0; i < scripts.length; i++) {
        if (scripts[i].src != "") {
            var tag = document.createElement("script");
            tag.src = scripts[i].src;
            document.getElementsByTagName("head")[0].appendChild(tag);
        } else {
            eval(scripts[i].innerHTML);
        }
    }
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

function handleNewsletterServerResponse (succeeded) {
    if (succeeded == 1) {
        setPopupMessage("You are subscribed - Thank you!", "popupMessageResponseOK");
        window.setTimeout(hideSubscribePopup, 2000);
    } else {
        setPopupMessage("Server reports an error: " + errorMessage, "popupMessageResponseError");
    }
}

/**
 * makeGameModule will generate the HTML for a standard game promo module.
 * @param gameId
 * @param gameName
 * @param gameDescription
 * @param gameImg
 * @param gameLink
 * @returns {string} the HTML
 */
function makeGameModule (gameId, gameName, gameDescription, gameImg, gameLink) {
    var innerHtml,
        title;

    title = "Play " + gameName + " Now!";
    innerHtml = "<div class=\"thumbnail\">";
    innerHtml += "<a href=\"" + gameLink + "\" title=\"" + title + "\"><img class=\"thumbnail-img\" src=\"" + gameImg + "\" alt=\"" + gameName + "\"/></a>";
    innerHtml += "<div class=\"caption\"><a class=\"gameTitle\" href=\"" + gameLink + "\" title=\"" + title + "\"><h3>" + gameName + "</h3></a><p class=\"gamedescription\">" + gameDescription + "</p>";
    innerHtml += "<p><a href=\"" + gameLink + "\" class=\"btn btn-primary btn-success\" role=\"button\" title=\"" + title + "\" alt=\"" + title + "\">Play Now!</a></p>";
    innerHtml += "</div></div>";
    return innerHtml;
}

/**
 * makePromoModule will generate the HTML for a single standard promo module for the carousel.
 * @param isActive
 * @param backgroundImg
 * @param titleText
 * @param altText
 * @param promoText
 * @param link
 * @param callToActionText
 * @returns {string}
 */
function makePromoModule (isActive, backgroundImg, titleText, altText, promoText, link, callToActionText) {
    var innerHtml,
        isActiveItem;

    if (isActive) {
        isActiveItem = " active";
    } else {
        isActiveItem = "";
    }
    innerHtml = "<div class=\"carousel-inner\" role=\"listbox\"><div class=\"item" + isActiveItem + "\">";
    innerHtml += "<img src=\"" + backgroundImg + +"\" alt=\"" + altText + "\">";
    innerHtml += "<div class=\"container\"><div class=\"carousel-caption\"><h1>" + titleText + "</h1>";
    innerHtml += "<p>" + promoText + "</p>";
    innerHtml += "<p><a class=\"btn btn-lg btn-primary\" href=\"" + link + "\" role=\"button\">" + callToActionText + "</a></p>";
    innerHtml += "</div></div></div>"
    return innerHtml;
}

/**
 * makePromoIndicators generates the HTML for all promo indicators used in the carousel.
 * @param numberOfPromos
 * @param activeIndicator
 * @returns {string}
 */
function makePromoIndicators (numberOfPromos, activeIndicator) {
    var innerHtml = "<ol class=\"carousel-indicators\">",
        activeClass,
        i;

    if (activeIndicator === undefined || activeIndicator == null || activeIndicator < 0 || activeIndicator >= numberOfPromos) {
        activeIndicator = 0;
    }
    for (i = 0; i < numberOfPromos; i ++) {
        if (i == activeIndicator) {
            activeClass = " class=\"active\""
        }
        innerHtml += "<li data-target=\"#PromoCarousel\" data-slide-to=\"" + i + "\"" + activeClass + "></li>";
    }
    innerHtml += "</ol>";
    return innerHtml;
}

/**
 * gameListGamesResponse handles the server reply from GameLisstListGames and generates the game modules.
 * @param results {object}: the sever response object
 * @param elementId {string}: element to insert game modules HTML
 * @param maxItems {int}: no more than this number of games
 * @param sortList {bool}: true to sort the list of games alphabetically by title
 */
function gameListGamesResponse (results, elementId, maxItems, sortList) {
    // results is an array of games
    var i,
        gameItem,
        gamesContainer = document.getElementById(elementId),
        newDiv,
        itemHtml,
        countOfGamesShown,
        baseURL = document.location.protocol + "//" + EnginesisSession.serverBaseUrlGet() + "/games/",
        isTouchDevice = EnginesisSession.isTouchDevice();

    if (results != null && results.length > 0 && gamesContainer != null) {
        if (sortList == null) {
            sortList = false;
        }
        if (sortList) {
            results.sort(compareTitle);
        }
        if (maxItems == null || maxItems < 1) {
            maxItems = results.length;
        }
        countOfGamesShown = 0;
        for (i = 0; i < results.length && countOfGamesShown < maxItems; i ++) {
            gameItem = results[i];
            if (isTouchDevice && ! (gameItem.game_plugin_id == "10" || gameItem.game_plugin_id == "9")) {
                continue; // only show HTML5 or embed games on touch devices
            }
            countOfGamesShown ++;
            itemHtml = makeGameModule(gameItem.game_id, gameItem.title, gameItem.short_desc, baseURL + gameItem.game_name + "/images/300x225.png", "/play.php?gameid=" + gameItem.game_id);
            newDiv = document.createElement('div');
            newDiv.className = "col-sm-6 col-md-4";
            newDiv.innerHTML = itemHtml;
            gamesContainer.appendChild(newDiv);
        }
    } else {
        // no games!
    }
}

function promotionItemListResponse (results) {
    // results is an array of promoted items
    var i;
    if (results != null && results.length > 0) {
        for (i = 0; i < results.length; i ++) {

        }
    } else {
        // no promotions!
    }
}