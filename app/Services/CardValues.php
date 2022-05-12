<?php

namespace App\Services;

use Exception;
use Fust\Cards\Card;

class CardValues
{

    public Card $card;


    /**
     * @throws Exception
     */
    public function __construct(Card $card) {
        $this->card = $card;
    }

    public function value(): int|string
    {
        return match ($this->card->value()){
            100 => 'A',
            101 => 'J',
            102 => 'Q',
            103 => 'K',
            default => $this->card->value()
        };
    }

    /**
     * @throws Exception
     */
    public function suitSign(): string
    {
        return match ($this->card->suit()->value()){
            100 => '<span>&#9827;</span>',
            101 => '<span>&#9830;</span>',
            102 => '<span>&#9829;</span>',
            103 => '<span>&#9824;</span>',
            default => throw new Exception('Unexpected match value'),
        };
    }


}
