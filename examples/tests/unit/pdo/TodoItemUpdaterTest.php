<?php
declare(strict_types=1);

use PDO\TodoItem;
use PDO\TodoItemUpdater;
use PHPUnit\Framework\TestCase;

class TodoItemUpdaterTest extends TestCase
{
	public function test_item_is_correctly_updated()
	{
		$initialDt = new DateTime('now - 1 hour');

		$item = new TodoItem();
		$item->setCreateTime($initialDt)
			->setUpdateTime($initialDt)
			->setDescription('not this')
			->setChecked(false);

		$dt = new DateTime();

		$updater = new TodoItemUpdater();
		$effects = $updater->update($item, $dt, 'updated description', true);

		/** @var TodoItem $actual */
		$actual = $effects->current()->getHandle();
		self::assertEquals($actual->getDescription(), 'updated description');
		self::assertEquals($actual->getCreateTime(), $initialDt);
		self::assertEquals($actual->getUpdateTime(), $dt);
		self::assertEquals($actual->getChecked(), true);
	}
}
