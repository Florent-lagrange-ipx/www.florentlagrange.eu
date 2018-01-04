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
    <?php include('main.inc.php'); ?> 
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
                    <span class="brd-headling"></span> 
                    <div class="clearfix"></div>                     
                <div class="row" data-pg-name="ARTICLE" data-pg-collapsed> 
                        <div class="col-md-2 col-md-offset-2"> 
                            <p data-pg-collapsed=""><br></p> 
                            <p data-pg-collapsed=""><a href="404.html" style="line-height: 1.42857143;">&nbsp;&nbsp;</a><br></p> 
                        </div>                         
                        <div class="col-md-2" data-pg-collapsed> 
                            <p data-pg-name="TITRE" data-pg-collapsed="" class="couleur_A"><b>Florent LAGRANGE</b><br><br></p> 
                            <p data-pg-collapsed="">Né en 1983</p> 
                            <p data-pg-collapsed="">à Montriond</p> 
                            <p data-pg-collapsed=""><i>46° 12' 33.251" N</i></p> 
                            <p data-pg-collapsed=""><i>6° 43' 45.448" E&nbsp;</i></p> 
                            <p data-pg-collapsed="">Alt : 932 m<br></p> 
                        </div>                         
                        <div data-pg-collapsed class="col-md-2"> 
                            <p data-pg-collapsed=""><br></p> 
                            <p data-pg-collapsed=""><br></p> 
                            <p data-pg-collapsed="">Artiste-chercheur</p> 
                            <p data-pg-collapsed="">Enseignant dans l'académie de Lyon</p> 
                            <p data-pg-collapsed="">Auto-entreprenneur</p> 
                        </div>                         
                        <div class="col-md-2" data-pg-collapsed> 
                            <h4>ID</h4> 
                            <p data-pg-collapsed=""> <div class="clearfix"></div><p><?php echo str_replace("\n","<br/>",return_theme_setting('contact_desc')); ?></p><div class="clearfix"></div></p> 
                        </div>                         
                        <div class="row" data-pg-name="ID" data-pg-collapsed> 
                            <div class="col-md-4" data-pg-collapsed> 
                                <div class="nine columns right"> 
                                    <h3 class="headline" data-pg-collapsed></h3> 
                                    <span class="brd-headling"></span> 
                                    <div class="clearfix"></div>                                     
                                    <p></p> 
                                    <div class="clearfix"></div>                                     
                                </div>                                 
                            </div>                             
                        </div>                         
                        <div id="content-wrapper" class="col-md-8 col-md-offset-2" data-pg-collapsed> 
                            <!-- Parallex Page Title -->                             
                            <!-- Google Maps -->                             
                            <div class="row sidebar-introduction"> 
                                <div class="col-md-12" title="///////////" data-pg-name="///////////" data-pg-collapsed> 
                                    <hr> 
                                </div>                                 
                                <div class="col-md-4"> 
                                    <h3><b>DOCUMENTATION</b></h3> 
                                </div>                                 
                                <div class="col-md-12" title="///////////" data-pg-name="///////////" data-pg-collapsed=""> 
                                    <hr> 
                                </div>                                 
                                <div class="col-md-4" data-pg-collapsed> 
                                    <i class="fa fa-pagelines"></i> 
                                    <p data-pg-name="TITRE" data-pg-collapsed class="couleur_A"><b>BIOGRAPHIE</b><br><br></p> 
                                    <p data-pg-collapsed="">Parcourir ma biographie, vous y trouverez l’<strong>itinéraire</strong> de mes <strong>expériences</strong>. Vous trouverez le document en <em>version en ligne </em>ou en <em>version téléchargeable</em><br></p> 
                                    <p data-pg-collapsed=""><br></p> 
                                    <p data-pg-collapsed><a href="http://www.florentlagrange.eu/annexes/biographie-1">Accéder &nbsp;</a><br></p> 
                                </div>                                 
                                <div data-pg-collapsed class="col-md-4"> 
                                    <i class="fa fa-street-view"></i> 
                                    <p data-pg-name="TITRE" data-pg-collapsed="" class="couleur_A"><b>CURRICULUM VITAE</b><br><br></p> 
                                    <p>Télécharger un <strong>porfolio édité 2016.</strong> Merci de me contacter si vous souhaitez des information complémentaires.<br></p> 
                                    <p data-pg-collapsed=""><br></p> 
                                    <p data-pg-collapsed=""><a href="http://www.florentlagrange.eu/annexes/curriculum-vitae/?lang=fr">Accéder &nbsp;</a><br></p> 
                                </div>                                 
                                <div data-pg-collapsed class="col-md-4"> 
                                    <i class="fa fa-newspaper-o"></i> 
                                    <p data-pg-name="TITRE" data-pg-collapsed class="couleur_A"><b>DOSSIER DE PRESSE</b><br><br></p> 
                                    <p data-pg-collapsed="">Le dossier de presse ci-contre propose une <strong>information</strong> relative aux <strong>évènements passés</strong>. Il est composé d’un&nbsp;<strong>communiqué de synthèse,</strong> d’un&nbsp;<strong>sommaire</strong>, des&nbsp;<strong>fiches</strong>, des&nbsp;<strong>annexes</strong>, des&nbsp;<strong>éléments visuels.&nbsp;</strong><br></p> 
                                    <p data-pg-collapsed=""><br></p> 
                                    <p data-pg-collapsed=""><a href="http://www.florentlagrange.eu/annexes/dossier-de-presse">Accéder &nbsp;</a><br></p> 
                                </div>                                 
                            </div>                             
                            <!-- Container -->                             
                            <div class="col-md-12" title="///////////" data-pg-name="///////////" data-pg-collapsed=""> 
                                <hr> 
                            </div>                             
                            <div class="row sidebar-introduction"> 
                                <div class="col-md-4 col-md-offset-2" data-pg-collapsed> 
                                    <h3><b>M'ÉCRIRE</b></h3> 
                                </div>                                 
                                <div class="col-md-8 col-md-offset-2"> 
                                    <section id="contact"> 
                                        <!-- Success Message -->                                         
                                        <!-- Form -->                                         
                                        <form method="post" name="contactform" id="contactform"> 
                                            <fieldset> 
                                                <div class="form-group <?php echo $HasErrorName; ?>"> 
                                                    <div> 
                                                        <p><b> 
                                                     Nom </b></p> 
                                                        <input name="txtName" type="text" id="txtName" class="form-control" style="width:96%;" value="<?php echo htmlspecialchars($Name, ENT_QUOTES, "UTF-8"); ?>" placeholder="<?php echo $set_lang['MAIL_NAME']; ?>" /> 
                                                    </div>                                                     
                                                </div>                                                 
                                                <div class="form-group <?php echo $HasErrorEmail; ?>"> 
                                                    <div> 
                                                        <p><b> 
                                                     adresse email : </b></p> 
                                                        <input name="txtEmail" type="email" id="txtEmail" class="form-control" pattern="^[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})$" style="width:96%;" value="" placeholder=""> 
                                                    </div>                                                     
                                                </div>                                                 
                                                <div class="form-group <?php echo $HasErrorBody; ?>"> 
                                                    <div> 
                                                        <p><b> 
                                                     Votre message : </b><span>*</span></p> 
                                                        <textarea name="txtBody" cols="40" rows="8" id="txtBody" class="form-control" spellcheck="true" style="width:96%;" placeholder="<?php echo $set_lang['MAIL_BODY']; ?>"><?php echo htmlspecialchars($Body, ENT_QUOTES, "UTF-8"); ?></textarea>                                                         
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
                                                </fieldset>                                                 
                                            </fieldset>                                             
                                            <hr class="sep20"> 
                                            <input type="submit" class="submit" id="cmdSendMessage" name="cmdSendMessage" value="<?php echo $set_lang['MAIL_SEND']; ?>" /> 
                                            <div class="clearfix"></div>                                             
                                        </form>                                         
                                    </section>                                     
                                </div>                                 
                            </div>                             
                            <div class="row sidebar-introduction"> 
                                <div class="col-md-4 col-md-offset-2" data-pg-collapsed> 
                                    <h3><b>RÉSEAU SOCIAUX</b></h3> 
                                </div>                                 
                                <div class="col-md-12" title="///////////" data-pg-name="///////////" data-pg-collapsed=""> 
                                    <hr> 
                                </div>                                 
                                <div class="col-md-offset-2 col-md-2" data-pg-collapsed> 
                                    <i class="fa fa-2x fa-youtube"></i> 
                                    <p class="contact_social">Youtube</p> 
                                    <p>Florent Lagrange</p> 
                                    <p><a class="DashboardProfileCard-screennameLink u-linkComplex u-linkClean" href="https://www.youtube.com/channel/UCL-6zX8jkAHCNmZSWF0vJLw" rel="noopener" style="color: rgb(102, 117, 127); font-size: 12px; padding-right: 5px; font-family: Arial, sans-serif; font-variant-ligatures: normal; orphans: 2; widows: 2; text-decoration: none !important; background: rgb(255, 255, 255);"><span class="u-linkComplex-target">&gt;&gt;&gt;</span></a></p> 
                                    <p><br></p> 
                                </div>                                 
                                <div data-pg-collapsed class="col-md-2"> 
                                    <i class="fa fa-2x fa-twitter"></i> 
                                    <p class="contact_social">Twitter</p> 
                                    <p><b><a>Florent Lagrange</a></b></p> 
                                    <p><a class="DashboardProfileCard-screennameLink u-linkComplex u-linkClean" href="https://twitter.com/florentlagrange" rel="noopener" style="color: rgb(102, 117, 127); font-size: 12px; padding-right: 5px; font-family: Arial, sans-serif; font-variant-ligatures: normal; orphans: 2; widows: 2; text-decoration: none !important; background: rgb(255, 255, 255);"><span class="u-linkComplex-target">&gt;&gt;&gt;</span></a></p> 
                                    <p><br></p> 
                                </div>                                 
                                <div data-pg-collapsed class="col-md-2"> 
                                    <i class="fa fa-2x fa-pinterest-square"></i> 
                                    <p class="contact_social">Pinterest</p> 
                                    <p><b>Flkz factory</b></p> 
                                    <p><a class="DashboardProfileCard-screennameLink u-linkComplex u-linkClean" href="https://fr.pinterest.com/flkzfactory/" rel="noopener" style="color: rgb(102, 117, 127); font-size: 12px; padding-right: 5px; font-family: Arial, sans-serif; font-variant-ligatures: normal; orphans: 2; widows: 2; text-decoration: none !important; background: rgb(255, 255, 255);"><span class="u-linkComplex-target">&gt;&gt;&gt;</span></a></p> 
                                    <p><br></p> 
                                </div>                                 
                                <div data-pg-collapsed class="col-md-2"> 
                                    <i class="fa fa-skype fa-2x"></i> 
                                    <p class="contact_social">Skype</p> 
                                    <p><b>Alpin Hologramm</b></p> 
                                    <p><a class="DashboardProfileCard-screennameLink u-linkComplex u-linkClean" href="https://twitter.com/florentlagrange" rel="noopener" style="color: rgb(102, 117, 127); font-size: 12px; padding-right: 5px; font-family: Arial, sans-serif; font-variant-ligatures: normal; orphans: 2; widows: 2; text-decoration: none !important; background: rgb(255, 255, 255);"><span class="u-linkComplex-target">&gt;&gt;&gt;</span></a></p> 
                                    <p><br></p> 
                                </div>                                 
                                <div data-pg-collapsed class="col-md-2 col-md-offset-2"> 
                                    <i class="fa fa-2x fa-google-plus-circle"></i> 
                                    <p class="contact_social">Google +</p> 
                                    <p><b>Alpin Hologramm</b></p> 
                                    <p><a class="DashboardProfileCard-screennameLink u-linkComplex u-linkClean" href="https://plus.google.com/u/0/109568725727326113093" rel="noopener" style="color: rgb(102, 117, 127); font-size: 12px; padding-right: 5px; font-family: Arial, sans-serif; font-variant-ligatures: normal; orphans: 2; widows: 2; text-decoration: none !important; background: rgb(255, 255, 255);"><span class="u-linkComplex-target">&gt;&gt;&gt;</span></a></p> 
                                    <p><br></p> 
                                </div>                                 
                                <div data-pg-collapsed class="col-md-2"> 
                                    <i class="fa fa-2x fa-git-square"></i> 
                                    <p class="contact_social">Github</p> 
                                    <p><b>AlpinHologramm</b></p> 
                                    <p><a class="DashboardProfileCard-screennameLink u-linkComplex u-linkClean" href="https://github.com/AlpinHologramm" rel="noopener" style="color: rgb(102, 117, 127); font-size: 12px; padding-right: 5px; font-family: Arial, sans-serif; font-variant-ligatures: normal; orphans: 2; widows: 2; text-decoration: none !important; background: rgb(255, 255, 255);"><span class="u-linkComplex-target">&gt;&gt;&gt;</span></a></p> 
                                    <p><br></p> 
                                </div>                                 
                                <div data-pg-collapsed class="col-md-2"> 
                                    <i class="fa fa-2x fa-behance-square"></i> 
                                    <p class="contact_social">Behance</p> 
                                    <p><b>Florent Lagrange</b></p> 
                                    <p><a class="DashboardProfileCard-screennameLink u-linkComplex u-linkClean" href="https://github.com/AlpinHologramm" rel="noopener" style="color: rgb(102, 117, 127); font-size: 12px; padding-right: 5px; font-family: Arial, sans-serif; font-variant-ligatures: normal; orphans: 2; widows: 2; text-decoration: none !important; background: rgb(255, 255, 255);"><span class="u-linkComplex-target">&gt;&gt;&gt;</span></a></p> 
                                    <p><br></p> 
                                </div>                                 
                                <div data-pg-collapsed class="col-md-2"> 
                                    <i class="fa fa-2x fa-rss-square"></i> 
                                    <p class="contact_social">Flux Rss</p> 
                                    <p><b>rss</b></p> 
                                    <p><a class="DashboardProfileCard-screennameLink u-linkComplex u-linkClean" href="http://www.florentlagrange.eu/rss.php" rel="noopener" style="color: rgb(102, 117, 127); font-size: 12px; padding-right: 5px; font-family: Arial, sans-serif; font-variant-ligatures: normal; orphans: 2; widows: 2; text-decoration: none !important; background: rgb(255, 255, 255);"><span class="u-linkComplex-target">&gt;&gt;&gt;</span></a></p> 
                                    <p><br></p> 
                                </div>                                 
                                <div data-pg-collapsed class="col-md-2 col-md-offset-2"> 
                                    <i class="fa fa-2x fa-snapchat-ghost"></i> 
                                    <p class="contact_social">Snapchat</p> 
                                    <p><b>Alpin Hologramm</b></p> 
                                    <p><a class="DashboardProfileCard-screennameLink u-linkComplex u-linkClean" href="http://www.florentlagrange.eu/rss.php" rel="noopener" style="color: rgb(102, 117, 127); font-size: 12px; padding-right: 5px; font-family: Arial, sans-serif; font-variant-ligatures: normal; orphans: 2; widows: 2; text-decoration: none !important; background: rgb(255, 255, 255);"><span class="u-linkComplex-target">&gt;&gt;&gt;</span></a></p> 
                                    <p><br></p> 
                                </div>                                 
                                <div data-pg-collapsed class="col-md-2"> 
                                    <i class="fa fa-2x fa-bitcoin"></i> 
                                    <p class="contact_social">Bitcoin</p> 
                                    <p><b>Alpin Hologramm</b></p> 
                                    <p><a class="DashboardProfileCard-screennameLink u-linkComplex u-linkClean" href="http://www.florentlagrange.eu/rss.php" rel="noopener" style="color: rgb(102, 117, 127); font-size: 12px; padding-right: 5px; font-family: Arial, sans-serif; font-variant-ligatures: normal; orphans: 2; widows: 2; text-decoration: none !important; background: rgb(255, 255, 255);"><span class="u-linkComplex-target">&gt;&gt;&gt;</span></a></p> 
                                    <p><br></p> 
                                </div>                                 
                                <div data-pg-collapsed class="col-md-2"> 
                                    <i class="fa fa-2x fa-soundcloud"></i> 
                                    <p class="contact_social">Soundcloud</p> 
                                    <p><b>flkz-1</b></p> 
                                    <p><a class="DashboardProfileCard-screennameLink u-linkComplex u-linkClean" href="http://www.florentlagrange.eu/rss.php" rel="noopener" style="color: rgb(102, 117, 127); font-size: 12px; padding-right: 5px; font-family: Arial, sans-serif; font-variant-ligatures: normal; orphans: 2; widows: 2; text-decoration: none !important; background: rgb(255, 255, 255);"><span class="u-linkComplex-target">&gt;&gt;&gt;</span></a></p> 
                                    <p><br></p> 
                                </div>                                 
                                <div data-pg-collapsed class="col-md-2"> 
                                    <i class="fa fa-2x fa-vine"></i> 
                                    <p class="contact_social">Viméo</p> 
                                    <p><b>Lagrange Florent</b></p> 
                                    <p><a class="DashboardProfileCard-screennameLink u-linkComplex u-linkClean" href="http://www.florentlagrange.eu/rss.php" rel="noopener" style="color: rgb(102, 117, 127); font-size: 12px; padding-right: 5px; font-family: Arial, sans-serif; font-variant-ligatures: normal; orphans: 2; widows: 2; text-decoration: none !important; background: rgb(255, 255, 255);"><span class="u-linkComplex-target">&gt;&gt;&gt;</span></a></p> 
                                    <p><br></p> 
                                </div>                                 
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
