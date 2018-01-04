<body id="<?php get_page_slug(); ?>"> 
    <div class="container" data-pg-name="MAIN"> 
        <div class="row" data-pg-name="META"> 
</div>
        <br />
        <br />
        <div class="row" data-pg-collapsed data-pg-name="ARTICLE">
            <div class="row" data-pg-name="TABLE DES MATIERES">
                <hr class="hr_titre" />
                <div class="col-md-3 col-sm-3 col-xs-3 col-lg-3" data-pg-name="TABLE">
                    <div class="block_menu">
                        <div id="menu" data-pg-collapsed data-pgc="test">
                            <div class="test"></div>
                            <div class="menus vertical-menu">
                                <nav class="menu-1">
                                    <div>
                                        <ul>
                                            <li class="active" data-menu="dashboard">
                                                <a href="#"><span class="item-icon"><i class="fa fa-file-o"></i></span><span class="item-text">Introduction</span></a>
                                            </li>
                                            <li data-menu="email">
                                                <a href="#"><span class="item-icon"><i class="fa fa-file-o"></i></span><span class="item-text">Messages</span></a>
                                            </li>
                                            <li data-menu="something">
                                                <a href="#"><span class="item-icon"><i class="fa fa-file-o"></i></span><span class="item-text">Something</span></a>
                                            </li>
                                        </ul>
                                    </div>
                                </nav>
                                <nav class="menu-2">
                                    <div data-menu="dashboard">
                                        <ul>
                                            <li>
                                                <a href="https://www.w3schools.com/html/default.asp" target="content"><span class="item-icon"><i class="fa fa-file-o"></i></span><span class="item-text">Dashboard</span></a>
                                            </li>
                                            <li>
                                                <a href="https://www.w3schools.com/css/default.asp" target="content"><span class="item-icon"><i class="fa fa-file-o"></i></span><span class="item-text">Notifications</span></a>
                                            </li>
                                            <li class="active">
                                                <a href="#"><span class="item-icon"><i class="fa fa-file-o"></i></span><span class="item-text">Profile</span></a>
                                            </li>
                                            <li>
                                                <a href="#"><span class="item-icon"><i class="fa fa-sign-out"></i><i class="fa fa-exclamation fa-stack-1x item-notification"></i></span><span class="item-text">Logout</span></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="hidden" data-menu="email">
                                        <ul>
                                            <li>
                                                <a href="#"><span class="item-icon"><i class="fa fa-envelope"></i><i class="fa fa-exclamation fa-stack-1x item-notification"></i></span><span class="item-text">Email</span></a>
                                            </li>
                                            <li>
                                                <a href="#"><span class="item-icon"><i class="fa fa-comment"></i><i class="fa fa-exclamation fa-stack-1x item-notification active"></i></span><span class="item-text">Chats</span></a>
                                            </li>
                                            <li>
                                                <a href="#"><span class="item-icon"><i class="fa fa-calendar"></i><i class="fa fa-exclamation fa-stack-1x item-notification"></i></span><span class="item-text">Calendar</span></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="hidden" data-menu="something">
                                        <ul>
                                            <li>
                                                <a href="#"><span class="item-icon"><i class="fa fa-film"></i><i class="fa fa-exclamation fa-stack-1x item-notification"></i></span><span class="item-text">Film</span></a>
                                            </li>
                                            <li>
                                                <a href="#"><span class="item-icon"><i class="fa fa-folder-open"></i><i class="fa fa-exclamation fa-stack-1x item-notification"></i></span><span class="item-text">Random thing</span></a>
                                            </li>
                                            <li>
                                                <a href="#"><span class="item-icon"><i class="fa fa-quote-right"></i><i class="fa fa-exclamation fa-stack-1x item-notification"></i></span><span class="item-text">Stories</span></a>
                                            </li>
                                        </ul>
                                    </div>
                                </nav>
                            </div>
                            <div class="handle">
                                <div class="handle-table">
                                    <div class="handle-table-cell">
</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" data-pg-name="TABLE DES MATIERES">
</div>
                </div>
                <div class="col-md-9 col-sm-9 col-xs-9 col-lg-9" data-pg-name="PUBLICATION" data-pg-collapsed>
                    <div class="row">
                        <div class="col-md-8 col-lg-8 col-sm-8 col-xs-8 block_textes" data-pg-collapsed>
                            <p class="declaration_ref">|Data : P001]</p>
                            <p><b>Choix</b></p>
                            <p><b><br></b></p>
                            <div class=" block_textes col-md-12 col-sm-12 col-xs-12 col-lg-12" data-pg-name="MAIN" data-pg-collapsed> 
                                <p class="texte_principal modele_resume" data-pg-name="CONTENT"><?php
$d = dir("./theme/theme-florent_lagrange_V1-3");

echo "Chemin: ".$d->path."<br>\n";
while($entry = $d->read()) {
    echo $entry."<br>\n";
}
$d->close();
?> </p> 
                            </div>
                        </div>
                        <div class="col-md-8 col-lg-8 col-sm-8 col-xs-8 block_textes" data-pg-collapsed>
                            <p class="declaration_ref">|Data : P001]</p>
                            <p><b>Choix</b></p>
                            <p><b><br></b></p>
                            <div class=" block_textes col-md-12 col-sm-12 col-xs-12 col-lg-12" data-pg-name="MAIN" data-pg-collapsed> 
                                <p class="texte_principal modele_resume" data-pg-name="CONTENT"><?php
$d = dir("./theme/");

echo "Chemin: ".$d->path."<br>\n";
while($entry = $d->read()) {
    echo $entry."<br>\n";
}
$d->close();
?> </p> 
                            </div>
                        </div>
                        <div class="col-md-8 col-lg-8 col-sm-8 col-xs-8 block_textes" data-pg-collapsed>
                            <p class="declaration_ref">|Data : P001]</p>
                            <p><b>Choix</b></p>
                            <p><b><br></b></p>
                            <div class=" block_textes col-md-12 col-sm-12 col-xs-12 col-lg-12" data-pg-name="MAIN" data-pg-collapsed> 
                                <p class="texte_principal modele_resume" data-pg-name="CONTENT"><?php
$d = dir("./theme/");

echo "Chemin: ".$d->path."<br>\n";
while($entry = $d->read()) {
    echo $entry."<br>\n";
}
$d->close();
?> </p> 
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 col-lg-8 col-sm-8 col-xs-8 col-md-offset-1 col-sm-offset-1 col-xs-offset-1 col-lg-offset-1 block_textes" data-pg-collapsed>
                            <p class="declaration_ref">|Data : P001]</p>
                            <p><b>Série</b></p>
                            <p><b><br></b></p>
                            <p>Le process précède le « schème »</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 col-lg-8 col-sm-8 col-xs-8 col-md-offset-1 col-sm-offset-1 col-xs-offset-1 col-lg-offset-1 block_textes" data-pg-collapsed>
                            <p class="declaration_ref">|Data : P001]</p>
                            <p><b>Opération</b></p>
                            <p><b><br></b></p>
                            <p>Horloge, Cycle, Temps. Opérations production matérielle conçue et fabriquée par l’homme Vitae activa et contemplative</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 col-lg-8 col-sm-8 col-xs-8 col-md-offset-1 col-sm-offset-1 col-xs-offset-1 col-lg-offset-1 block_textes" data-pg-collapsed>
                            <p class="declaration_ref">|Data : P001]</p>
                            <p><b>Expérience</b></p>
                            <p><b><br></b></p>
                            <p>Est issu d’un mélange d’observation empirique, d’interprétations
psychologique, et une tentative de formalisation des idées dans un dispositif.&nbsp;<br></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" data-pg-collapsed data-pg-name="A">
                <div class="col-md-8 col-md-offset-4 col-sm-offset-4 col-xs-offset-4 col-xs-8 col-sm-8 col-lg-8 col-lg-offset-4" data-pg-collapsed data-pg-name="PUBLICATION">
                    <div class="block">
                        <p class="couleur_Recherche" data-pg-name="No"><b class="numero couleur_Recherche">Notes de lecture 01</b></p>
                        <p data-pg-collapsed="" data-pg-name="APERCU">Pierre Boulez - FRAGMENT</p>
                    </div>
                    <div class="block">
                        <p class="couleur_Recherche" data-pg-name="No"><b class="numero couleur_Recherche">Notes de lecture 01</b></p>
                        <p data-pg-collapsed="" data-pg-name="APERCU">Panofsky - FRAGMENT</p>
                    </div>
                    <div class="block">
                        <p class="couleur_Recherche" data-pg-name="No"><b class="numero couleur_Recherche">Notes de lecture 01</b></p>
                        <p data-pg-collapsed="" data-pg-name="APERCU">Gilles DELEUZE</p>
                    </div>
                    <div class="block">
                        <p class="couleur_Recherche" data-pg-name="No"><b class="numero couleur_Recherche">Notes de lecture 01</b></p>
                        <p data-pg-collapsed="" data-pg-name="APERCU">Frederick KITLER</p>
                    </div>
                    <div class="block">
                        <p class="couleur_Recherche" data-pg-name="No"><b class="numero couleur_Recherche">Notes de lecture 01</b></p>
                        <p data-pg-collapsed="" data-pg-name="APERCU">Hans HAACKE</p>
                    </div>
                    <div class="block">
                        <p class="couleur_Recherche" data-pg-name="No"><b class="numero couleur_Recherche">Notes de lecture 01</b></p>
                        <p data-pg-collapsed="" data-pg-name="APERCU">Michel FOUCAULT</p>
                    </div>
                    <div class="block">
                        <p class="couleur_Recherche" data-pg-name="No"><b class="numero couleur_Recherche">Notes de lecture 01</b></p>
                        <p data-pg-collapsed="" data-pg-name="APERCU">Gene YOUNGBLOOD</p>
                    </div>
                </div>
            </div>
        </div>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
        <script src="js/index.js"></script>
