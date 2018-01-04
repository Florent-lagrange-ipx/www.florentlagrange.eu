<?php if(!defined('IN_GS')){ die('you cannot load this page directly.'); }
/****************************************************
*
* @File:      contact.php
* @Package:   GetSimple
* @Action:    GS Evolve for GetSimple CMS
*
*****************************************************/

include('header.inc.php');

$e_mail = simple_c_default_email();
// Remove all illegal characters from email
$e_mail = filter_var($e_mail, FILTER_SANITIZE_EMAIL);

$Name = '';
$Email = '';
$Body = '';
$Subject = get_site_name(false);

$HasErrorName = '';
$HasErrorEmail = '';
$HasErrorSubject = '';
$HasErrorBody = '';
$HasErrorCaptcha = '';

$FormError = '';
$MailError = false;
$Success = false;

if (isset($_POST['cmdSendMessage'])) {
  $Name = $_POST['txtName'];
  $Email = $_POST['txtEmail'];
  $Body = $_POST['txtBody'];
  $Captcha = $_POST['captcha'];

  session_start();

  if (empty($Name)) {
    $HasErrorName = "has-error";
    $FormError .= "<li>".$set_lang['MAIL_BAD_NAME']."</li>";
  }
  if (filter_var($Email, FILTER_VALIDATE_EMAIL) === false) {
    $HasErrorEmail = "has-error";
    $FormError .= "<li>".$set_lang['MAIL_BAD_ADR']."</li>";
  }
  if (empty($Body)) {
    $HasErrorBody = "has-error";
    $FormError .= "<li>".$set_lang['MAIL_BAD_BODY']."</li>";
  }
  if (empty($Captcha) || $Captcha != $_SESSION['digit']) {
		$HasErrorCaptcha = "has-error";
		$FormError .= "<li>".$set_lang['CAPTCHA_ERROR']."</li>";
  }

  if (empty($FormError)) {
    $content = nl2br($Body);
	$content = trim($content);
	$message = '<html><body>'.$content.'</body></html>';
	$headers = "From: " . strip_tags($Email) . "\r\n";
	$headers .= "Reply-To: ". strip_tags($Email) . "\r\n";
	$headers .= 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
    if (@mail($e_mail, $Subject, $message, $headers)) {
      $Success = true;
      $Body = '';
	  $message = '';
    } else {
      $MailError = true;
    }
  }
}

?>
    <div id="content-wrapper">
        <!-- Parallex Page Title -->
        <?php	if(return_theme_setting('gmaps')==1) { ?>
            <?php include('main_contact.inc.php'); ?>
            <!-- Google Maps -->
            <section class="google-map-container" data-pg-collapsed>
                <article>
                    <div id="map"></div>
                </article>
            </section>
        <?php } ?>
        <!-- Container -->
        <div class="container" data-pg-collapsed>
            <div class="seven columns">
                <?php if (!empty($FormError)) { ?>
                    <div class="alert alert-dismissable alert-danger">
                        <button data-dismiss="alert" class="close" type="button">x</button>
                        <?php echo $set_lang['MAIL_ERR_SEND']; ?>
                        <ul>
                            <?php echo $FormError; ?>
                        </ul>
                    </div>
                    <?php } else if ($MailError) { ?>
                    <div class="alert alert-dismissable alert-danger">
                        <button data-dismiss="alert" class="close" type="button">x</button>
                        <?php echo $set_lang['MAIL_ERR_MAIL']; ?>
                    </div>
                    <?php } else if ($Success) { ?>
                    <div class="alert alert-dismissable alert-success">
                        <button data-dismiss="alert" class="close" type="button">x</button>
                        <?php echo $set_lang['MAIL_SEND_SEC']; ?>
                    </div>
                    <?php }
			if (!filter_var($e_mail, FILTER_VALIDATE_EMAIL) === false) { ?>
                    <h3 class="headline"><?php echo $set_lang['CONTACT_MESS']; ?></h3>
                    <span class="brd-headling"></span>
                    <div class="clearfix"></div>
                    <section class="pg-empty-placeholder"></section>
                    <div class="row" data-pg-collapsed>
                        <div class="col-md-4"> 
</div>
                        <div class="col-md-4">
                            <section id="contact" data-pg-collapsed>
                                <!-- Success Message -->
                                <mark id="message"></mark>
                                <!-- Form -->
                                <form method="post" name="contactform" id="contactform">
                                    <fieldset>
                                        <div class="form-group <?php echo $HasErrorName; ?>">
                                            <div>
                                                <label for="txtName" accesskey="U">
                                                    <?php echo $set_lang['CONTACT_NAME']; ?>
                                                </label>
                                                <input name="txtName" type="text" id="txtName" class="form-control" style="width:96%;" value="<?php echo htmlspecialchars($Name, ENT_QUOTES, "UTF-8"); ?>" placeholder="<?php echo $set_lang['MAIL_NAME']; ?>" />
                                            </div>
                                        </div>
                                        <div class="form-group <?php echo $HasErrorEmail; ?>">
                                            <div>
                                                <label for="txtEmail" accesskey="E">E-mail:
                                                    <span>*</span>
                                                </label>
                                                <input name="txtEmail" type="email" id="txtEmail" class="form-control" pattern="^[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})$" style="width:96%;" value="<?php echo htmlentities($Email); ?>" placeholder="<?php echo $set_lang['MAIL_EMAIL']; ?>" />
                                            </div>
                                        </div>
                                        <div class="form-group <?php echo $HasErrorBody; ?>">
                                            <div>
                                                <label for="txtBody" accesskey="C">
                                                    <?php echo $set_lang['CONTACT_TXT']; ?>
                                                    <span>*</span>
                                                </label>
                                                <textarea name="txtBody" cols="40" rows="3" id="txtBody" class="form-control" spellcheck="true" style="width:96%;" placeholder="<?php echo $set_lang['MAIL_BODY']; ?>"><?php echo htmlspecialchars($Body, ENT_QUOTES, "UTF-8"); ?></textarea>
                                            </div>
                                        </div>
                                        <fieldset class="captcha-form <?php echo $HasErrorCaptcha; ?>">
                                            <legend class="captcha-legend control-label">
                                                <?php echo $set_lang['CAPTCHA_DESC']; ?>
                                            </legend>
                                            <div class="<?php echo $HasErrorCaptcha; ?>">
                                                <p><img id="captcha" src="<?php get_theme_url(); ?>/antispam/captcha.php" width="160" height="45" border="1" alt="CAPTCHA"> <small><a href="#" onclick="document.getElementById('captcha').src = '<?php get_theme_url(); ?>/antispam/captcha.php?' + Math.random();
									document.getElementById('captcha_code').value = '';
									return false;"><?php echo $set_lang['CAPTCHA_RELOAD']; ?></a></small></p>
                                                <p><label class="control-label">CAPTCHA
                                                        <strong>*</strong>
                                                    </label><input id="captcha_code" type="text" name="captcha" size="6" maxlength="5" onkeyup="this.value = this.value.replace(/[^\d]+/g, '');" required=""> <small><?php echo $set_lang['CAPTCHA_TEXT']; ?></small></p>
                                            </div>
                                        </fieldset>
                                    </fieldset>
                                    <hr class="sep20">
                                    <input type="submit" class="submit" id="cmdSendMessage" name="cmdSendMessage" value="<?php echo $set_lang['MAIL_SEND']; ?>" />
                                    <div class="clearfix"></div>
                                </form>
                            </section>                             
                        </div>
                    </div>
                    <!-- Contact Form -->
                    <?php } else { ?>
                    <div class="alert alert-danger">
                        <?php echo $set_lang['MAIL_ERR_ADM']; ?>
                    </div>
                <?php } ?>
                <!-- Contact Form / End -->
            </div>
            <div class="nine columns right">
                <h3 class="headline"><?php echo $set_lang['CONTACT_INFO']; ?></h3>
                <span class="brd-headling"></span>
                <div class="clearfix"></div>
                <?php if(return_theme_setting('contact_photo')) {
				$contact_photo = return_theme_setting('contact_photo');
				$img_thumb = str_replace("uploads", "thumbs", $contact_photo);
			   ?>
                    <div class="portfolio-item media" style="width:155px;margin-bottom:20px;">
                        <div class="mediaholder">
                            <a href="<?php get_theme_setting('contact_photo'); ?>" class="mfp-image" title="My photo">
                                <img alt="" src="<?php echo $img_thumb; ?>">
                                <div style="opacity: 0;" class="hovercover">
                                    <div style="top: 65%; opacity: 0;" class="hovericon">
                                        <i class="hoverzoom"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php } ?>
                <p><?php echo str_replace("\n","<br/>",return_theme_setting('contact_desc')); ?></p>
                <div class="four columns" style="border-bottom:1px solid #eee; margin-right:0px; border-right:1px solid #eee;">
                    <div class="featured-box" data-animated="flipInX">
                        <div class="circle-2">
                            <i class="typcn typcn-location-outline"></i>
                        </div>
                        <div class="featured-desc-2">
                            <h3><?php echo $set_lang['CONTACT_ADDRESS']; ?></h3>
                            <p><?php get_theme_setting('address'); ?></p>
                        </div>
                    </div>
                </div>
                <div class="four columns" style="border-bottom:1px solid #eee; margin-left:0px;">
                    <div class="featured-box" data-animated="flipInX" style="margin-left:20px;	">
                        <div class="circle-2">
                            <i class="typcn typcn-phone-outline"></i>
                        </div>
                        <div class="featured-desc-2">
                            <h3><?php echo $set_lang['CONTACT_PHONE']; ?></h3>
                            <p><?php get_theme_setting('contact_phone'); ?></p>
                        </div>
                    </div>
                </div>
                <div class="four columns" style="border-right:1px solid #eee;">
                    <div class="featured-box" data-animated="flipInX">
                        <div class="circle-2">
                            <i class="typcn typcn-mail"></i>
                        </div>
                        <div class="featured-desc-2">
                            <h3><?php echo $set_lang['CONTACT_EMAIL']; ?></h3>
                            <p><?php get_theme_setting('contact_email'); ?></p>
                        </div>
                    </div>
                </div>
                <div class="four columns">
                    <div class="featured-box" data-animated="flipInX">
                        <div class="circle-2">
                            <i class="typcn typcn-user-outline"></i>
                        </div>
                        <div class="featured-desc-2">
                            <h3><?php echo $set_lang['CONTACT_SUPPORT']; ?></h3>
                            <p><?php get_theme_setting('contact_support'); ?></p>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <!-- Container / End -->
        <script type="text/javascript">
var alertRem = document.getElementsByClassName("close")[0];
if (typeof(alertRem) != 'undefined' && alertRem != null) {
	var alertDiv = document.getElementsByClassName("alert")[0];
	alertDiv.onclick = function() {this.parentNode.removeChild(this);}
}
</script>
        <?php include('footer.inc.php'); ?>
