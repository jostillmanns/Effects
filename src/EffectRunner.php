<?php
declare(strict_types=1);

namespace Effects;

class EffectRunner
{
	public function play(EffectList $effects)
	{
		foreach ($effects as $effect) {
			$effect->run();
		}
	}
}
