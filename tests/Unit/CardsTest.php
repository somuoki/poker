<?php

namespace Tests\Feature;

use Fust\Cards\Card;
use Fust\Cards\Suit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CardsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function testCardSuit()
    {
        $suit = Suit::club();

        $card = new Card(Card::ACE, $suit);

        $this->assertEquals($card->suit()->value(), $suit->value());
        $this->assertEquals($card->suit()->name(), $suit->name());
        $this->assertEquals($card->suitName(), $suit->name());
    }

    public function testAceCard()
    {
        $card = new Card(Card::ACE, Suit::diamond());
        $this->assertTrue($card->isAce());
//      $this->assertEquals(Card::ACE, $card->value());

        //negate the test too
        $card = new Card(2, Suit::diamond());
        $this->assertFalse($card->isAce());
    }

    public function testFaceCard()
    {
        $card = new Card(Card::KING, Suit::diamond());
        $this->assertTrue($card->isKing());
        $this->assertTrue($card->isFaceCard());

        $card = new Card(Card::QUEEN, Suit::diamond());
        $this->assertTrue($card->isQueen());
        $this->assertTrue($card->isFaceCard());

        $card = new Card(Card::JACK, Suit::diamond());
        $this->assertTrue($card->isJack());
        $this->assertTrue($card->isFaceCard());

    }

    public function testNotFaceCard()
    {
        $card = new Card(5, Suit::diamond());
        $this->assertFalse($card->isKing());
        $this->assertFalse($card->isQueen());
        $this->assertFalse($card->isJack());
        $this->assertFalse($card->isFaceCard());

    }
}
