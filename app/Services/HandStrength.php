<?php

namespace App\Services;

class HandStrength
{
    public array $cards;

    public function __construct(array $cards){
        $this->cards = $cards;
        $this->checkHand();
    }

    public function checkHand(): string
    {
        if (count($this->cards) != 5){
            return 'No Good Hand';
        }

        if ($this->isStraightFlush()){
            return 'Straight Flush';
        }elseif ($this->isFlush()){
            return 'Flush';
        }elseif ($this->isStraight()){
            return 'Straight';
        }elseif ($this->is4s()){
            return 'Four of a Kind';
        }elseif ($this->isFullHouse()){
            return 'Full House';
        }elseif ($this->is3s()){
            return 'Three of a Kind';
        }elseif ($this->is2Pairs()){
            return  '2 Pairs';
        }elseif ($this->is1Pair()){
            return '1 Pair';
        }else {
            return 'High Cards';
        }
    }


    /**
     * Checks for flush
     * Sort cards by suit and if first card suit is equal to last card suit
     *
     * @return bool
     */
    public function isFlush(): bool
    {
        $cards = $this->sortBySuit();
        return ($cards[0]->suit()->value() == $cards[4]->suit()->value());
    }


    /**
     * Sorts All cards in deck in terms of suit
     *
     * @return array
     */
    public function sortBySuit(): array
    {
//        echo $this->cards[0]->suit()->value();
//        var_dump($this->cards);
//        $keys = array_column($this->cards, 'suit');
//        array_multisort($keys, SORT_ASC, $this->cards);
//        return $this->cards;

        usort($this->cards, fn($a, $b) => $a->suit()->value() <=> $b->suit()->value() );
        return $this->cards;
    }

    /**
     * Sorts all cards in deck by Rank
     *
     * @return array
     */
    public function sortByRank(): array
    {
//        echo $this->cards->faceValue;
//        $keys = array_column($this->cards, 'faceValue');
//        array_multisort($keys, SORT_ASC, $this->cards);
//        return $this->cards;
        usort($this->cards, fn($a, $b) => $a->value() <=> $b->value());
        return $this->cards;

    }

    /**
     * Check for a straight hand
     * Sort hand by rank
     * Checks if first card is ACE then checks if straight from ACE
     * else check if cards are in order
     * @return boolean
     */
    public function isStraight(): bool
    {
        $cards = $this->sortByRank();
        if ($cards[0]->value() == 1){
            return(
                $cards[1]->value() == 2 && $cards[2]->value() == 3 && $cards[3]->value() == 4 && $cards[4]->value() == 5
                ||
                $cards[1]->value() == 10 && $cards[2]->value() == 11 && $cards[3]->value() == 12 && $cards[4]->value() == 13
            );
        }else{
            $nextRank = $cards[0]->value() + 1;

            for ($i = 1; $i < 5; $i++){
                if ($cards[$i]->value() != $nextRank){
                    return False;
                }
                $nextRank++;
            }
            return TRUE;
        }
    }

    /**
     * Check for four of a kind
     * Sort cards by rank then check there are four similar cards
     * @return boolean
     */
    public function is4s(): bool
    {
        $cards = $this->sortByRank();
        $highRankedUnmatched = // check if first four cards are the same
            $cards[0]->value() == $cards[1]->value() &&
            $cards[1]->value() == $cards[2]->value() &&
            $cards[2]->value() == $cards[3]->value();
        $lowRankedUnmatched = // check if last four cards are the same
            $cards[1]->value() == $cards[2]->value() &&
            $cards[2]->value() == $cards[3]->value() &&
            $cards[3]->value() == $cards[4]->value();
        return($highRankedUnmatched || $lowRankedUnmatched);
    }

    /**
     * Check for Full House
     * Check if first three cards are similar + last two cards are also similar and vice-versa
     * @return bool
     */
    public function isFullHouse(): bool
    {
        $cards = $this->sortByRank();
        $firstThree =
            $cards[0]->value() == $cards[1]->value() &&
            $cards[1]->value() == $cards[2]->value() &&
            $cards[3]->value() == $cards[4]->value();
        $lastThree =
            $cards[0]->value() == $cards[1]->value() &&
            $cards[2]->value() == $cards[3]->value() &&
            $cards[3]->value() == $cards[4]->value();
        return($firstThree || $lastThree);
    }

    /**
     * Check for Three of a Kind
     * @return bool
     */
    public function is3s(): bool
    {
        $cards = $this->sortByRank();
        if ($this->isFullHouse() || $this->is4s()){
            return false;
        }
        $firstThree =
            $cards[0]->value() == $cards[1]->value() &&
            $cards[1]->value() == $cards[2]->value();
        $middleThree =
            $cards[1]->value() == $cards[2]->value() &&
            $cards[2]->value() == $cards[3]->value();
        $lastThree =
            $cards[2]->value() == $cards[3]->value() &&
            $cards[3]->value() == $cards[4]->value();
        return($firstThree || $middleThree || $lastThree);
    }

    /**
     * Checks for Two Pairs
     * @return bool
     */
    public function is2Pairs(): bool
    {
        $cards = $this->sortByRank();
        if ($this->is3s()){
            return false;
        }
        $firstOdd =
            $cards[1]->value() == $cards[2]->value() &&
            $cards[3]->value() == $cards[4]->value();
        $middleOdd =
            $cards[0]->value() == $cards[1]->value() &&
            $cards[3]->value() == $cards[4]->value();
        $lastOdd =
            $cards[1]->value() == $cards[2]->value() &&
            $cards[2]->value() == $cards[3]->value();

        return($firstOdd || $middleOdd || $lastOdd);
    }

    /**
     * Check for 1 pair
     * @return bool
     */
    public function is1Pair(): bool
    {
        $cards = $this->sortByRank();
        if ($this->is2Pairs()){
            return false;
        }

        return $cards[0]->value() == $cards[1]->value()
            || $cards[1]->value() == $cards[2]->value()
            || $cards[2]->value() == $cards[3]->value()
            || $cards[3]->value() == $cards[4]->value();
    }

    /**
     * Check for a Straight Flush
     * Check for both flush and straight
     * @return bool
     */
    public function isStraightFlush(): bool
    {
        return($this->isFlush() && $this->isStraight());
    }

//    public function isHighCards()
//    {
//    }

    public function __toString(): string
    {
        return $this->checkHand();
    }

}
