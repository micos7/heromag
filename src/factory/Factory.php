<?php
namespace Hero\factory;

use Hero\players\Beast;
use Hero\players\Hero;

// include '../players/Beast.php';
// include '../players/Hero.php';

class Factory {
    private $fObject;
    public static function getPlayer($player){
        switch($player){
            case "Hero":
                $fObject = new Hero();
                break;
            case "Beast":
                $fObject = new Beast();
                break;
                default:
                    $fObject = new Hero();
                    break;
        }
        return $fObject;
    }
}