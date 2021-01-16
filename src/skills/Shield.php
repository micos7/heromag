<?php

namespace Hero\skills;

use Hero\skills\Skills;

class Shield extends Skills
{

    public function __construct(int $chance)
    {
        $this->setChance($chance);

        return $this;
    }

    public function getHalfDamage(int $damage)
    {
        return $damage/2;
    }

}