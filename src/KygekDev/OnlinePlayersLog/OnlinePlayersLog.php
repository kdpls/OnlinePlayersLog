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

use pocketmine\plugin\PluginBase;

class OnlinePlayersLog extends PluginBase {

    protected function onEnable() : void {
        $this->getScheduler()->scheduleRepeatingTask(new Tasks($this), 5 * 60 * 20);
    }

}
