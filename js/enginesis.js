/** @file: enginesis.js - JavaScript interface for Enginesis SDK
 * @author: jf
 * @date: 7/25/13
 * @summary: A JavaScript interface to the Enginesis API. This is designed to be a singleton
 *  object, only one should ever exist. It represents the data model and service/event model
 *  to converse with the server, and provides an overridable callback function to get the server response.
 * 
 * git $Header$
 *
 **/

"use strict";

var enginesis = function (siteId, gameId, gameGroupId, enginesisServerStage, _authToken, _developerKey, languageCode, _callBackFunction) {

    var VERSION = '2.3.18',
        debugging = true,
        disabled = false, // use this flag to turn off communicating with the server
        errorLevel = 15, // bitmask: 1=info, 2=warning, 4=error, 8=severe
        useHTTPS = false,
        serverStage = null,
        serverHost = null,
        submitToURL = null,
        siteId = siteId || 0,
        gameId = gameId || 0,
        gameGroupId = gameGroupId || 0,
        languageCode = languageCode || 'en',
        syncId = 0,
        lastCommand = null,
        callBackFunction = _callBackFunction,
        authToken = _authToken,
        developerKey = _developerKey,
        loggedInUserId = 0,
        platform = '',
        locale = 'US-en',
        isNativeBuild = false,
        isTouchDevice = false;


    var requestComplete = function (enginesisResponseData, overRideCallBackFunction) {
        var enginesisResponseObject;

        debugLog("CORS request complete " + enginesisResponseData);
        try {
            enginesisResponseObject = JSON.parse(enginesisResponseData);
        } catch (exception) {
            enginesisResponseObject = {results:{status:{success:0,message:"Error: " + exception.message,extended_info:enginesisResponseData.toString()},passthru:{fn:"unknown",state_seq:"0"}}};
        }
        enginesisResponseObject.fn = enginesisResponseObject.results.passthru.fn;
        if (overRideCallBackFunction != null) {
            overRideCallBackFunction(enginesisResponseObject);
        } else if (callBackFunction != null) {
            callBackFunction(enginesisResponseObject);
        }
    };

    var sendRequest = function (fn, parameters, overRideCallBackFunction) {
        var enginesisParameters = serverParamObjectMake(fn, parameters),
            crossOriginRequest = new XMLHttpRequest();

        if (typeof crossOriginRequest.withCredentials == undefined) {
            debugLog("CORS is not supported");
        } else if ( ! disabled) {
            crossOriginRequest.onload = function(e) {
                requestComplete(this.responseText, overRideCallBackFunction);
            };

            crossOriginRequest.onerror = function(e) {
                debugLog("CORS request error " + crossOriginRequest.status + " " + e.toString());
                // TODO: Enginesis.requestError(errorMessage); generate a canned error response (see PHP code)
            };

            // TODO: Need "GET", "PUT", and "DELETE" methods
            crossOriginRequest.open("POST", submitToURL, true);
            crossOriginRequest.overrideMimeType("application/json");
            crossOriginRequest.send(convertParamsToFormData(enginesisParameters));
            lastCommand = fn;
        }
    };

    var serverParamObjectMake = function (whichCommand, additionalParameters) {
        var serverParams = {
            fn: whichCommand,
            language_code: languageCode,
            site_id: siteId,
            game_id: gameId,
            state_seq: ++ syncId,
            response: "json"
        };
        if (loggedInUserId != 0) {
            serverParams.logged_in_user_id = loggedInUserId;
        }
        if (additionalParameters != null) {
            for (var key in additionalParameters) {
                if (additionalParameters.hasOwnProperty(key)) {
                    serverParams[key] = additionalParameters[key];
                }
            }
        }
        return serverParams;
    };

    var convertParamsToFormData = function (parameterObject)
    {
        var key;
        var formDataObject = new FormData();
        for (key in parameterObject) {
            if (parameterObject.hasOwnProperty(key)) {
                formDataObject.append(key, parameterObject[key]);
            }
        }
        return formDataObject;
    };

    var qualifyAndSetServerStage = function (newServerStage) {
        switch (newServerStage) {
            case '':
            case '-l':
            case '-d':
            case '-q':
            case '-x':
                serverStage = newServerStage;
                break;
            default:
                serverStage = ''; // anything we do not expect goes to the live instance
                break;
        }
        serverHost = 'www.enginesis' + serverStage + '.com';
        submitToURL = (useHTTPS ? 'https://' : 'http://') + serverHost + '/index.php';
        return serverStage;
    };

    var setPlatform = function () {
        platform = navigator.platform;
        locale = navigator.language;
        isNativeBuild = document.location.protocol == 'file:';
        if (Modernizr != null && Modernizr.touch != null) {
            isTouchDevice = Modernizr.touch;
        }
    };

    var debugLog = function (message, level) {
        if (debugging) {
            if (level == null) {
                level = 15;
            }
            if (errorLevel & level > 0) { // only show this message if the error level is on for the level we are watching
                console.log(message);
            }
            if (level == 9) {
                alert(message);
            }
        }
    };

    setPlatform();
    qualifyAndSetServerStage(enginesisServerStage);

    // =====================================================================
    // this is the public interface
    //
    return {

        ShareHelper: ShareHelper,

        versionGet: function () {
            return VERSION;
        },

        isTouchDevice: function () {
            return isTouchDevice;
        },

        serverStageSet: function (newServerStage) {
            return qualifyAndSetServerStage(newServerStage);
        },

        serverStageGet: function () {
            return serverStage;
        },

        serverBaseUrlGet: function () {
            return serverHost;
        },

        gameIdGet: function () {
            return gameId;
        },

        gameIdSet: function (newGameId) {
            return gameId = newGameId;
        },

        gameGroupIdGet: function () {
            return gameGroupId;
        },

        gameGroupIdSet: function (newGameGroupId) {
            return gameGroupId = newGameGroupId;
        },

        siteIdGet: function () {
            return siteId;
        },

        siteIdSet: function (newSiteId) {
            return siteId = newSiteId;
        },

        getDateNow: function () {
            return new Date().toISOString().slice(0, 19).replace('T', ' ');
        },

        sessionBegin: function (gameKey, overRideCallBackFunction) {
            return sendRequest("SessionBegin", {gamekey: gameKey}, overRideCallBackFunction);
        },

        addOrUpdateVoteByURI: function (voteURI, voteGroupURI, voteValue, overRideCallBackFunction) {
            // voteGroupURI = voting group that collects all the items to be voted on
            // voteURI = item voting on
            // voteValue = vote (e.g. 1 to 5)
            return sendRequest("AddOrUpdateVoteByURI", {uri: voteURI, vote_group_uri: voteGroupURI, vote_value: voteValue}, overRideCallBackFunction);
        },

        developerGet: function (developerId, overRideCallBackFunction) {
            return sendRequest("DeveloperGet", {developer_id: developerId}, overRideCallBackFunction);
        },

        gameDataGet: function (gameDataId, overRideCallBackFunction) {
            return sendRequest("GameDataGet", {game_data_id: gameDataId}, overRideCallBackFunction);
        },

        gameDataCreate: function (referrer, fromAddress, fromName, toAddress, toName, userMessage, userFiles, gameData, nameTag, addToGallery, lastScore, overRideCallBackFunction) {
            return sendRequest("GameDataCreate", {
                referrer: referrer,
                from_address: fromAddress,
                from_name: fromName,
                to_address: toAddress,
                to_name: toName,
                user_msg: userMessage,
                user_files: userFiles,
                game_data: gameData,
                name_tag: nameTag,
                add_to_gallery: addToGallery ? 1 : 0,
                last_score: lastScore
            }, overRideCallBackFunction);
        },

        gameTrackingRecord: function (category, action, label, hitData, overRideCallBackFunction) {
            // category = what generated the event
            // action = what happened (LOAD, PLAY, GAMEOVER, EVENT, ZONECHG)
            // label = path in game where event occurred
            // data = a value related to the action, quantifying the action, if any
            if (window.ga != null) {
                // use Google Analytics if it is there (send, event, category, action, label, value)
                ga('send', 'event', category, action, label, hitData);
            }
            return sendRequest("GameTrackingRecord", {hit_type: 'REQUEST', hit_category: category, hit_action: action, hit_label: label, hit_data: hitData}, overRideCallBackFunction);
        },

        getNumberOfVotesPerURIGroup: function (voteGroupURI, overRideCallBackFunction) {
            // voteGroupURI = voting group that collects all the items to be voted on
            return sendRequest("GetNumberOfVotesPerURIGroup", {vote_group_uri: voteGroupURI}, overRideCallBackFunction);
        },

        gameFind: function(game_name_part, overRideCallBackFunction) {
            return sendRequest("GameFind", {game_name_part: game_name_part}, overRideCallBackFunction);
        },

        gameFindByName: function (gameName, overRideCallBackFunction) {
            return sendRequest("GameFindByName", {game_name: gameName}, overRideCallBackFunction);
        },

        gameGet: function (gameId, overRideCallBackFunction) {
            return sendRequest("GameGet", {game_id: gameId}, overRideCallBackFunction);
        },

        gameGetByName: function (gameName, overRideCallBackFunction) {
            return sendRequest("GameGetByName", {game_name: gameName}, overRideCallBackFunction);
        },

        gameListByCategory: function (numItemsPerCategory, gameStatusId, overRideCallBackFunction) {
            return sendRequest("GameListByCategory", {num_items_per_category: numItemsPerCategory, game_status_id: gameStatusId}, overRideCallBackFunction);
        },

        gameListList: function (overRideCallBackFunction) {
            return sendRequest("GameListList", {}, overRideCallBackFunction);
        },

        gameListListGames: function (gameListId, overRideCallBackFunction) {
            return sendRequest("GameListListGames", {game_list_id: gameListId}, overRideCallBackFunction);
        },

        gameListListGamesByName: function (gameListName, overRideCallBackFunction) {
            return sendRequest("GameListListGamesByName", {game_list_name: gameListName}, overRideCallBackFunction);
        },

        gameListByMostPopular: function (startDate, endDate, firstItem, numItems, overRideCallBackFunction) {
            return sendRequest("GameListByMostPopular", {start_date: startDate, end_date: endDate, first_item: firstItem, num_items: numItems}, overRideCallBackFunction);
        },

        gameListCategoryList: function (overRideCallBackFunction) {
            return sendRequest("GameListCategoryList", {}, overRideCallBackFunction);
        },

        gameListListRecommendedGames: function (gameListId, overRideCallBackFunction) {
            return sendRequest("GameListListRecommendedGames", {game_list_id: gameListId}, overRideCallBackFunction);
        },

        gamePlayEventListByMostPlayed: function (startDate, endDate, numItems, overRideCallBackFunction) {
            return sendRequest("GamePlayEventListByMostPlayed", {start_date: startDate, end_date: endDate, num_items: numItems}, overRideCallBackFunction);
        },

        newsletterCategoryList: function (overRideCallBackFunction) {
            return sendRequest("NewsletterCategoryList", {}, overRideCallBackFunction);
        },

        newsletterAddressAssign: function (emailAddress, userName, companyName, categories, overRideCallBackFunction) {
            return sendRequest("NewsletterAddressAssign", {email_address: emailAddress, user_name: userName, company_name: companyName, categories: categories, delimiter: ","}, overRideCallBackFunction);
        },

        newsletterAddressUpdate: function (newsletterAddressId, emailAddress, userName, companyName, active, overRideCallBackFunction) {
            return sendRequest("NewsletterAddressUpdate", {newsletter_address_id: newsletterAddressId, email_address: emailAddress, user_name: userName, company_name: companyName, active: active}, overRideCallBackFunction);
        },

        newsletterAddressDelete: function (emailAddress, overRideCallBackFunction) {
            return sendRequest("NewsletterAddressDelete", {email_address: emailAddress, newsletter_address_id: "NULL"}, overRideCallBackFunction);
        },

        newsletterAddressGet: function (emailAddress, overRideCallBackFunction) {
            return sendRequest("NewsletterAddressGet", {email_address: emailAddress}, overRideCallBackFunction);
        },

        promotionItemList: function (promotionId, queryDate, overRideCallBackFunction) {
            return sendRequest("PromotionItemList", {promotion_id: promotionId, query_date: queryDate}, overRideCallBackFunction);
        },

        promotionList: function (promotionId, queryDate, showItems, overRideCallBackFunction) {
            return sendRequest("PromotionItemList", {promotion_id: promotionId, query_date: queryDate, show_items: showItems}, overRideCallBackFunction);
        },

        recommendedGameList: function (gameId, overRideCallBackFunction) {
            return sendRequest("RecommendedGameList", {game_id: gameId}, overRideCallBackFunction);
        },

        registeredUserCreate: function (userName, password, email, realName, dateOfBirth, gender, city, state, zipcode, countryCode, mobileNumber, imId, tagline, siteUserId, networkId, agreement, securityQuestionId, securityAnswer, imgUrl, aboutMe, additionalInfo, sourceSiteId, captchaId, captchaResponse, overRideCallBackFunction) {
            captchaId = '99999';
            captchaResponse = 'DEADMAN';
            sendRequest("RegisteredUserCreate",
                {
                    site_id: this.site_id,
                    captcha_id: captchaId,
                    captcha_response: captchaResponse,
                    user_name: userName,
                    site_user_id: siteUserId,
                    network_id: networkId,
                    real_name: realName,
                    password: password,
                    dob: dateOfBirth,
                    gender: gender,
                    city: city,
                    state: state,
                    zipcode: zipcode,
                    email_address: email,
                    country_code: countryCode,
                    mobile_number: mobileNumber,
                    im_id: imId,
                    agreement: agreement,
                    security_question_id: 1,
                    security_answer: '',
                    img_url: '',
                    about_me: aboutMe,
                    tagline: tagline,
                    additional_info: additionalInfo,
                    source_site_id: sourceSiteId
                }, overRideCallBackFunction);
        },

        registeredUserForgotPassword: function (userName, email, overRideCallBackFunction) {
            // this function generates the email that is sent to the email address matching username or email address
            // that email leads to the change password web page
            return sendRequest("RegisteredUserForgotPassword", {user_name: userName, email: email}, overRideCallBackFunction);
        },

        siteListGames: function(firstItem, numItems, gameStatusId, overRideCallBackFunction) {
            // return a list of all games assigned to the site in title order
            if (firstItem == null || firstItem < 0) {
                firstItem = 1;
            }
            if (numItems == null || numItems > 500) {
                numItems = 500;
            }
            if (gameStatusId == null || gameStatusId > 3) {
                gameStatusId = 2;
            }
            return sendRequest("SiteListGames", {first_item: firstItem, num_items: numItems, game_status_id: gameStatusId}, overRideCallBackFunction);
        },

        siteListGamesRandom: function(numItems, overRideCallBackFunction) {
            if (numItems == null || numItems > 500) {
                numItems = 500;
            }
            return sendRequest("SiteListGamesRandom", {num_items: numItems}, overRideCallBackFunction);
        },

        userLogin: function(userName, password, overRideCallBackFunction) {
            return sendRequest("UserLogin", {user_name: userName, password: password}, overRideCallBackFunction);
        },

        userLoginCoreg: function (userName, siteUserId, gender, dob, city, state, countryCode, locale, networkId, overRideCallBackFunction) {
            return sendRequest("UserLoginCoreg",
                {
                    site_user_id: siteUserId,
                    user_name: userName,
                    network_id: networkId
                }, overRideCallBackFunction);
        }
    };
};