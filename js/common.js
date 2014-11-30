/**
 * Common JavaScript utility functions
 *
 * isValidEmail(email) - check if email address looks valid
 * hashWord(word) - produce a hash of an input string
 *
 */

function isValidEmail (email) {
    var re = /\S+@\S+\.\S+/;
    return re.test(email);
}

function compareTitle(a, b) {
    if (a.title < b.title) {
        return -1;
    } else if (a.title > b.title) {
        return 1;
    } else {
        return 0;
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

function makeGameModule (gameId, gameName, gameDescription, gameImg, gameLink) {
    var innerHtml,
        title;

    title = "Play " + gameName + " Now!";
    innerHtml = "<div class=\"thumbnail\">";
    innerHtml += "<a href=\"" + gameLink + "\" title=\"" + title + "\"><img class=\"thumbnail-img\" src=\"" + gameImg + "\" alt=\"" + gameName + "\"/></a>";
    innerHtml += "<div class=\"caption\"><h3>" + gameName + "</h3><p class=\"gamedescription\">" + gameDescription + "</p>";
    innerHtml += "<p><a href=\"" + gameLink + "\" class=\"btn btn-primary btn-success\" role=\"button\" title=\"" + title + "\" alt=\"" + title + "\">Play Now!</a></p>";
    innerHtml += "</div></div>";
    return innerHtml;
}

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

function gameListGamesResponse (results, elementId) {
    // results is an array of games
    var i,
        gameItem,
        gameImg,
        gameLink,
        gamesContainer = document.getElementById(elementId),
        newDiv,
        itemHtml;

    if (results != null && results.length > 0 && gamesContainer != null) {
        results.sort(compareTitle);
        for (i = 0; i < results.length; i ++) {
            gameItem = results[i];
            gameImg = "http://www.enginesis.com/games/" + gameItem.game_name + "/images/300x225.png";
            gameLink = "/play.php?gameid=" + gameItem.game_id;
            itemHtml = makeGameModule(gameItem.game_id, gameItem.title, gameItem.short_desc, gameImg, gameLink);
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

