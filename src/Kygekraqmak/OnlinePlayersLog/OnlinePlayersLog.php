<?php

declare(strict_types=1);

namespace Kygekraqmak\OnlinePlayersLog;

use pocketmine\plugin\PluginBase;
use pocketmine\scheduler\TaskScheduler;
use pocketmine\event\Listener;
use pocketmine\scheduler\Task;

use Kygekraqmak\OnlinePlayersLog\Tasks;

class OnlinePlayersLog extends PluginBase implements Listener {

    protected function onEnable() : void {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getScheduler()->scheduleRepeatingTask(new Tasks($this), 5 * 60 * 20);
    }

}
