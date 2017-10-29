<?php
declare(strict_types=1);

namespace PDO\Effects;

use Effects\Effect;

class LogEntry implements Effect
{
	private $message;

	public function __construct(string $message)
	{
		$this->message = $message;
	}

	public function getHandle(): string
	{
		return $this->message;
	}
}
