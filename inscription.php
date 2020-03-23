<!DOCTYPE html>
    <html>
    <head>
	
      <meta charset="UTF-8"/>
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	  <link rel="stylesheet" type="text/css" href="page1.css"/>
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"/>

      <title>Inscription</title>
	  
	  </head>

<header>

    <nav>
        
        <ul>
             
            <div id="logo">  <p><img src="logo1.png" width="80" /></p></div> 
            <li>MYQUIZZ</li>


            <li>Quizz par thème
                <ul class="sous">
                    <li ><a class="link" href ="sport.html">Sport</a></li>
                    <li ><a class="link" href ="cinema.html">Cinéma</a></li>                                
                </ul>
            </li>
            <li>Révisions
                <ul class="sous">
                    <li ><a class="link" href ="histgeo.html">Histoire/Géographie</a></li>
                    <li ><a class="link" href ="maths.html">Maths</a></li>                 
                </ul>
            </li>                
                                     
        </ul>
    </nav>
</header>
	  
<body>

<?php

//connexion db
$bdd=new PDO('mysql:host=127.0.0.1;dbname=phplogin','root','');


//validation du bouton 
if(isset($_POST['inscription']))
{
	//récupération variables (trim->sécuriser la variable)
	$statut=trim($_POST['statut']);
	$login = trim($_POST['login']);
	$email = trim($_POST['email']);
	$password = trim($_POST['password']);
	$repeatpassword = trim($_POST['repeatpassword']);
	
	//tout le formulaire rempli
	if(!empty($statut) AND !empty($login) AND !empty($email) AND !empty($password) AND !empty($repeatpassword))
	{
		
		//filtre mail, sécurité
		if(filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			
		$reqlog = $bdd->prepare('select * from utilisateur where ut_login =?');
		$reqlog->execute(array($login));
		$logexist=$reqlog->rowCount();

			//pseudo unique ou non
			if($logexist == 0)			
			{		
				//même mdp
				if($password == $repeatpassword)
				{
					
					//caractère max pour le mdp(100) : création compte
					$loginlength = strlen($login);
					if($loginlength <= 100)
					{
						$insert_ut = $bdd->prepare("INSERT INTO utilisateur(ut_login,  ut_mdp, ut_mail, ut_statut) VALUES(?,?,?,?)");
						$insert_ut->execute(array($login,$password,$email,$statut));
						$erreur = "Votre compte a bien été créé";
					
						/*header('Location : 2.html');*/
						//redirection vers page accueil html
					}
					
					else
					{	 
						$erreur = "Votre login ne doit pas dépasser 100 caractères.";
					}
				}
				
				else
				{
					$erreur = "Vos mot de passe ne correspondent pas !";
				}
			}
			
			else
			{
				$erreur = "Login déjà utilisé !";				
			}
		}
		
		else $erreur = "Votre email n'est pas valide !";
		
	}
	else $erreur = "Veuillez saisir tous les champs";
	
}
?>


<div class="conteneurconex">
     
            <form method="post" action="inscription.php">

                <div id="connexion">
                <fieldset><legend><strong>Inscription</strong></legend>
 <br/>
                    <input type="radio" name="statut" value="admin"/><label for="admin">Administrateur</label>
                    <input type="radio" name="statut" value="joueur"/><label for="joueur">Joueur</label><br/>
                    
                
                <label for="login"><i>Login : </i> </label> <input type="text" name="login" value="<?php if(isset($login)) {echo $login;} ?>" class="form-control" placeholder="Entrez votre login" required autofocus>
                                 
               <br/>
                <label for="login"><i> Adresse mail : </i></label><input type="email" name="email" value="<?php if(isset($email)) {echo $email;} ?>" class="form-control" placeholder="Entrez votre adresse mail" required>
               <br/>

                    <label for="login"><i> Mot de passe : </i></label><input type="password" name="password" class="form-control" placeholder="Entrez votre mot de passe" required>
               <br/>
                    <label for="login"><i>Confirmation mot de passe : </i></label><input type="password" name="repeatpassword" class="form-control" placeholder="Confirmer votre mot de passe" required>
            
                <br/>
                <button type="submit" name="inscription" class="boutonC"><span class="glyphicon glyphicon-log-in"></span> Valider</button>

                
                </div>  


                
                </fieldset>
                        
            </form>
			
		
			

</div>
 
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script> 
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<?php
			if(isset($erreur))
			{
				echo '<font color="blue"; text-align:center;>'.$erreur."</font>";
			}?>	
		
	</body>
    </html>