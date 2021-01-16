<?php

namespace Hero\players;
use Hero\players\Player;

class Hero extends Player
{

    const NAME = 'ORDERUS';

    const STATS = [
        'MIN_HEALTH'    => 70,
        'MAX_HEALTH'    => 100,
        'MIN_STRENGTH'  => 70,
        'MAX_STRENGTH'  => 80,
        'MIN_DEFENCE'   => 45,
        'MAX_DEFENCE'   => 55,
        'MIN_SPEED'     => 40,
        'MAX_SPEED'     => 50,
        'MIN_LUCK'      => 10,
        'MAX_LUCK'      => 30,
    ];

    const SKILLS = [
        'RAPID_STRIKE'  => 10,
        'MAGIC_SHIELD'  => 20,
    ];
    

}