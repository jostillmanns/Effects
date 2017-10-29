<?php
declare(strict_types=1);

namespace PDO;

use DateTime;
use Effects\EffectList;
use PDO\Effects\Creator;
use PDO\Effects\Logger;

class TodoItemCreator
{
	/** @var IdGenerator */
	private $idGenerator;

	public function __construct(IdGenerator $idGenerator)
	{
		$this->idGenerator = $idGenerator;
	}

	public function create(TodoItem $item, string $description, DateTime $createTime): EffectList
	{
		$item->setId($this->idGenerator->generate())
		->setChecked(false)
		->setUpdateTime($createTime)
		->setCreateTime($createTime)
		->setDescription($description);

		return new EffectList(new Creator($item), new Logger('todo item created'));
	}
}
