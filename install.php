<?php 
	include_once('constants.inc.php');
	include_once('config.inc.php');
	include_once('functions.inc.php');
	
	session_start();
	if(isset($_GET['restart']) && $_GET['restart']){
 		$_SESSION['installer'] = null;
	}
	
	if(!isset($_SESSION['installer'])){
		$_SESSION['installer'] = new Installer();
	}
	
	if($_SESSION['installer']->validateCurrentStep()){
		if((isset($_POST['next']) && $_POST['next']) || (isset($_POST['finish']) && $_POST['finish'])){
			$_SESSION['installer']->params[$_SESSION['installer']->step-1] = $_POST;
			$_SESSION['installer']->step++;
		}
		if(isset($_POST['back']) && $_POST['back']){
		$_SESSION['installer']->step--;
		}
	}
?>
  
	<h1><?php echo $_SESSION['installer']->getHeadline(); ?></h1>
    <form action="install.php" method="POST">
	<?php
		echo $_SESSION['installer']->getContent();
		echo '<br />';
		if(!$_SESSION['installer']->isInstalled){

			if($_SESSION['installer']->showBackButton()){
	?>
		<input id="btnBack" type="submit" name="back" value="Zur&uuml;ck" />
	<?php
			}
			if($_SESSION['installer']->showNextButton()){
	?>
		<input id="btnNext" type="submit" name="next" value="Weiter" />
	<?php
			}
			if($_SESSION['installer']->showFinishButton()){
	?>
		<input id="btnFinish" type="submit" name="finish" value="Abschlie&szlig;en" />
	<?php
			}
		}
          
	?>  
    </form>