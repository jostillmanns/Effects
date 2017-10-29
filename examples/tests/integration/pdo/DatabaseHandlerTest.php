<?php
declare(strict_types=1);

use PDO\Database;
use PDO\Effects\DatabaseHandler;
use PDO\IdGenerator;
use PDO\TodoItem;
use PDO\TodoItemCreator;
use PDO\TodoItemUpdater;
use PHPUnit\Framework\TestCase;

class DatabaseHandlerTest extends TestCase
{
	public function test_create_todo_item()
	{
		$db = new Database();
		$db->initialize();

		$todoItemCreator = new TodoItemCreator(new IdGenerator());
		$effects = $todoItemCreator->create(new TodoItem(), 'my first todo item', new DateTime());

		$dbHandler = new DatabaseHandler();
		$dbHandler->run($effects->current());

		$pdo = new PDO('sqlite:' . DatabaseHandler::DB_FILE_NAME);
		$row = $pdo->query('select * from todo_item')->fetch();

		self::assertEquals($row['description'], 'my first todo item');

		unlink(DatabaseHandler::DB_FILE_NAME);
	}

	public function test_update_todo_item()
	{
		$db = new Database();
		$db->initialize();

		$todoItemCreator = new TodoItemCreator(new IdGenerator());
		$effects = $todoItemCreator->create(new TodoItem(), 'my first todo item', new DateTime());

		$entityEffect = $effects->current();

		$dbHandler = new DatabaseHandler();
		$dbHandler->run($entityEffect);

		$todoItemUpdater = new TodoItemUpdater();
		$effects = $todoItemUpdater->update($entityEffect->getHandle(), new DateTime(), 'updated', true);

		$dbHandler->run($effects->current());

		$pdo = new PDO('sqlite:' . DatabaseHandler::DB_FILE_NAME);
		$row = $pdo->query('select * from todo_item')->fetch();

		self::assertEquals($row['description'], 'updated');

		unlink(DatabaseHandler::DB_FILE_NAME);
	}
}
