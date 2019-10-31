<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="../../public/css/loggedout/Inscription.css" />
		<title> Inscription </title>
	</head>

	<body>

		<?php include("../headerfooter/Header_logged_out.php"); ?>

		<!--section messages serveur-->

		<?php include('../headerfooter/Message_serveur.php');?>

		<!--formulaire Inscription-->

		<section>
			<div id="conteneur">
					<form action="../../controller/register.php" method="post">

							<h1>Inscription</h1>

							<label><b>Nom</b></label>
							<input type="text" placeholder="Entrer votre nom" name="nom" required>

							<label><b>Prénom</b></label>
							<input type="text" placeholder="Entrer votre prénom" name="prenom" required>

							<label><b>Email</b></label>
							<input type="email" placeholder="Entrer votre adresse mail" name="adresse_mail" required>

							<label><b>Mot de passe</b></label>
							<input type="password" placeholder="Entrer votre mot de passe" name="mot_de_passe" minlength="5" required>

							<input type="submit" value='Valider' >

					</form>
			</div>
		</section>

		<?php include("../headerfooter/footer.php"); ?>


	</body>
</html>
