<?php
declare(strict_types=1);

namespace Effects;

interface EffectHandler
{
	public function run(Effect $effect);
}
