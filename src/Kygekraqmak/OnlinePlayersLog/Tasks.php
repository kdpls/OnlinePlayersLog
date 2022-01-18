<?php

declare(strict_types=1);

namespace Kygekraqmak\OnlinePlayersLog;

use pocketmine\scheduler\Task;

use Kygekraqmak\OnlinePlayersLog\OnlinePlayersLog;

class Tasks extends Task {

    private $main;

    public function __construct(OnlinePlayersLog $main) {
        $this->main = $main;
    }

    public function main() {
        return $this->main;
    }

    public function onRun() : void {
        $server = $this->main()->getServer();
        $players = $server->getOnlinePlayers();
        $plynames = '';
        if (count($players) > 0) {
            foreach ($players as $player) {
                $plynames .= $player->getName() . ' (' . $this->getPlayerLocation($player->getNetworkSession()->getIp()) . ')' . ', ';
            }
        }
        $logs = fopen($this->main()->getDataFolder().'onlineplayerslog.log', 'a+');
        $write = '[OnlinePlayersLog] '.date('[d-m-Y H:i:s]').' There were '.count($players).' players online: '.$plynames.PHP_EOL;
        fwrite($logs, $write);
        fclose($logs);
    }
	
	public function getPlayerLocation(string $ip) : string {
		$query = unserialize(file_get_contents('http://ip-api.com/php/'.$ip));
		return ($query && $query['status'] == 'success') ? $query['city'] : 'Unknown';
	}

}
