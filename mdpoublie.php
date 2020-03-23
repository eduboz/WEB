<!DOCTYPE html>
    <html>
    <head>
	
      <meta charset="UTF-8"/>
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	  <link rel="stylesheet" type="text/css" href="page1.css"/>
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"/>

      <title>Mot de passe oublié</title>
	  
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

    session_start();
	$bdd=new PDO('mysql:host=localhost;dbname=phplogin','root','');
    include('fonction.php');


        if (!empty($_POST['login']) AND !empty($_POST['nvpassword']) AND !empty($_POST['repeatnvpassword']))
		{
			
			
		$login = trim($_POST['login']);
		$nvpassword = trim($_POST['nvpassword']);
		$repeatnvpassword = trim($_POST['repeatnvpassword']);
		
		$requete = $bdd->prepare('select * from utilisateur where ut_login =?');	
		$requete->execute(array($login));
		$requete = $requete->fetch();


		if($login == $requete['ut_login'])
		{
			if($nvpassword == $repeatnvpassword)
			{
				//a faire fonctionner
				 $resultat=$bdd->prepare("UPDATE utilisateur SET ut_mdp = ? WHERE ut_login =? "); 
                 $resultat->execute(array($nvpassword, $requete['ut_mdp']));
								
			}
			else
			{
				$erreur = "Les mots de passe ne correspondent pas !";
								
			}	
			
		}
		else
		
		{
			$erreur = "Login introuvable !";
		}
		
		//existence login dba_close
		
		}
            
	
?>
		
<div class="conteneurconex">
     
            <form method="post" action="mdpoublie.php">

                <div id="connexion">
                <fieldset><legend><strong>Mot de passe oublié</strong></legend>

                <br/>
                    
           
               
                <label for="login"><i> Login : </i></label><input type="text" name="login" class="form-control" placeholder="Entrez votre login" required>
                <br/>
                    
				<label for="mdp"><i> Nouveau mot de passe : </i></label><input type="password" name="nvpassword" class="form-control" placeholder="Entrez votre mot de passe" required>
               <br/>
                    <label for="mdp"><i>Confirmation nouveau mot de passe : </i></label><input type="password" name="repeatnvpassword" class="form-control" placeholder="Confirmer votre mot de passe" required>
            
                <br/>
                
                <button type="submit" name="mdpoublie" class="boutonC"><span class="glyphicon glyphicon-log-in"></span> Récupérer mon mot de passe</button>
                <br/>

                
                </div>  


                
                </fieldset>
                        
            </form>

</div>


<?php
			if(isset($erreur))
			{
				echo '<font color="blue"; text-align:center;>'.$erreur."</font>";
			}
?>	
 
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script> 
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
				
</body></html>