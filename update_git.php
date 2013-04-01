<?php
header('Content-Type: text/plain; charset=utf-8');
date_default_timezone_set('Europe/Berlin');

// My derp class
class Subnet {
	private $Subnets;

	public function __construct($Subnets) {
		foreach ((array)$Subnets as $Subnet) {
			if (strpos($Subnet, '/') === false)
				continue;

			$Buf = explode('/', $Subnet);

			$this->Subnets[] = [
				'subnet' => $Buf[0],
				'prefix' => $Buf[1],
				'bits'   => 32 - $Buf[1],
				'ips'    => pow(2, 32 - $Buf[1])
			];
		}
	}

	public function Compare($IP) {
		$Match = [-1, -1];

		$aIP = explode('.', $IP);
		for ($s = 0; $s < sizeof($this->Subnets); $s++) {
			$aSubnet = explode('.', $this->Subnets[$s]['subnet']);
			for ($i = 0; $i < 4 - (int)($this->Subnets[$s]['bits'] / 8); $i++) {
				if ($aIP[$i] == $aSubnet[$i] && $Match[0] < $i) {
					$Match = [$i, $s];
				} else {
					continue 2;
				}
			}
		}

		if($Match[1] == -1 || $Match[0] < 3 - ((int)($this->Subnets[$Match[1]]['bits'] / 8) + 1))
			return false;

		//print_r($Match);
		//print_r($this->Subnets[$Match[1]]);

		return $this->Check($IP, $this->Subnets[$Match[1]]);
	}

	private function Check($IP, $Subnet) {
		$aIP = explode('.', $IP);
		$aS = explode('.', $Subnet['subnet']);

		$Match = [$aS[0], $aS[1], $aS[2], $aS[3]];

		for ($i = 3; $i >= 3 - ((int)($Subnet['bits'] / 8)); $i--) {
			for ($j = $aS[$i], $jj = 0; $jj < $Subnet['ips'] && $j < 256; $j++, $jj++) {
				$Match[$i] = $j;
				if ($IP == $Match[0].'.'.$Match[1].'.'.$Match[2].'.'.$Match[3]) {
					//echo 'found: '.$IP.' = '.$Match[0].'.'.$Match[1].'.'.$Match[2].'.'.$Match[3];
					return true;
				}
				if ($aIP[$i] == $j) {
					$Subnet['ips'] -= 256;
					break;
				}
			}
		}
		return false;
	}
}

$GitHubHooks = [
	'207.97.227.253/32',
	'50.57.128.197/32',
	'108.171.174.178/32',
	'50.57.231.61/32',
	'204.232.175.64/27',
	'192.30.252.0/22'
];
$IPs = new Subnet($GitHubHooks);

// ---
define('DIR_ROOT', '');
include('lib/config.inc.php');

// Storing all the IPs
file_put_contents(CFG_CACHE_DIR.'git_access.txt', $_SERVER['REMOTE_ADDR']."\n", FILE_APPEND);
if($IPs->Compare($_SERVER['REMOTE_ADDR']) && isset($_POST['payload'])) {
	// Commitinfo
	$Payload = json_decode($_POST['payload']);
	file_put_contents(CFG_CACHE_DIR.'git_payload.txt', serialize($Payload));

	// Output log
	file_put_contents(CFG_CACHE_DIR.'git_output.log', shell_exec('git pull'));

	// Update the database
	ob_start();
	$DB = new PDO('mysql:dbname='.CFG_DB_DATABASE.';host='.CFG_DB_HOST.';charset=utf8', CFG_DB_USER, CFG_DB_PASSWORD);
	$DB->query(file_get_contents('draft/Database.sql'));
	file_put_contents(CFG_CACHE_DIR.'git_output.log', "\n\n-- Database --\n".ob_get_contents(), FILE_APPEND);
	ob_end_clean();
}

// $json = '{"head_commit":{"url":"https://github.com/SilexBoard/Board/commit/d8fd4610e7c0d4d718f055f0203d06b2fac4d6e4","id":"d8fd4610e7c0d4d718f055f0203d06b2fac4d6e4","distinct":true,"author":{"name":"Patrick K.","email":"patrick.kl@live.de","username":"NoxNebula"},"removed":[],"timestamp":"2013-03-28T02:58:59-07:00","modified":["README.md"],"committer":{"name":"Patrick K.","email":"patrick.kl@live.de","username":"NoxNebula"},"message":"Update README.md","added":[]},"pusher":{"name":"none"},"forced":false,"created":false,"commits":[{"url":"https://github.com/SilexBoard/Board/commit/116d9bb7635ac8fc252b0a7585e878f818e8cce7","id":"116d9bb7635ac8fc252b0a7585e878f818e8cce7","distinct":true,"author":{"name":"Patrick K","email":"patrick.kl@live.de","username":"NoxNebula"},"removed":[],"timestamp":"2013-03-27T03:57:56-07:00","modified":["lib/language/de/sbb.core.php","lib/libraries/interfaces/IPage.interface.php","lib/templates/index.tpl","themes/Lumen Lunae/js/core.js","themes/Lumen Lunae/main.css"],"committer":{"name":"Patrick K","email":"patrick.kl@live.de","username":"NoxNebula"},"message":"search bar","added":["themes/Lumen Lunae/icons/g_16_magnifying_glass.png"]},{"url":"https://github.com/SilexBoard/Board/commit/4b40d451078a65ece969a0f802aa01914cdc66f4","id":"4b40d451078a65ece969a0f802aa01914cdc66f4","distinct":true,"author":{"name":"Patrick K","email":"patrick.kl@live.de","username":"NoxNebula"},"removed":[],"timestamp":"2013-03-27T07:47:57-07:00","modified":["themes/Lumen Lunae/main.css"],"committer":{"name":"Patrick K","email":"patrick.kl@live.de","username":"NoxNebula"},"message":"a border :o","added":[]},{"url":"https://github.com/SilexBoard/Board/commit/d8fd4610e7c0d4d718f055f0203d06b2fac4d6e4","id":"d8fd4610e7c0d4d718f055f0203d06b2fac4d6e4","distinct":true,"author":{"name":"Patrick K.","email":"patrick.kl@live.de","username":"NoxNebula"},"removed":[],"timestamp":"2013-03-28T02:58:59-07:00","modified":["README.md"],"committer":{"name":"Patrick K.","email":"patrick.kl@live.de","username":"NoxNebula"},"message":"Update README.md","added":[]}],"before":"86643c685411eb7aa9cc40a6aab8b54b8cb51d7c","deleted":false,"ref":"refs/heads/revamp","repository":{"has_downloads":true,"master_branch":"revamp","url":"https://github.com/SilexBoard/Board","stargazers":22,"id":1507410,"fork":false,"name":"Board","homepage":"www.silexboard.org","description":"The modern open source bulletin board software","watchers":22,"has_wiki":true,"forks":14,"language":"PHP","pushed_at":1364464740,"created_at":1300724506,"owner":{"name":"SilexBoard","email":null},"open_issues":49,"has_issues":true,"size":332,"organization":"SilexBoard","private":false},"compare":"https://github.com/SilexBoard/Board/compare/86643c685411...d8fd4610e7c0","after":"d8fd4610e7c0d4d718f055f0203d06b2fac4d6e4"}';
// $Payload = json_decode($json);

// // DEBUG
// print_r($Payload);
