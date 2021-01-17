<?php
namespace Hero\game;

use Hero\factory\Factory;
use Hero\players\Beast;
use Hero\players\Hero;
use Hero\skills\Strike;
use Hero\skills\Shield;

class Game {

    const ROUNDS = 20;

    const HERO = 'hero';
    const BEAST = 'beast';

    private $hero;

    private $beast;

    private $firstAttacker;

    private function createHero(){

        $this->hero = Factory::getPlayer('Hero');
        $this->hero->setPlayerName($this->hero::NAME);
        $this->hero->setHealth(rand($this->hero::STATS['MIN_HEALTH'],$this->hero::STATS['MAX_HEALTH']));
        $this->hero->setStrength(rand($this->hero::STATS['MIN_STRENGTH'],$this->hero::STATS['MAX_STRENGTH']));
        $this->hero->setDefence(rand($this->hero::STATS['MIN_DEFENCE'],$this->hero::STATS['MAX_DEFENCE']));
        $this->hero->setSpeed(rand($this->hero::STATS['MIN_SPEED'],$this->hero::STATS['MAX_SPEED']));
        $this->hero->setLuck(rand($this->hero::STATS['MIN_LUCK'],$this->hero::STATS['MAX_LUCK']));


        return $this;
    }


    private function createBeast(){

        $this->beast = Factory::getPlayer('Beast');
        $this->beast->setPlayerName($this->beast::NAME);
        $this->beast->setHealth(rand($this->beast::STATS['MIN_HEALTH'],$this->beast::STATS['MAX_HEALTH']));
        $this->beast->setStrength(rand($this->beast::STATS['MIN_STRENGTH'],$this->beast::STATS['MAX_STRENGTH']));
        $this->beast->setDefence(rand($this->beast::STATS['MIN_DEFENCE'],$this->beast::STATS['MAX_DEFENCE']));
        $this->beast->setSpeed(rand($this->beast::STATS['MIN_SPEED'],$this->beast::STATS['MAX_SPEED']));
        $this->beast->setLuck(rand($this->beast::STATS['MIN_LUCK'],$this->beast::STATS['MAX_LUCK']));


        return $this;
    }

    private function getFirstAttacker(){
        if($this->hero->getSpeed() > $this->beast->getSpeed()){
            $this->firstAttacker = self::HERO;
        }
        if($this->hero->getSpeed() < $this->beast->getSpeed()){
            $this->firstAttacker = self::BEAST;
        }
        if($this->hero->getSpeed() == $this->beast->getSpeed()  && $this->hero->getLuck() > $this->beast->getLuck() ){
            $this->firstAttacker = self::HERO;
        }
        if($this->hero->getSpeed() == $this->beast->getSpeed()  && $this->hero->getLuck() < $this->beast->getLuck() ){
            $this->firstAttacker = self::BEAST;
        }
        return $this;
    }

    public function startBattle(){
        $this->createHero();
        $this->createBeast();
        $this->getFirstAttacker();

        for($i = 0;$i<Game::ROUNDS;$i++){
                
            if($this->hero->getHealth() > 0 && $this->beast->getHealth() > 0 ){
                $this->fight($this->firstAttacker);
                // echo "Hero health is ".$this->hero->getHealth() . PHP_EOL;
                // echo "Beast health is ".$this->beast->getHealth() . PHP_EOL;
                if($this->firstAttacker == self::HERO){
                    $this->firstAttacker = self::BEAST;
                }else{

                    $this->firstAttacker = self::HERO;
                }
                
            }
            $this->declareWinner($i);
        }


    }


    private function fight($attacker){
        if($attacker == self::HERO){
            $beastDamage = $this->getDamage($this->hero,$this->beast);
            $beastDamage = $this->useStrike($beastDamage);
            if(rand(1,100) <= $this->beast->getLuck()){
                $beastDamage = 0;
                echo "Beast got lucky!" .PHP_EOL;
            }
            $this->beast->setHealth($this->beast->getHealth()-$beastDamage);
            echo "Hero attacked the beast for ".$beastDamage. " damage  ".PHP_EOL ;
            if($this->beast->getHealth() > 0){

                echo "The beast has ".$this->beast->getHealth(). " remainig health  ".PHP_EOL ;
            }
        }
        if($attacker == self::BEAST){
            $heroDamage = $this->getDamage($this->beast,$this->hero);
            $heroDamage = $this->useShield($heroDamage);
            if(rand(1,100) <= $this->hero->getLuck()){
                $heroDamage = 0;
                echo "Hero got lucky! ".PHP_EOL;
            }
            $this->hero->setHealth($this->hero->getHealth()-$heroDamage);
            echo "Beast attacked the hero for ".$heroDamage. " damage  ".PHP_EOL;
            if($this->hero->getHealth() >0){

                echo "The hero  has ".$this->hero->getHealth(). " remainig health  ".PHP_EOL ;
            }
        }

        if($this->hero->getHealth() <=0){
            echo "The beast is the winner!".PHP_EOL; 
        }
        if($this->beast->getHealth() <=0){
            echo "The hero is the winner!".PHP_EOL; 
        }
    }

    private function getDamage($attacker,$defender){
        return $attacker->getStrength() - $defender->getDefence();
    }

    private function useShield($damage){
        $shield_chance = $this->hero::SKILLS['MAGIC_SHIELD'];
        $use_shield = rand(1,100) <= $shield_chance;
        if($use_shield){
            $shield = new Shield($shield_chance);
            echo "Hero used the shield abilty! " .PHP_EOL;
            return $shield->getHalfDamage($damage);
        }
        return $damage;
    }

    private function useStrike($damage){
        $strike_chance = $this->hero::SKILLS['RAPID_STRIKE'];
        $use_strike = rand(1,100) <= $strike_chance;
        
        if($use_strike){
            $strike = new Strike($strike_chance);
            echo "Hero used the strike abilty! ".PHP_EOL;
            return $strike->getTwiceDamage($damage);            
        }
        return $damage;
    }

    private function declareWinner($i){
        if($i == self::ROUNDS){

            if($this->hero->getHealth() > $this->beast->getHealth()){
                echo "Hero won!".PHP_EOL;
            }else if($this->hero->getHealth() < $this->beast->getHealth()){
                echo "Beast won!".PHP_EOL;
            }else if($this->hero->getHealth() == $this->beast->getHealth()){
    
                echo "Incredible it`s a tie!".PHP_EOL;
            }
        }
        
    }

}