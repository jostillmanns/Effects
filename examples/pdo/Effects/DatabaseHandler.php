<?php
declare(strict_types=1);

namespace PDO\Effects;

use Effects\Effect;
use Effects\EffectHandler;
use Exception;
use PDO;
use PDO\Entity;

class DatabaseHandler implements EffectHandler
{
	const DB_FILE_NAME = 'db.sqlite';

	public function run(Effect $effect)
	{
		/** @var Entity $entity */
		$entity = $effect->getHandle();

		switch (get_class($effect)) {
			case Creator::class:
				$db = new PDO('sqlite:' . self::DB_FILE_NAME);
				$stmt = $db->prepare($entity->getCreateStatemet());

				foreach ($entity->getFields() as $field => $value) {
					if (!$stmt) {
						throw new Exception('bind value: ' . $db->errorInfo()[2]);
					}

					$stmt->bindValue($field, $value, PDO::PARAM_STR);
				}

				if (!$stmt->execute()) {
					throw new Exception('error running insert statemet: ' .  $stmt->errorInfo()[2]);
				}

				break;

			case Updater::class:
				$db = new PDO('sqlite:' . self::DB_FILE_NAME);
				$stmt = $db->prepare($entity->getUpdateStatemet());
				foreach ($entity->getFields() as $field => $value) {
					$stmt->bindValue($field, $value);
				}

				if (!$stmt->execute()) {
					throw new Exception('error running update statemet');
				}
				break;

			default:
				break;
		}
	}
}
