<?php
declare(strict_types=1);

namespace PDO\Effects;

use Effects\Effect;
use PDO;
use PDO\Entity;

class Creator implements Effect
{
	/** @var Entity */
	private $entity;

	public function __construct(Entity $entity)
	{
		$this->entity = $entity;
	}

	public function getHandle(): Entity
	{
		return $this->entity;
	}
}
