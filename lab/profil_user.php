<?php
if(!isset($_SESSION['connecte'])){ 
    header("Location:index.php");
}elseif($_SESSION['connecte']==True){
    if ($_SESSION['mode']=="user" ){
        $username = filter_input(INPUT_POST, "username");
        $pwd = filter_input(INPUT_POST, "pwd");
        $maRequete = $pdo->prepare("SELECT * FROM user_infos WHERE `user_id` = :id_user ");
        $maRequete->execute([
            ":id_user" => $_SESSION['username']
        ]);
        $maRequete->setFetchMode(PDO::FETCH_ASSOC);
        $log = $maRequete->fetch();
        if(($_SERVER["REQUEST_METHOD"] == "POST") && (isset($_POST['content_ad']))) {
            $title = filter_input(INPUT_POST, "title");
            $username = filter_input(INPUT_POST, "username");
            $phone = filter_input(INPUT_POST, "phone");
            $website = filter_input(INPUT_POST, "website");
            $desc = filter_input(INPUT_POST, "desc");
            $ad_nb = filter_input(INPUT_POST, "ad_nb");
            $ad_ext = filter_input(INPUT_POST, "ad_ext");
            $ad_lb = filter_input(INPUT_POST, "ad_lb");
            $ad_cp = filter_input(INPUT_POST, "ad_cp");
            $ad_city = filter_input(INPUT_POST, "ad_city");
            $comp_categ = filter_input(INPUT_POST, "comp_categ");
            $pwd = filter_input(INPUT_POST, "pwd");
            $pwd_hash =  password_hash($pwd, PASSWORD_DEFAULT);
            
            $maRequete2 = $pdo->prepare("SELECT user_email,comp_email FROM user_infos,comp_infos WHERE user_infos.user_email = :id_user OR comp_infos.comp_email = :id_user ");
            $maRequete2->execute(['id_user' => $username]);
            $verifuse = $maRequete2->fetch(); 
            if (!$verifuse){
                $maRequete = $pdo->prepare("INSERT INTO comp_infos (comp_name,comp_email,comp_phone,comp_website,comp_desc,comp_adress_nb,comp_adress_ext,comp_adress_name,comp_adress_cp,comp_adress_city,comp_pwd,comp_categ) VALUES (:title,:username,:phone,:website,:descr,:ad_nb,:ad_ext,:ad_lb,:ad_cp,:ad_city,:pwd,:comp_categ) ");
                $maRequete->execute(array(
                    'title' => $title,
                    'phone'=> $phone,
                    'website'=>$website,
                    'descr'=>$desc,
                    'ad_nb'=>$ad_nb,
                    'ad_ext'=>$ad_ext,
                    'ad_lb'=>$ad_lb,
                    'ad_cp'=>$ad_cp,
                    'ad_city'=>$ad_city,
                    'comp_categ'=>$comp_categ,
                    'username' => $username,
                    'pwd' => $pwd_hash        
                ));
            }elseif($verifuse){
                echo "<span style='color:red'>Cette email est déja disponnible veuillez en utiliser un autre.</span>";
            }

        }

?>  
<section id="e_add">

    <div class="profil_consommateur">
    <button id="add_e" type="submit" name="content_log" class="Validation_connexion_Artisan2" >Ajouter votre enseigne</button>
    </div>
    <a href="logout.php" style="text-decoration:none" class="material-symbols-outlined">logout</a>

    <div class="barre">
        <button class="preferences" onclick="colorBarre()">Préférences</button>
        <button class="suggestions" onclick="colorBarre()">Suggestions</button>

    </div>
    <section id="div1">
        <div class="pref_user">
            <button class="pref1" onclick="changeColorPref1()">Viande</button>
            <button class="pref2" onclick="changeColorPref2()">Poisson</button>
            <button class="pref3" onclick="changeColorPref3()">Pain</button>
            <button class="pref4" onclick="changeColorPref4()">Légume</button>
            <button class="pref5" onclick="changeColorPref5()">Alcool</button>
            <button class="pref6" onclick="changeColorPref6()">Fruit</button>
        </div>
    </section>
    <section id="div2" >
        <div class="suggestion_page">
            <div class="suggestions_artisan">
                <div class="pdp1">
                    <img style="width: 70px; height: 70px; border-radius: 35px" src="https://media.istockphoto.com/vectors/funny-cartoon-sign-of-a-baker-holding-a-delicious-bread-vector-id1197801200?k=20&m=1197801200&s=612x612&w=0&h=qo1kFzjCG_-3w8N0lYN92efmxEvQzy2b2zRc8v4VCV0=" alt="">
                </div>
                
                <div class="info_artisan">
                    <div class="name1">Pain d'épice</div>
                    <div class="adresse1">7 rue pain, Paris</div>
                </div>
            </div>
        </div>
        <div class="suggestions_artisan">
                <div class="pdp1">
                    <img style="width: 70px; height: 70px; border-radius: 35px" src="https://epiceries.imgix.net/shop_images/324111/original/177833_0003_f_1598456873.jpg?ixlib=rails-4.2.0&auto=format%2Ccompress&fit=crop&crop=faces&mark=https%3A%2F%2Fepiceries.imgix.net%2Fwatermarks%2Fdf1b8683-da83-494a-8846-6801ee45d4c5%2Fimages%2FLOGO_SUPER_COMMERCANT-FOND.png%3Fixlib%3Drails-4.2.0&markalign=bottom%2Cleft&markh=48&markpad=16&1623432642" alt="">
                </div>
                
                <div class="info_artisan">
                    <div class="name1">Le fruit de Paris</div>
                    <div class="adresse1">5 rue fruit, Paris</div>
                </div>
            </div>
        </div>            <div class="suggestions_artisan">
                <div class="pdp1">
                    <img style="width: 70px; height: 70px; border-radius: 35px" src="https://www.unjourencaledonie.com/wp-content/uploads/2018/07/boeuf-de-kobe-mysono-tokyo_03.jpg" alt="">
                </div>
                
                <div class="info_artisan">
                    <div class="name1">Akabe</div>
                    <div class="adresse1">1 rue kobe, Paris</div>
                </div>
            </div>
        </div>
    </div>
    </section>
    </section>
    <section id="add_es">
    <div class="log_div_class"  >
                <h1 class="Title_connection_Artisan">Ma bonne Adresse</h1>
                <form  method="post">
                <h3 id="Log_mail" class="Categorie_log">Nom</h3>
                <input type="text" name="title" class="Input_log" id="Input_mail" placeholder="Nom" required>
                <h3 id="Log_mail" class="Categorie_log">Adresse mail</h3>
                <input type="email" name="username" class="Input_log" id="Input_mail" placeholder="email@lba.fr" required>
                <h3 id="Log_mail" class="Categorie_log">Telephone</h3>
                <input type="number" name="phone" class="Input_log" id="Input_mail" placeholder="Phone" >
                <h3 id="Log_mail" class="Categorie_log">Site web</h3>
                <input type="url" name="website" class="Input_log" id="Input_mail" placeholder="lba.fr">
                <h3 id="Log_mail" class="Categorie_log">description</h3>
                <input type="text" name="desc" class="Input_log" id="Input_mail" placeholder="On vend des fleurs" required>
                <h3 id="Log_mail" class="Categorie_log">Adresse : Num</h3>
                <input type="number" name="ad_nb" class="Input_log" id="Input_mail" placeholder="27" required>
                <h3 id="Log_mail" class="Categorie_log">Adresse : Ext</h3>
                <input type="text" name="ad_ext" class="Input_log" id="Input_mail" placeholder="Rue" required>
                <h3 id="Log_mail" class="Categorie_log">Adresse : libélé</h3>
                <input type="text" name="ad_lb" class="Input_log" id="Input_mail" placeholder="Du Progrès" required>
                <h3 id="Log_mail" class="Categorie_log">Adresse : CP</h3>
                <input type="number" name="ad_cp" class="Input_log" id="Input_mail" placeholder="93100" required>
                <h3 id="Log_mail" class="Categorie_log">Adresse : Ville</h3>
                <input type="text" name="ad_city" class="Input_log" id="Input_mail" placeholder="Montreuil" required>
                <h3 id="Log_mail" class="Categorie_log">Category</h3>
                <select class="Input_log" name="comp_categ">
                    <option value="">faire un choix</option>
                    <option value="epicerie">épicerie</option>
                    <option value="charcuterie">Charcuterie</option>
                    <option value="brasserie">brasserie</option>
                    <option value="restoration">restoration</option>
                    <option value="boulangerie">boulangerie</option>
                </select>
                <h3  id="Log_Pw" class="Categorie_log" >Mots de passe</h3>
                <input type="password" name="pwd" class="Input_log" id="Input_pw" placeholder="********" required><br>
                <button type="submit" name="content_ad" class="Validation_connexion_Artisan" >Valider</button>
    </form>
    <button id="add_e_a" type="submit" name="content_log" class="Validation_connexion_Artisan2" >Annuler</button>
    </div>
    </section>


    <script>
        let btnPref1 = document.querySelector('.pref1');
        let btnPref2 = document.querySelector('.pref2');
        let btnPref3 = document.querySelector('.pref3');
        let btnPref4 = document.querySelector('.pref4');
        let btnPref5 = document.querySelector('.pref5');
        let btnPref6 = document.querySelector('.pref6');
        let btnPref7 = document.querySelector('.pref7');
        let btnPref8 = document.querySelector('.pref8');
        let btnPref9 = document.querySelector('.pref9');
        let btnPref10 = document.querySelector('.pref10');

        let btnPref = document.querySelector('.preferences');
        let btnSuggestions = document.querySelector('.suggestions')
        let btnChangeSect = document.querySelector('#div1');
        let btnChangeSect2 = document.querySelector('#div2');
        let add_e = document.querySelector('#add_e')
        let e_add = document.querySelector('#e_add')
        let add_es = document.querySelector('#add_es')
        let add_e_a = document.querySelector('#add_e_a')


        add_es.style.display = "none"

        add_e.onclick = function() {
            e_add.style.display = "none"
            add_es.style.display = "block"
        }
        add_e_a.onclick = function() {
            e_add.style.display = "block"
            add_es.style.display = "none"
        }
        btnChangeSect2.style.display = "none";
        btnChangeSect.style.display = "block";
        btnPref.style.color = "white";

        btnSuggestions.onclick = function() {
            btnChangeSect.style.display = "none";
            btnChangeSect2.style.display = "block";
            btnSuggestions.style.color = "white";
            btnPref.style.color = "black";
            btnPref.style.backgroundColor = "#EEEEE4"
            btnSuggestions.style.backgroundColor = "#EC662B"
        }

        btnPref.onclick = function() {
            btnChangeSect2.style.display = "none";
            btnChangeSect.style.display = "block";
            btnSuggestions.style.color = "black";
            btnPref.style.color = "white";
            btnSuggestions.style.backgroundColor = "#EEEEE4"
            btnPref.style.backgroundColor = "#EC662B"
        }

        let compteur = 0;
        function changeColorPref1() {
            if (compteur == 0) {
                btnPref1.style.backgroundColor = "#EC662B";
                btnPref1.style.color = "white";
                compteur = 1;
            } else {
                btnPref1.style.backgroundColor = "#EEEEE4";
                btnPref1.style.color = "black";
                compteur = 0;
            }
        }

        let compteur2 = 0;
        function changeColorPref2() {
            if (compteur2 == 0) {
                btnPref2.style.backgroundColor = "#EC662B";
                btnPref2.style.color = "white";
                compteur2 = 1;
                } else {
                    btnPref2.style.backgroundColor = "#EEEEE4";
                    btnPref2.style.color = "black";
                    compteur2 = 0;
                }
        }

        let compteur3 = 0;
        function changeColorPref3() {
            if (compteur3 == 0) {
                btnPref3.style.backgroundColor = "#EC662B";
                btnPref3.style.color = "white";
                compteur3 = 1;
                } else {
                    btnPref3.style.backgroundColor = "#EEEEE4";
                    btnPref3.style.color = "black";
                    compteur3 = 0;
                }
        }

        let compteur4 = 0;
        function changeColorPref4() {
            if (compteur4 == 0) {
                btnPref4.style.backgroundColor = "#EC662B";
                btnPref4.style.color = "white";
                compteur4 = 1;
                } else {
                    btnPref4.style.backgroundColor = "#EEEEE4";
                    btnPref4.style.color = "black";
                    compteur4 = 0;
                }
        }

        let compteur5 = 0;
        function changeColorPref5() {
            if (compteur5 == 0) {
                btnPref5.style.backgroundColor = "#EC662B";
                btnPref5.style.color = "white";
                compteur5 = 1;
                } else {
                    btnPref5.style.backgroundColor = "#EEEEE4";
                    btnPref5.style.color = "black";
                    compteur5 = 0;
                }
        }

        let compteur6 = 0;
        function changeColorPref6() {
            if (compteur6 == 0) {
                btnPref6.style.backgroundColor = "#EC662B";
                btnPref6.style.color = "white";
                compteur6 = 1;
                } else {
                    btnPref6.style.backgroundColor = "#EEEEE4";
                    btnPref6.style.color = "black";
                    compteur6 = 0;
                }
        }

        let compteur7 = 0;
        function changeColorPref7() {
            if (compteur7 == 0) {
                btnPref7.style.backgroundColor = "#EC662B";
                btnPref7.style.color = "white";
                compteur7 = 1;
                } else {
                    btnPref7.style.backgroundColor = "#EEEEE4";
                    btnPref7.style.color = "black"
                    compteur7 = 0;
                }
        }

        let compteur8 = 0;
        function changeColorPref8() {
            if (compteur8 == 0) {
                btnPref8.style.backgroundColor = "#EC662B";
                btnPref8.style.color = "white";
                compteur8 = 1;
                } else {
                    btnPref8.style.backgroundColor = "#EEEEE4";
                    btnPref8.style.color = "black";
                    compteur8 = 0;
                }
        }

        let compteur9 = 0;
        function changeColorPref9() {
            if (compteur9 == 0) {
                btnPref9.style.backgroundColor = "#EC662B";
                btnPref9.style.color = "white";
                compteur9 = 1;
                } else {
                    btnPref9.style.backgroundColor = "#EEEEE4";
                    btnPref9.style.color = "black";
                    compteur9 = 0;
                }
        }
    </script>
<?php
    }
}
?>