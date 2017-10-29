<?php
declare(strict_types=1);

namespace PDO;

use Effects\Effect;
use Effects\EffectHandler;
use Monolog\Logger;

class LogHandler implements EffectHandler
{
	public function run(Effect $effect)
	{
		$log = new Logger();
		if (!is_string($effect)) {
			return;
		}

		$log->log($effect);
	}
}
