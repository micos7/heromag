<?php
namespace Tests;
require("./vendor/autoload.php");
use Hero\players\Player;
use PHPUnit\Framework\TestCase;

final class PlayerTest extends TestCase{
    protected $player;

    protected function setUp(){
        $player = $this->getMockBuilder(Player::class)->getMockForAbstractClass();

        $player->setHealth(90);
        $player->setStrength(77);
        $player->setDefence(51);
        $player->setSpeed(45);
        $player->setLuck(30);

        $this->player = $player;
    }


    public function testHealth(){
        $player = $this->player;
        self::assertEquals(90, $player->getHealth());
    }

    public function testStrength(){
        $player = $this->player;
        self::assertEquals(77, $player->getStrength());
    }

    public function testDefence(){
        $player = $this->player;
        self::assertEquals(51, $player->getDefence());
    }

    public function testSpeed(){
        $player = $this->player;
        self::assertEquals(45, $player->getSpeed());
    }

    public function testLuck(){
        $player = $this->player;
        self::assertEquals(30, $player->getLuck());
    }
}