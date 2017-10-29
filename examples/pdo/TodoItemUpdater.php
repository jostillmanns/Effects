<?php
declare(strict_types=1);

namespace PDO;

use DateTime;
use Effects\EffectList;
use PDO\Effects\LogEntry;
use PDO\Effects\Updater;

class TodoItemUpdater
{
	public function update(TodoItem $item, DateTime $updateTime, string $description, bool $checked): EffectList
	{
		$item->setDescription($description)
			->setUpdateTime($updateTime)
			->setChecked($checked);

		return new EffectList(new Updater($item), new LogEntry('todo item created'));
	}
}
