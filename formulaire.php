<?php include("User.php"); ?>

<!DOCTYPE html>
<html>
    <head>
        <title>Formulaire DTL</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="">
    </head>
    <body>
        <h1>HTML form</h1>
        
        <form action="" method="post">
            <div class="1">
                <label for="prenom">Name : </label>
                <input type="text" id="prenom" name="prenom" style="width:30em">
            </div>
            <div class="2">
                <label for="mail">Mail : </label>
                <input type="email" id="mail" name="mail">
            </div>
            <div class="3">
                <label for="age">Age : </label>
                <input type="number" id="age" name="age" min="12" max="99">
            </div>
            <div class="c100" id="submit">
                <input type="submit" value="Envoyer">
            </div>
        </form>
        
        
        <?php
            $serveur = "localhost";
            $dbname = "cours";
            $user = "root";
            $pass = "root";
    
            $prenom = $_POST["name"];
            $mail = $_POST["mail"];
            $age = $_POST["age"];
            
            try{
                //Connexion a la BDD
                $dbco = new PDO("mysql:host=195.168.65.78;dbname=Anime",'User','root');
            
                //On recupere les informations
                if(!empty($prenom)  && !empty($mail) && !empty($age)){
                    $sth = $dbco->prepare("
                        INSERT INTO form(prenom, mail, age)
                        VALUES(:prenom, :mail, :age)");
                    $sth->bindParam(':prenom',$prenom);
                    $sth->bindParam(':mail',$mail);
                    $sth->bindParam(':age',$age);
                    $sth->execute();
                }
                
                //On recupere les informations de la table 
                $sth = $dbco->prepare("SELECT prenom, mail, age FROM form");
                $sth->execute();
                //On affiche les infoormations de la table
                $resultat = $sth->fetchAll(PDO::FETCH_ASSOC);
                $keys = array_keys($resultat);
                for($i = 0; $i < count($resultat); $i++){
                    $n = $i + 1;
                    echo 'Utilisateur n°' .$n. ' :<br>';
                    foreach($resultat[$keys[$i]] as $key => $value){
                        echo $key. ' : ' .$value. '<br>';
                    }
                    echo '<br>';
                }
            }   
            catch(PDOException $e){
                echo 'Erreur, Nous n arrivons pas a traiter les données : '.$e->getMessage();
            }
        ?>
    </body>
</html>