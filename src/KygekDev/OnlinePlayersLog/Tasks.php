<?php

/*
 * Log online players at an interval
 * Copyright (C) 2020-2022 KygekDev
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 */

declare(strict_types=1);

namespace KygekDev\OnlinePlayersLog;

use pocketmine\scheduler\Task;

// TODO: Convert to async task
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
