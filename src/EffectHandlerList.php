<?php
declare(strict_types=1);

namespace Effects;

use ArrayIterator;

class EffectHandlerList extends ArrayIterator
{
	public function __construct(EffectHandler ...$effectHandlers)
	{
		parent::__construct($effectHandlers, 0);
	}

	public function append($value): void
	{
		parent::append($value);
	}

	public function current(): EffectHandler
	{
		return parent::current();
	}
}
