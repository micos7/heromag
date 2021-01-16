<?php

namespace Hero\skills;

abstract class Skills
{

    protected $chance;

    public function __construct(int $chance)
    {
        $this->chance = $chance;
    }

    public function getChance()
    {
        return $this->chance;
    }

    public function setChance($chance)
    {
        $this->chance = $chance;

        return $this;
    }

}