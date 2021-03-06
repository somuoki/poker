<?php

namespace Tests\Feature;

use Fust\Cards\Card;
use Fust\Cards\Contracts\CardProvider;
use Fust\Cards\Deck;
use Mockery as m;
use Tests\TestCase;
use UnderflowException;

class DeckTest extends TestCase
{
    /**
     * Check if deck has 52 cards.
     *
     * @return void
     */

    public function testDeckCount()
    {
        $deck = new Deck;

        $this->assertEquals(52, $deck->count());
    }

    public function testAllCardsInDeckAreDifferent()
    {
        $deck = new Deck();
        $hand = $deck->drawHand(52);
        for ($i=0; $i < 51; $i++){
            $this->assertNotEquals($hand[$i], $hand[$i + 1]);
        }
    }

    public function testDraw()
    {
        $deck = new Deck;
        $c = $deck->draw();

        $this->assertInstanceOf('Fust\Cards\Card', $c);
        $this->assertEquals(51, $deck->count());
        $this->assertEquals(1, $deck->countDrawn());
    }

    /**
     * @expectedException UnderflowException
     */
    public function testDeckHadNoCardsException()
    {
        $this->expectException(UnderflowException::class);
        $deck = new Deck(new EmptyCardProvider);
        $deck->draw();
    }

    public function testDrawHand()
    {

        $deck = new Deck();

        $h = $deck->drawHand();
        $this->assertCount(1,$h);

        $hh = $deck->drawHand(10);
        $this->assertCount(10,$hh);

    }

    public function testDrawCard()
    {

        $deck = new Deck();

        $this->assertCount(52,$deck->getCards() );
        $this->assertCount(0,$deck->getDrawnCards() );
        $deck->draw();
        $deck->draw();
        $this->assertCount(50,$deck->getCards() );
        $this->assertCount(2,$deck->getDrawnCards() );
    }

    public function testShuffleResets()
    {

        $deck = new Deck();
        $deck->draw();
        $deck->draw();
        $this->assertCount(50,$deck->getCards() );
        $this->assertCount(2,$deck->getDrawnCards() );

        $deck->shuffle();

        $this->assertCount(52,$deck->getCards() );
        $this->assertCount(0,$deck->getDrawnCards() );
    }

    public function testShuffleShuffles()
    {

        $deck = new Deck();
        $shuffle = m::mock('Fust\Cards\Contracts\Shuffleable')->shouldReceive('shuffle')->once()->andReturn(true)->getMock();
        $deck->setShuffler($shuffle);

        $v = $deck->shuffle();

        $this->assertTrue($v);
    }
}

class EmptyCardProvider implements CardProvider{

    public function getCards(){
        return	[];
    }
}

