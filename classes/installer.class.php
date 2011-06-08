<?php
/**
 * @author 		Nut
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE v3
 * @package		SilexBoard.DEV
 * @version		Revision: 2
 */

class Installer{
	public $step         = 1; //bei welchem step angefangen wird
	public $allsteps     = 5; //wieviele steps es gibt
	public $steps        = null;
	public $params       = null;
	private $systemcheck = true;
	public $isInstalled  = false;

	public function __construct(){
		$this->addWelcome();
		$this->addLicence();
		$this->addCheck();
		$this->addDbSettings();
		$this->addSettings();
		$this->addFinish();
		$this->allsteps = sizeof($this->steps);
	}

	//hier kommen die einezelne Steps, $step['headline'] für die Überschrift und $step['content'] für den Inhalt ^^
	private function addWelcome(){
		$step['headline'] = 'Willkommen';
		$step['content']  = 'Diese Forensoftware wird von Cadillaxx, NoxNebula und Nut geschrieben. <br />
Wir haben zwar alle keinen Plan von PHP aber langeweile, aus der das <Hier Namen einfügen> Board entsteht. Da wir das Projekt sozusagen als zur Verbesserung unserer PHP-Kenntnisse nutzen, lassen wir es bei der Entwicklung des Boards ruhig angehen und haben nichts gegen Hilfe einzuwänden. Eventuell wär noch ein Name für das Board angemessen D:';
	$this->steps[] = $step;
	}

	private function addLicence(){
		$step['headline'] = 'Lizenz';
		$step['content']  = 'bla bla';
		$this->steps[] = $step;
	}

	private function addCheck(){
		$step['headline'] = 'Systemcheck';
		$step['content']  = 'bla bla :D';
		$this->steps[] = $step;
	}
	
	private function addDbSettings(){
		$step['headline'] = 'Datenbank';
		$step['content']  = 'form un so..';
		$this->steps[] = $step;
	}
	
	private function addSettings(){
		$step['headline'] = 'Einstellungen';
		$step['content']  = 'jo';
		$this->steps[] = $step;
	}

	private function addFinish(){
		$step['headline'] = 'Fertig';
		$step['content']  = 'installiert';
		$this->steps[] = $step;
	}
	
	//Die headline wird ausgegben
	public function getHeadline(){
		return $this->steps[$this->step-1]['headline'];
	}
	
	//content wird ausgegeben
	public function getContent(){
		$res =  $this->steps[$this->step-1]['content'];
		
		//wen er durch alle steps ist wird die Installation ausgeführt
		if($this->step == $this->allsteps){
			$this->runInstallation();
		}
		if(isset($this->params[$this->step-1]) && $this->params[$this->step-1]){
			foreach($this->params[$this->step-1] as $name=>$value){
			$res = str_replace('{'.$name.'}',$value,$res);
			}
		}
		return $res;
	}

	//Installation wird ausgeführt, sprich Einstellungen werden in DB gespeichert usw.
	private function runInstallation(){
		$this->writeDBSettings();
		/*include('../config.inc.php');*/
		$connection = mysql_connect($dbhost,$dbuser,$dbpassword);
		mysql_select_db($db,$connection);
		$this->isInstalled = true; 
	}

	//zeigt den Zurückbutton außer beim ersten Step
	public function showBackButton(){
		return $this->step > 1 and $this->step != $this->allsteps;
	}

	//zeigt den Nextbutton außer beim letzten Step
	public function showNextButton(){
		return $this->step < $this->allsteps-1;
	}

	//zeigt Finishbutton wen alle Steps durch sind
	public function showFinishButton(){
		return $this->step == $this->allsteps-1;
	}
  
  	//wen systemcheck stimmt gehts weiter sonst bleibt er beim systemcheck bis alles stimmt
	public function validateCurrentStep(){
		return $this->step != 3 or $this->systemcheck;
	}
	
	//Schreibt die DB-Settings in die config
	private function writeDBSettings(){
/*		$handle = fopen ( "../config.inc.php", "w" );
		fwrite($handle,'hier kommt setings von form');
		fclose($handle);*/
	}

}
?>