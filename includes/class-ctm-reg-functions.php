<?php
  define("ciphering","AES-256-CTR");
  define("encryption_iv","1234567891011121");

  function decryptVal($token,$key){
    $iv_length = openssl_cipher_iv_length(ciphering);
    $decryption = openssl_decrypt($token, ciphering, $key, 0, encryption_iv);
    return $decryption;
  }
  $ship4wd_custom_registration_options = get_option( 'ship4wd_custom_registration_option_name' );
  $sfkey = $ship4wd_custom_registration_options['sf_key_3'];
  $client_id = decryptVal($ship4wd_custom_registration_options['client_id_0'],$sfkey);
  $client_secret = decryptVal($ship4wd_custom_registration_options['client_secret_1'] ,$sfkey);
  $refresh_token =decryptVal($ship4wd_custom_registration_options['refresh_token_2'],$sfkey);
  define("sf_base_url","https://ship4wd.my.salesforce.com");
  define("client_id",$client_id);
  define("client_secret",$client_secret);
  define("refresh_token",$refresh_token);



  // Git Updater Plugin URL
  define( 'MY_GIT_PATH', WP_PLUGIN_DIR . '/ctm-reg/includes/git-updater/' );
  define( 'MY_GIT_URL', plugin_dir_url( __FILE__ ).'/git-updater/' );

  // Include the Git Updater plugin.
  include_once( MY_GIT_PATH . 'git-updater.php' );


  /**
  * Add async or defer attributes to script enqueues
  * @param String $tag The original enqueued <script src="...> tag
  * @param String $handle The registered unique name of the script
  * @return String  $tag     The modified <script async|defer src="...> tag
  */
  // only on the front-end
  if (!is_admin()) {
    function add_asyncdefer_attribute($tag, $handle)
    {
        // if the unique handle/name of the registered script has 'async' in it
        if (strpos($handle, 'async') !== false) {
            // return the tag with the async attribute
            return str_replace('<script ', '<script async ', $tag);
        } // if the unique handle/name of the registered script has 'defer' in it
        else if (strpos($handle, 'defer') !== false) {
            // return the tag with the defer attribute
            return str_replace('<script ', '<script defer ', $tag);
        } else if (strpos($handle, 'preload') !== false) {
            // return the tag with the defer attribute
            return str_replace('<link ', '<link rel="stylesheet preload" ', $tag);
        } // otherwise skip
        else {
            return $tag;
        }
    }

    add_filter('script_loader_tag', 'add_asyncdefer_attribute', 10, 2);
  }

  add_filter( 'body_class', 'custom_class' );
  function custom_class( $classes ) {
		global $post;
		if ( has_shortcode( $post->post_content, 'include_form' ) ) {
        $classes[] = 'ctm-reg';
    }
    return $classes;
  }

  ;

  function blackListEmail(){
    return "0815.ru,0wnd.net,0wnd.org,10minutemail.co.za,10minutemail.com,123-m.com,1fsdfdsfsdf.tk,1pad.de,20minutemail.com,21cn.com,2fdgdfgdfgdf.tk,2prong.com,30minutemail.com,33mail.com,3trtretgfrfe.tk,4gfdsgfdgfd.tk,4warding.com,5ghgfhfghfgh.tk,6hjgjhgkilkj.tk,6paq.com,7tags.com,9ox.net,a-bc.net,agedmail.com,ama-trade.de,amilegit.com,amiri.net,amiriindustries.com,anonmails.de,anonymbox.com,antichef.com,antichef.net,antireg.ru,antispam.de,antispammail.de,armyspy.com,artman-conception.com,azmeil.tk,baxomale.ht.cx,beefmilk.com,bigstring.com,binkmail.com,bio-muesli.net,bobmail.info,bodhi.lawlita.com,bofthew.com,bootybay.de,boun.cr,bouncr.com,breakthru.com,brefmail.com,bsnow.net,bspamfree.org,bugmenot.com,bund.us,burstmail.info,buymoreplays.com,byom.de,c2.hu,card.zp.ua,casualdx.com,cek.pm,centermail.com,centermail.net,chammy.info,childsavetrust.org,chogmail.com,choicemail1.com,clixser.com,cmail.net,cmail.org,coldemail.info,cool.fr.nf,courriel.fr.nf,courrieltemporaire.com,crapmail.org,cust.in,cuvox.de,d3p.dk,dacoolest.com,dandikmail.com,dayrep.com,dcemail.com,deadaddress.com,deadspam.com,delikkt.de,despam.it,despammed.com,devnullmail.com,dfgh.net,digitalsanctuary.com,dingbone.com,disposableaddress.com,disposableemailaddresses.com,disposableinbox.com,dispose.it,dispostable.com,dodgeit.com,dodgit.com,donemail.ru,dontreg.com,dontsendmespam.de,drdrb.net,dump-email.info,dumpandjunk.com,dumpyemail.com,e-mail.com,e-mail.org,e4ward.com,easytrashmail.com,einmalmail.de,einrot.com,eintagsmail.de,emailgo.de,emailias.com,emaillime.com,emailsensei.com,emailtemporanea.com,emailtemporanea.net,emailtemporar.ro,emailtemporario.com.br,emailthe.net,emailtmp.com,emailwarden.com,emailx.at.hm,emailxfer.com,emeil.in,emeil.ir,emz.net,ero-tube.org,evopo.com,explodemail.com,express.net.ua,eyepaste.com,fakeinbox.com,fakeinformation.com,fansworldwide.de,fantasymail.de,fightallspam.com,filzmail.com,fivemail.de,fleckens.hu,frapmail.com,friendlymail.co.uk,fuckingduh.com,fudgerub.com,fyii.de,garliclife.com,gehensiemirnichtaufdensack.de,get2mail.fr,getairmail.com,getmails.eu,getonemail.com,giantmail.de,girlsundertheinfluence.com,gishpuppy.com,gmial.com,goemailgo.com,gotmail.net,gotmail.org,gotti.otherinbox.com,great-host.in,greensloth.com,grr.la,gsrv.co.uk,guerillamail.biz,guerillamail.com,guerrillamail.biz,guerrillamail.com,guerrillamail.de,guerrillamail.info,guerrillamail.net,guerrillamail.org,guerrillamailblock.com,gustr.com,harakirimail.com,hat-geld.de,hatespam.org,herp.in,hidemail.de,hidzz.com,hmamail.com,hopemail.biz,ieh-mail.de,ikbenspamvrij.nl,imails.info,inbax.tk,inbox.si,inboxalias.com,inboxclean.com,inboxclean.org,infocom.zp.ua,instant-mail.de,ip6.li,irish2me.com,iwi.net,jetable.com,jetable.fr.nf,jetable.net,jetable.org,jnxjn.com,jourrapide.com,jsrsolutions.com,kasmail.com,kaspop.com,killmail.com,killmail.net,klassmaster.com,klzlk.com,koszmail.pl,kurzepost.de,lawlita.com,letthemeatspam.com,lhsdv.com,lifebyfood.com,link2mail.net,litedrop.com,lol.ovpn.to,lolfreak.net,lookugly.com,lortemail.dk,lr78.com,lroid.com,lukop.dk,m21.cc,mail-filter.com,mail-temporaire.fr,mail.by,mail.mezimages.net,mail.zp.ua,mail1a.de,mail21.cc,mail2rss.org,mail333.com,mailbidon.com,mailbiz.biz,mailblocks.com,mailbucket.org,mailcat.biz,mailcatch.com,mailde.de,mailde.info,maildrop.cc,maileimer.de,mailexpire.com,mailfa.tk,mailforspam.com,mailfreeonline.com,mailguard.me,mailin8r.com,mailinater.com,mailinator.com,mailinator.net,mailinator.org,mailinator2.com,mailincubator.com,mailismagic.com,mailme.lv,mailme24.com,mailmetrash.com,mailmoat.com,mailms.com,mailnesia.com,mailnull.com,mailorg.org,mailpick.biz,mailrock.biz,mailscrap.com,mailshell.com,mailsiphon.com,mailtemp.info,mailtome.de,mailtothis.com,mailtrash.net,mailtv.net,mailtv.tv,mailzilla.com,makemetheking.com,manybrain.com,mbx.cc,mega.zik.dj,meinspamschutz.de,meltmail.com,messagebeamer.de,mezimages.net,ministry-of-silly-walks.de,mintemail.com,misterpinball.de,moncourrier.fr.nf,monemail.fr.nf,monmail.fr.nf,monumentmail.com,mt2009.com,mt2014.com,mycard.net.ua,mycleaninbox.net,mymail-in.net,mypacks.net,mypartyclip.de,myphantomemail.com,mysamp.de,mytempemail.com,mytempmail.com,mytrashmail.com,nabuma.com,neomailbox.com,nepwk.com,nervmich.net,nervtmich.net,netmails.com,netmails.net,neverbox.com,nice-4u.com,nincsmail.hu,nnh.com,no-spam.ws,noblepioneer.com,nomail.pw,nomail.xl.cx,nomail2me.com,nomorespamemails.com,nospam.ze.tc,nospam4.us,nospamfor.us,nospammail.net,notmailinator.com,nowhere.org,nowmymail.com,nurfuerspam.de,nus.edu.sg,objectmail.com,obobbo.com,odnorazovoe.ru,oneoffemail.com,onewaymail.com,onlatedotcom.info,online.ms,opayq.com,ordinaryamerican.net,otherinbox.com,ovpn.to,owlpic.com,pancakemail.com,pcusers.otherinbox.com,pjjkp.com,plexolan.de,poczta.onet.pl,politikerclub.de,poofy.org,pookmail.com,privacy.net,privatdemail.net,proxymail.eu,prtnx.com,putthisinyourspamdatabase.com,putthisinyourspamdatabase.com,qq.com,quickinbox.com,rcpt.at,reallymymail.com,realtyalerts.ca,recode.me,recursor.net,reliable-mail.com,rhyta.com,rmqkr.net,royal.net,rtrtr.com,s0ny.net,safe-mail.net,safersignup.de,safetymail.info,safetypost.de,saynotospams.com,schafmail.de,schrott-email.de,secretemail.de,secure-mail.biz,senseless-entertainment.com,services391.com,sharklasers.com,shieldemail.com,shiftmail.com,shitmail.me,shitware.nl,shmeriously.com,shortmail.net,sibmail.com,sinnlos-mail.de,slapsfromlastnight.com,slaskpost.se,smashmail.de,smellfear.com,snakemail.com,sneakemail.com,sneakmail.de,snkmail.com,sofimail.com,solvemail.info,sogetthis.com,soodonims.com,spam4.me,spamail.de,spamarrest.com,spambob.net,spambog.ru,spambox.us,spamcannon.com,spamcannon.net,spamcon.org,spamcorptastic.com,spamcowboy.com,spamcowboy.net,spamcowboy.org,spamday.com,spamex.com,spamfree.eu,spamfree24.com,spamfree24.de,spamfree24.org,spamgoes.in,spamgourmet.com,spamgourmet.net,spamgourmet.org,spamherelots.com,spamherelots.com,spamhereplease.com,spamhereplease.com,spamhole.com,spamify.com,spaml.de,spammotel.com,spamobox.com,spamslicer.com,spamspot.com,spamthis.co.uk,spamtroll.net,speed.1s.fr,spoofmail.de,stuffmail.de,super-auswahl.de,supergreatmail.com,supermailer.jp,superrito.com,superstachel.de,suremail.info,talkinator.com,teewars.org,teleworm.com,teleworm.us,temp-mail.org,temp-mail.ru,tempe-mail.com,tempemail.co.za,tempemail.com,tempemail.net,tempemail.net,tempinbox.co.uk,tempinbox.com,tempmail.eu,tempmaildemo.com,tempmailer.com,tempmailer.de,tempomail.fr,temporaryemail.net,temporaryforwarding.com,temporaryinbox.com,temporarymailaddress.com,tempthe.net,thankyou2010.com,thc.st,thelimestones.com,thisisnotmyrealemail.com,thismail.net,throwawayemailaddress.com,tilien.com,tittbit.in,tizi.com,tmailinator.com,toomail.biz,topranklist.de,tradermail.info,trash-mail.at,trash-mail.com,trash-mail.de,trash2009.com,trashdevil.com,trashemail.de,trashmail.at,trashmail.com,trashmail.de,trashmail.me,trashmail.net,trashmail.org,trashymail.com,trialmail.de,trillianpro.com,twinmail.de,tyldd.com,uggsrock.com,umail.net,uroid.com,us.af,venompen.com,veryrealemail.com,viditag.com,viralplays.com,vpn.st,vsimcard.com,vubby.com,wasteland.rfc822.org,webemail.me,weg-werf-email.de,wegwerf-emails.de,wegwerfadresse.de,wegwerfemail.com,wegwerfemail.de,wegwerfmail.de,wegwerfmail.info,wegwerfmail.net,wegwerfmail.org,wh4f.org,whyspam.me,willhackforfood.biz,willselfdestruct.com,winemaven.info,wronghead.com,www.e4ward.com,www.mailinator.com,wwwnew.eu,x.ip6.li,xagloo.com,xemaps.com,xents.com,xmaily.com,xoxy.net,yep.it,yogamaven.com,yopmail.com,yopmail.fr,yopmail.net,yourdomain.com,yuurok.com,z1p.biz,za.com,zehnminuten.de,zehnminutenmail.de,zippymail.info,zoemail.net,zomg.info";
  }

  function GetDDLVals($state,$selected = NULL){
      switch ($state) {
        case 'province':
          $arr = array("Alberta", "British Columbia", "Manitoba", "New Brunswick", "Newfoundland and Labrador", "Northwest Territories", "Nova Scotia", "Nunavut", "Ontario", "Prince Edward Island", "Quebec", "Saskatchewan", "Yukon");
          $i = 1;

          echo '<option value="">Select your Province</option>';
          foreach ($arr as $key => $value) {
            $selectOption = ($selected == $i) ? ' selected' : '';
            echo '<option value="'.$value.'">'.$value.'</option>';
            $i++;
          }
        break;
          case 'state':
            $arr = array("Alabama", "Alaska", "APO-AA", "APO-AE", "APO-AP", "Arizona", "Arkansas", "California", "Colorado", "Connecticut", "Delaware", "District of Columbia", "Florida", "Georgia", "Hawaii", "Idaho", "Illinois", "Indiana", "Iowa", "Kansas", "Kentucky", "Louisiana", "Maine", "Maryland", "Massachusetts", "Michigan", "Minnesota", "Mississippi", "Missouri", "Montana", "Nebraska", "Nevada", "New Hampshire", "New Jersey", "New Mexico", "New York", "North Carolina", "North Dakota", "Ohio", "Oklahoma", "Oregon", "Pennsylvania", "Rhode Island", "South Carolina", "South Dakota", "Tennessee", "Texas", "Utah", "Vermont", "Virginia", "Washington", "West Virginia", "Wisconsin", "Wyoming");
            $i = 1;

            echo '<option value="">Select your state</option>';
            foreach ($arr as $key => $value) {
              $selectOption = ($selected == $i) ? ' selected' : '';
              echo '<option value="'.$i.'">'.$value.'</option>';
              $i++;
            }
        break;
          case 'states-data':
            $arr = "Alabama, Alaska, Arizona, Arkansas, California, Colorado, Connecticut, Delaware, Florida, Georgia, Hawaii, Idaho, IllinoisIndiana, Iowa, Kansas, Kentucky, Louisiana, Maine, Maryland, Massachusetts, Michigan, Minnesota, Mississippi, Missouri, MontanaNebraska, Nevada, New Hampshire, New Jersey, New Mexico, New York, North Carolina, North Dakota, Ohio, Oklahoma, Oregon, PennsylvaniaRhode Island, South Carolina, South Dakota, Tennessee, Texas, Utah, Vermont, Virginia, Washington, West Virginia, Wisconsin, Wyoming";

            return $arr;
        break;
          case 'countries':
            $arr =
              array(
              "AF" => "Afghanistan",
              "AL" => "Albania",
              "DZ" => "Algeria",
              "AS" => "American Samoa",
              "AD" => "Andorra",
              "AO" => "Angola",
              "AI" => "Anguilla",
              "AQ" => "Antarctica",
              "AG" => "Antigua and Barbuda",
              "AR" => "Argentina",
              "AM" => "Armenia",
              "AW" => "Aruba",
              "AU" => "Australia",
              "AT" => "Austria",
              "AZ" => "Azerbaijan",
              "BS" => "Bahamas",
              "BH" => "Bahrain",
              "BD" => "Bangladesh",
              "BB" => "Barbados",
              "BY" => "Belarus",
              "BE" => "Belgium",
              "BZ" => "Belize",
              "BJ" => "Benin",
              "BM" => "Bermuda",
              "BT" => "Bhutan",
              "BO" => "Bolivia",
              "BA" => "Bosnia and Herzegovina",
              "BW" => "Botswana",
              "BV" => "Bouvet Island",
              "BR" => "Brazil",
              "IO" => "British Indian Ocean Territory",
              "BN" => "Brunei Darussalam",
              "BG" => "Bulgaria",
              "BF" => "Burkina Faso",
              "BI" => "Burundi",
              "KH" => "Cambodia",
              "CM" => "Cameroon",
              "CA" => "Canada",
              "CV" => "Cape Verde",
              "KY" => "Cayman Islands",
              "CF" => "Central African Republic",
              "TD" => "Chad",
              "CL" => "Chile",
              "CN" => "China",
              "CX" => "Christmas Island",
              "CC" => "Cocos (Keeling) Islands",
              "CO" => "Colombia",
              "KM" => "Comoros",
              "CG" => "Congo",
              "CD" => "Congo, the Democratic Republic of the",
              "CK" => "Cook Islands",
              "CR" => "Costa Rica",
              "CI" => "Cote D'Ivoire",
              "HR" => "Croatia",
              "CU" => "Cuba",
              "CY" => "Cyprus",
              "CZ" => "Czech Republic",
              "DK" => "Denmark",
              "DJ" => "Djibouti",
              "DM" => "Dominica",
              "DO" => "Dominican Republic",
              "EC" => "Ecuador",
              "EG" => "Egypt",
              "SV" => "El Salvador",
              "GQ" => "Equatorial Guinea",
              "ER" => "Eritrea",
              "EE" => "Estonia",
              "ET" => "Ethiopia",
              "FK" => "Falkland Islands (Malvinas)",
              "FO" => "Faroe Islands",
              "FJ" => "Fiji",
              "FI" => "Finland",
              "FR" => "France",
              "GF" => "French Guiana",
              "PF" => "French Polynesia",
              "TF" => "French Southern Territories",
              "GA" => "Gabon",
              "GM" => "Gambia",
              "GE" => "Georgia",
              "DE" => "Germany",
              "GH" => "Ghana",
              "GI" => "Gibraltar",
              "GR" => "Greece",
              "GL" => "Greenland",
              "GD" => "Grenada",
              "GP" => "Guadeloupe",
              "GU" => "Guam",
              "GT" => "Guatemala",
              "GN" => "Guinea",
              "GW" => "Guinea-Bissau",
              "GY" => "Guyana",
              "HT" => "Haiti",
              "HM" => "Heard Island and Mcdonald Islands",
              "VA" => "Holy See (Vatican City State)",
              "HN" => "Honduras",
              "HK" => "Hong Kong",
              "HU" => "Hungary",
              "IS" => "Iceland",
              "IN" => "India",
              "ID" => "Indonesia",
              "IR" => "Iran, Islamic Republic of",
              "IQ" => "Iraq",
              "IE" => "Ireland",
              "IL" => "Israel",
              "IT" => "Italy",
              "JM" => "Jamaica",
              "JP" => "Japan",
              "JO" => "Jordan",
              "KZ" => "Kazakhstan",
              "KE" => "Kenya",
              "KI" => "Kiribati",
              "KP" => "Korea, Democratic People's Republic of",
              "KR" => "Korea, Republic of",
              "KW" => "Kuwait",
              "KG" => "Kyrgyzstan",
              "LA" => "Lao People's Democratic Republic",
              "LV" => "Latvia",
              "LB" => "Lebanon",
              "LS" => "Lesotho",
              "LR" => "Liberia",
              "LY" => "Libyan Arab Jamahiriya",
              "LI" => "Liechtenstein",
              "LT" => "Lithuania",
              "LU" => "Luxembourg",
              "MO" => "Macao",
              "MK" => "Macedonia, the Former Yugoslav Republic of",
              "MG" => "Madagascar",
              "MW" => "Malawi",
              "MY" => "Malaysia",
              "MV" => "Maldives",
              "ML" => "Mali",
              "MT" => "Malta",
              "MH" => "Marshall Islands",
              "MQ" => "Martinique",
              "MR" => "Mauritania",
              "MU" => "Mauritius",
              "YT" => "Mayotte",
              "MX" => "Mexico",
              "FM" => "Micronesia, Federated States of",
              "MD" => "Moldova, Republic of",
              "MC" => "Monaco",
              "MN" => "Mongolia",
              "MS" => "Montserrat",
              "MA" => "Morocco",
              "MZ" => "Mozambique",
              "MM" => "Myanmar",
              "NA" => "Namibia",
              "NR" => "Nauru",
              "NP" => "Nepal",
              "NL" => "Netherlands",
              "AN" => "Netherlands Antilles",
              "NC" => "New Caledonia",
              "NZ" => "New Zealand",
              "NI" => "Nicaragua",
              "NE" => "Niger",
              "NG" => "Nigeria",
              "NU" => "Niue",
              "NF" => "Norfolk Island",
              "MP" => "Northern Mariana Islands",
              "NO" => "Norway",
              "OM" => "Oman",
              "PK" => "Pakistan",
              "PW" => "Palau",
              "PS" => "Palestinian Territory, Occupied",
              "PA" => "Panama",
              "PG" => "Papua New Guinea",
              "PY" => "Paraguay",
              "PE" => "Peru",
              "PH" => "Philippines",
              "PN" => "Pitcairn",
              "PL" => "Poland",
              "PT" => "Portugal",
              "PR" => "Puerto Rico",
              "QA" => "Qatar",
              "RE" => "Reunion",
              "RO" => "Romania",
              "RU" => "Russian Federation",
              "RW" => "Rwanda",
              "SH" => "Saint Helena",
              "KN" => "Saint Kitts and Nevis",
              "LC" => "Saint Lucia",
              "PM" => "Saint Pierre and Miquelon",
              "VC" => "Saint Vincent and the Grenadines",
              "WS" => "Samoa",
              "SM" => "San Marino",
              "ST" => "Sao Tome and Principe",
              "SA" => "Saudi Arabia",
              "SN" => "Senegal",
              "CS" => "Serbia and Montenegro",
              "SC" => "Seychelles",
              "SL" => "Sierra Leone",
              "SG" => "Singapore",
              "SK" => "Slovakia",
              "SI" => "Slovenia",
              "SB" => "Solomon Islands",
              "SO" => "Somalia",
              "ZA" => "South Africa",
              "GS" => "South Georgia and the South Sandwich Islands",
              "ES" => "Spain",
              "LK" => "Sri Lanka",
              "SD" => "Sudan",
              "SR" => "Suriname",
              "SJ" => "Svalbard and Jan Mayen",
              "SZ" => "Swaziland",
              "SE" => "Sweden",
              "CH" => "Switzerland",
              "SY" => "Syrian Arab Republic",
              "TW" => "Taiwan, Province of China",
              "TJ" => "Tajikistan",
              "TZ" => "Tanzania, United Republic of",
              "TH" => "Thailand",
              "TL" => "Timor-Leste",
              "TG" => "Togo",
              "TK" => "Tokelau",
              "TO" => "Tonga",
              "TT" => "Trinidad and Tobago",
              "TN" => "Tunisia",
              "TR" => "Turkey",
              "TM" => "Turkmenistan",
              "TC" => "Turks and Caicos Islands",
              "TV" => "Tuvalu",
              "UG" => "Uganda",
              "UA" => "Ukraine",
              "AE" => "United Arab Emirates",
              "GB" => "United Kingdom",
              "US" => "United States",
              "UM" => "United States Minor Outlying Islands",
              "UY" => "Uruguay",
              "UZ" => "Uzbekistan",
              "VU" => "Vanuatu",
              "VE" => "Venezuela",
              "VN" => "Viet Nam",
              "VG" => "Virgin Islands, British",
              "VI" => "Virgin Islands, U.s.",
              "WF" => "Wallis and Futuna",
              "EH" => "Western Sahara",
              "YE" => "Yemen",
              "ZM" => "Zambia",
              "ZW" => "Zimbabwe"
              );
              $i = 1;
            echo '<option value="">Select your country</option>';
            foreach ($arr as $key => $value) {
              $selectOption = ($selected == $i) ? ' selected' : '';
              echo '<option value="'.$value.'">'.$value.'</option>';
              $i++;
            }
        default:
          // code...
          break;
      }
    }


add_action('createLead' , 'createLead');
add_action('wp_ajax_nopriv_createLead','createLead');
function createLead(){
  $obj = new stdClass();
  $obj->Email = $_POST['email'];
  $obj->Lead_State__c = "Step 1";
  $obj->LastName = "UNKNOWN";
  $obj->Company = "UNKNOWN";
  $obj->LeadSource = "Website Registration";
  $obj->UTM_Campaign__c = $_POST['utm_campaign'];
  $obj->UTM_Content__c = $_POST['utm_content'];
  $obj->UTM_Medium__c = $_POST['utm_medium'];
  $obj->UTM_Source__c = $_POST['utm_source'];
  $request = json_encode($obj);

  $atData = json_decode(getSFAccessToken());



  $insertResponse = json_decode(insertLeadToSF($request,$atData->access_token,""));
  // $insertResponse = new stdClass();
  // $insertResponse->res = $insertResponse;
   //echo json_encode($insertResponse);
   //die;

  setcookie("_SFACTOK", $atData->access_token, time()+7200);  /* expire in 2 hour */

  echo json_encode($insertResponse);
  die;
}

add_action('wp_ajax_updateLeadDetails' , 'updateLeadDetails');
add_action('wp_ajax_nopriv_updateLeadDetails','updateLeadDetails');
function updateLeadDetails(){

  if(!isset($_COOKIE['_SFACTOK']) || $_COOKIE['_SFACTOK'] == ""){
      $obj = new stdClass();
      $obj->StatusCode = 403;
      echo json_encode($obj);
      die;
  }

  $userId = $_POST['uid'];
  $access_token = $_COOKIE['_SFACTOK'];

  $request = buildSFRequest($_POST,$_POST['step']);

  $response = insertLeadToSF($request,$access_token,$userId);
  echo json_encode($response);
  die;

}


function buildSFRequest($formData,$step){

    $obj = new stdClass();

    if($step == "step_2"){
      $obj->FirstName = $formData["first_name"];
      $obj->LastName = $formData["last_name"];
      $obj->Phone = $formData["phone_number"];
      $obj->Lead_State__c = "Step 2";
    }

    if($step == "submit"){
      $obj->Company = $formData["company_name"];
      // $obj->Tax_ID__c = $formData["vat_number"];
      if($formData["address2"] != ""){
          $obj->Street = $formData["address1"].", ".$formData["address2"];
      }
      else{
          $obj->Street = $formData["address1"];
      }
      $obj->City = $formData["city"];
      $obj->State_Original__c = $formData["state"];
      $obj->Country = $formData["country"];
      $obj->PostalCode = $formData["zip"];
      $obj->Lead_State__c = "Submit";

      // if($formData["import_export"]=="Neither"){
      //   $obj->Importer__c = false;
      //   $obj->Exporter__c = false;
      // }else if($formData["import_export"] == "Import"){
      //   $obj->Importer__c = true;
      //   $obj->Exporter__c = false;
      // }else if($formData["import_export"] == "Export"){
      //   $obj->Importer__c = false;
      //   $obj->Exporter__c = true;
      // }else if($formData["import_export"] == "ImportAndExport"){
      //   $obj->Importer__c = true;
      //   $obj->Exporter__c = true;
      // }


    }




    return json_encode($obj);
}

function getSFAccessToken(){

  $curl = curl_init();
  curl_setopt_array($curl, array(
    CURLOPT_URL => sf_base_url.'/services/oauth2/token',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    // CURLOPT_POSTFIELDS => 'grant_type=password&client_id='.client_id.'&client_secret='.client_secret.'&username='.username.'&password='.password,
    CURLOPT_POSTFIELDS => 'grant_type=refresh_token&client_id='.client_id.'&client_secret='.client_secret.'&refresh_token='.refresh_token,
    CURLOPT_HTTPHEADER => array(
      'Content-Type: application/x-www-form-urlencoded',
      'Cookie: BrowserId=OSpbV01nEeyBf_Py_V-v3g; CookieConsentPolicy=0:1; LSKey-c$CookieConsentPolicy=0:1'
    ),
  ));

  $response = curl_exec($curl);

  curl_close($curl);
  return $response;
}


function insertLeadToSF($data,$access_token,$userId){

  $url = sf_base_url."/services/data/v48.0/sobjects/Lead/".$userId;
  $method = ($userId != "") ? "PATCH" : "POST" ;

  $curl = curl_init();
  curl_setopt_array($curl, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => $method,
    CURLOPT_POSTFIELDS => $data,
    CURLOPT_HTTPHEADER => array(
      'Content-Type: application/json',
      'Authorization: Bearer '.$access_token
    ),
  ));

  // '{
  //    "FirstName" : "tes3t12",
  //    "LastName" : "tes32t23",
  //    "Email" : "test2231@all.io",
  //    "Importer__c" : false,
  //    "Exporter__c" : false,
  //    "Company" : "test Company",
  //    "Website" : "tes3t231.co.il",
  //    "Street" : "HaHagana",
  //    "City" : "Tel Aviv",
  //    "State_Original__c" : "test",
  //    "Country" : "Israel",
  //    "PostalCode" : "21531318",
  //    "Phone" : "0547227492",
  //    "Fax" : "086223776",
  //    "Tax_ID__c" : "12234",
  //    "Business_Registration_Number__c" : "12313456",
  //    "Industry_Original__c" :"Other",
  //    "Trade_Needs__c" : "Other",
  //    "Trade_Needs_Other__c": "Other",
  //    "Warehouse_Address__c" : "Tel-Aviv-Yafo",
  //    "Kontainers_User_Type__c" : "Secondary",
  //    "Description" : "check postman logic ",
  //    "Kontainers_Company_ID__c" : "companyId",
  //    "Kontainers_User_ID__c" : "1234",
  //    "Created_by_Kontainers__c"	 : true
  //    }'


  $response = curl_exec($curl);

  curl_close($curl);
  return $response;
}
