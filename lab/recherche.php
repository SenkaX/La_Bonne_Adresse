<?php
$bdd = new PDO('mysql:host=localhost; dbname=lba;','root','root');
$allmembers = $bdd->prepare('SELECT * FROM comp_infos ORDER BY comp_id DESC');
if(isset($_GET['research']) AND !empty($_GET['research'])){
    $search = htmlspecialchars($_GET['research']);    
    $allmembers = $bdd->query('SELECT * FROM comp_infos WHERE comp_categ Like "' .$search.'%" or comp_name LIKE "' .$search.'%" ORDER BY comp_id DESC');
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche</title>
    <link rel="stylesheet" href="style.css"> 
</head>
<body>
    <!-- Logo -->
    <form method="GET">
    <input type="search" name="research" id="searchbar" placeholder="Recherche"><br>
    <div id="trait_dessus"></div>
    <ul id="menu">
        <li id="distance"><a>Distance</a>
            <ul>
                <li><a value="0-100m">0-100m</a></li>
                <li><a value="100-300m">100-300m</a></li>
                <li><a value ="300-500m">300-500m</a></li>
                <li><a value ="300-500m">300-500m</a></li>
            </ul>
        </li>  
        <li id="theme"><a>Theme</a>
            <ul>
                <li><a value="degustation">Degustation</a></li>
                <li><a value="promotion">Promotion</a></li>
                <li><a value="promotion">Promotion</a></li>
            </ul>
        </li>
    </ul>

    <!-- <form method="GET">
        <input type="search" name="research" placeholder="Rechercher un membre">
        <input type="submit" value="recherche">-->
    </form> 


    <section class="afficher_membres">

        <?php
            if($allmembers->rowCount() > 0){
                while($member = $allmembers->fetch()){
                    ?>
        <div class="suggestions_artisan">
                <div class="pdp1">
                    <img style="width: 70px; height: 70px; border-radius: 35px" src="data/comp/<?= $member['comp_id']?>/profilimg.png" alt="">
                </div>
                
                <div class="info_artisan">
                    <div class="name1"><?= $member['comp_name'];?></div>
                    <div class="adresse1"><?= $member['comp_adress_nb']?> <?= $member['comp_adress_ext']?> <?= $member['comp_adress_name']?></div>
                </div>
            </div>
        </div>
                    <?php
                }
            }
            ?>
    </section>

    
</body>
</html>