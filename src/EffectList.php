<?php
declare(strict_types=1);

namespace Effects;

use ArrayIterator;

class EffectList extends ArrayIterator
{
	public function __construct(Effect ...$effects)
	{
		parent::__construct($effects, 0);
	}

	public function append($value): void
	{
		parent::append($value);
	}

	public function current(): Effect
	{
		return parent::current();
	}
}
