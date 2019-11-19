<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="../../public/css/autre/Forum_sujet.css"/>
		<title>Sujets Forum</title>
	</head>

	<body>

		<?php include("../general/Header.php"); ?>

    <?php
    if (!isset($_SESSION['id_utilisateur'])) {header('Location:../loggedout/Connexion.php');exit;} else {$id_utilisateur=$_SESSION['id_utilisateur'];}
    ?>

		<!--section messages serveur-->

		<?php include('../general/Message_serveur.php');?>

		<!--section sujets-->

    <section>


			<!--section affichage tableau des utilisateurs-->

			<?php
			$db_username = 'root';
			$db_password = '';
			$db_name     = 'infinite_sense';
			$db_host     = 'localhost';
			try
			{
				$db = new PDO('mysql:host='.$db_host.';dbname='.$db_name, $db_username, $db_password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));
			} catch (Exception $e) {
				?><script> show_message('Connexion à la base de donnée impossible','red'); </script><?php
				exit;
			}

			try {
				if (!isset($_GET['id_sujet'])) {header('Location:../autre/Forum.php?error=6');exit;}
          $id_sujet=$_GET['id_sujet'];
					$req = "SELECT titre FROM sujet_forum WHERE id_sujet=$id_sujet";
				  $rep = $db->query($req);
					if($rep->rowCount() == 0) {header('Location:../autre/Forum.php?error=6');exit;}
          $titre=$rep->fetch();
          echo '<h1>'.$titre['titre'].'</h1>';
			} catch (Exception $e)
			{
				?><script type="text/javascript"> show_message('Erreur serveur','red'); </script><?php
				exit;
			}

      $req2="SELECT * FROM message_forum WHERE id_sujet=$id_sujet ORDER BY date_poste ASC";
      $rep2=$db->query($req2);
			?>
				<div id="conversation">

					<a id="first_message"></a>
					<?php
	      	while ($infos_message=$rep2->fetch()) {?>
            <div class=
            <?php
            if ($infos_message['id_utilisateur']==$id_utilisateur) {echo 'message_self';} else {echo 'message_other';}
            ?>
            >
              <?php
              try {
                $id_utilisateur_message=$infos_message['id_utilisateur'];
                $req3 = "SELECT nom, prenom, role FROM utilisateur where id_utilisateur=$id_utilisateur_message";
                $rep3 = $db->query($req3);
                $user=$rep3->fetch();
                ?>
                <br>
                <div class="utilisateur"><?php echo $user['prenom']." ".$user['nom'].'<br>'.$user['role'];?></div>
								<div class="date"><?php echo date('d/m/Y', strtotime($infos_message['date_poste'])).'<br>'.date('H:i', strtotime($infos_message['date_poste'])); ?></div>
                <div class="texte"><?php echo $infos_message['message']; ?></div>
                <?php
              } catch (Exception $e)
              {
                ?><script type="text/javascript">
                show_message("Erreur serveur au message id="+<?php echo $infos_message['id_message'] ?>,'red');
                </script><?php
              }
              ?>
            </div>
	      	<?php
					}
					?>
					<a id="last_message"></a>
        </div>
        <div id='post'>
          <form method= 'POST' action="../../controller/message_post.php">
            <input name='id_sujet' type='hidden' value=<?php echo $id_sujet; ?>>
            <input name='message' type='text' placeholder="Rédiger une réponse" minlength='1' required>
            <input type='submit' value='Envoyer'>
          </form>
        </div>

		</section>

		<?php include("../general/Footer.php"); ?>

	</body>

</html>
