<?php

namespace Hero\players;
use Hero\players\Player;

class Beast extends Player
{

    const STATS = [
        'MIN_HEALTH'    => 60,
        'MAX_HEALTH'    => 90,
        'MIN_STRENGTH'  => 60,
        'MAX_STRENGTH'  => 90,
        'MIN_DEFENCE'   => 40,
        'MAX_DEFENCE'   => 60,
        'MIN_SPEED'     => 40,
        'MAX_SPEED'     => 60,
        'MIN_LUCK'      => 25,
        'MAX_LUCK'      => 40,
    ]; 

    const NAME = 'beast';
}