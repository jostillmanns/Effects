<?php
declare(strict_types=1);

namespace PDO;

use Ramsey\Uuid\Uuid;

class IdGenerator
{
	public function generate(): string
	{
		return Uuid::uuid4()->toString();
	}
}
