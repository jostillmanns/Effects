<?php

namespace PDO;

interface Entity
{
	const DATE_FORMAT = 'Y-m-d H:i:s';

	public function getFields(): array;
	public function getUpdateStatemet(): string;
	public function getCreateStatemet(): string;
}
