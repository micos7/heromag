<?php
namespace Tests;

require(__DIR__."/../vendor/autoload.php");

use Hero\game\Game;
use Hero\players\Hero;
use Hero\players\Beast;
use Hero\players\Player;
use PHPUnit\Framework\TestCase;


final class GameTest extends TestCase{
    protected $hero;
    protected $beast;
    protected $game;

    protected function setUp(){
        $hero = $this->getMockBuilder(Hero::class)->getMockForAbstractClass();

        $hero->setHealth(88);
        $hero->setStrength(77);
        $hero->setDefence(51);
        $hero->setSpeed(45);
        $hero->setLuck(30);

        $this->hero = $hero;

        $beast = $this->getMockBuilder(Beast::class)->getMockForAbstractClass();

        $beast->setHealth(81);
        $beast->setStrength(75);
        $beast->setDefence(55);
        $beast->setSpeed(41);
        $beast->setLuck(26);

        $this->beast = $beast;

        $game = new Game();

        $this->game = $game;
    }


    public function testFigters(){
        $heroHealth = $this->hero->getHealth() > 0;
        $beastHealth = $this->beast->getHealth() >0 ;
        self::assertTrue($heroHealth);
        self::assertTrue($beastHealth);
    }

    public function testStartsFirst(){
       
        $heroStarts = $this->beast->getLuck() < $this->hero->getLuck();
        self::assertTrue($heroStarts);

    }

    public function testDamage(){
        $damage =  $this->hero->getStrength() - $this->beast->getDefence();
        self::assertEquals(22, $damage);
    }

    public function testThereIsAWinner(){
        ob_start();
        $this->game->startBattle();
        $output = ob_get_clean();
        self::assertStringContainsString('winner',$output);
    }


}