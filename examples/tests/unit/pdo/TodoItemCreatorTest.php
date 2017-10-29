<?php
declare(strict_types=1);

use PDO\IdGenerator;
use PDO\TodoItem;
use PDO\TodoItemCreator;
use PHPUnit\Framework\TestCase;

class TodoItemCreatorTest extends TestCase
{
	public function test_item_is_correctly_created(): void
	{
		$dt = new DateTime();

		$creator = new TodoItemCreator(new IdGenerator());
		[$entityEffect, $loggingEffect] = $creator->create(new TodoItem(), 'my first todo item', $dt);

		/** @var TodoItem $actual */
		$actual = $entityEffect->getHandle();
		self::assertEquals($actual->getDescription(), 'my first todo item');
		self::assertEquals($actual->getCreateTime(), $dt);
		self::assertEquals($actual->getUpdateTime(), $dt);
		self::assertNotNull($actual->getId(), null);

		/** @var string $actual */
		$actual = $loggingEffect->getHandle();
		self::assertEquals($actual, 'todo item created');
	}
}
