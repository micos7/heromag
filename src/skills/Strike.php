<?php

namespace Hero\skills;
use Hero\skills\Skills;

class Strike extends Skills
{

    public function __construct(int $chance)
    {
        $this->setChance($chance);

        return $this;
    }

    public function getTwiceDamage(int $damage)
    {
        return $damage*2;
    }

}