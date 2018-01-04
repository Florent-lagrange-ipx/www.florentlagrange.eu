<body id="<?php get_page_slug(); ?>"> 
    <div class="container" data-pg-name="MAIN"> 
        <div class="row" data-pg-name="META"> 
</div>
        <div class="row" data-pg-name="TABLE DES MATIERES">
            <div class=" col-md-12 col-sm-12 col-xs-12 col-lg-12" data-pg-name="MAIN" data-pg-collapsed> 
                <p class="texte_principal modele_resume" data-pg-name="CONTENT"><?php
$d = dir("./theme/");
echo "Pointeur: ".$d->handle."<br>\n";
echo "Chemin: ".$d->path."<br>\n";
while($entry = $d->read()) {
    echo $entry."<br>\n";
}
$d->close();
?> </p> 
            </div>             
        </div>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
        <script src="js/index.js"></script>
