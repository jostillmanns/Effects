<?php
declare(strict_types=1);

namespace PDO;

use Exception;
use PDO;

class Database
{
	public function initialize()
	{
		$db = new PDO('sqlite:' . PDO\Effects\DatabaseHandler::DB_FILE_NAME);
		$result = $db->exec(
			'create table if not exists `todo_item` (
`id` varchar(140),
`description` varchar(500),
`create_time` varchar(100),
`update_time` varchar(100),
`checked` varchar(10)
)'
		);

		if ($result !== 0) {
			throw new Exception('unable to create dattabase table');
		}
	}
}
