<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
	<title>Recueil des textes environnementaux et forestiers Malagasy</title>
    <meta name="viewport"
    content='width=device-width, initial-scale=1' name='viewport' />
    <link rel="stylesheet" href="style.css" />
</head>
<body>

    <div id="main-container">
        <header id="header">
            <section><center><img src="./Logomedd.png" alt="Logo Medd" width=50% 
                    height=50%  title="Ministère de l'Environnement et du dévéloppement durable"/></center></section>
                </div>
        </header>

        <section id="display-ads">
            <h2><center> Recueil des textes environnementaux et forestiers Malagasy</center></h2><br>
			 		<form name="Laws" method="POST" action="">
                    <center><input type="search" name="txt_keywords"  size=100 placeholder="Insérer un mot ou une expression..." autocomplete="on"/>
                    <input type="submit" name="btn_valider" value="Rechercher"></center><br>
                    </form>
        </section><br>

        <section id="main-body-container">

            <article id="main-article">
                <h1>Articles</h1>
                <section> Articles trouvés </section><br>
				<?php
					$bdd = new PDO('mysql:host=127.0.0.1;dbname=laws;port=3307','root','');
					$articles = $bdd->query("SELECT *  FROM t_article ");
					if(isset($_POST['txt_keywords']) AND !empty($_POST['txt_keywords']))
	{
					$txk= htmlspecialchars($_POST['txt_keywords']);
				    $txk= addslashes($_POST['txt_keywords']);

			$articles = $bdd->query("SELECT ReferenceTexte,portant, Article, MotCle 
			FROM t_article 
			WHERE MotCle LIKE '%".$txk."%'
			");
	}
	?>
				<?php
	        $current_art = '';
            while($art = $articles->fetch()){
            //Si c'est une référence differnete, on affiche alors la référence.
                if( $art['ReferenceTexte'] !== $current_art ){
                echo  '<h3><b>', $art['ReferenceTexte'] ,' : ','</b>','</h3>','<em>', $art['portant'] ,'</em>' ,'<br>';	
                }
            $current_art = $art['ReferenceTexte'];
            //On affiche les articles et contenu
                echo '<h4><u> Article.' ,  $art['Article'] , '</u></h4>';
                echo '<p>',  $art['MotCle'] , '</p>','</br>';
		    }	
			?>
            </article>
            <aside id='sidebar'>

    <h1> Références </h1>
                <section> références trouvées </section><br>
				<?php
					$bdd = new PDO('mysql:host=127.0.0.1;dbname=laws;port=3307','root','');
					$references = $bdd->query("SELECT *  FROM t_reference ");
					if(isset($_POST['txt_keywords']) AND !empty($_POST['txt_keywords']))
					{
						$txk= htmlspecialchars($_POST['txt_keywords']);
						$txk= addslashes($_POST['txt_keywords']);

					$references = $bdd->query("SELECT Reference,Fichiers
					FROM t_reference
					WHERE MotCle LIKE '%".$txk."%'
					");
					
					}
				?>
			
				<?php
					$current_refer = '';
					while($refer = $references->fetch()){
					//Si c'est une référence differente, on affiche alors la référence.
						if( $refer['Reference'] !== $current_refer ){
						echo  '<h4>','<b>', $refer['Reference'] ,'</b>','</h4>',$refer['Fichiers'] ;	
						}
					$current_refer = $refer['Reference'];
					$current_refer = $refer['Fichiers'];
					
					}	
				?>
            </aside>
        </section>
        <footer id="footer">Copyright © RiusLaws 2023</footer>
    </div>
		</body>
</html>

