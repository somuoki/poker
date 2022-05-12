<?php

namespace App\Commands;

use App\Services\CardValues;
use App\Services\FiveCardHandStrength;
use Fust\Cards\Deck;
use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use function Termwind\render;

class FiveCardCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'play:five-card';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Play the five card poker variant';

    /**
     * Execute the five card command.
     *
     * @return mixed
     * @throws \Exception
     */
    public function handle()
    {
        $this->info('Shuffling... Shuffling... Shuffling...');

        // create a new deck of cards
        $deck = new Deck();

        // Shuffle deck
        $deck->shuffle();

        // Give player five cards
        $hand = $deck->drawHand(5);

        // Show player their cards
        $handCards = '';
        foreach ($hand as $card){
            $card = new CardValues($card);
            $handCards .= $card->value().$card->suitSign().' ';
        }

        $this->info(render('Your hand: ' .$handCards));
        $this->info('You have: '. new FiveCardHandStrength($hand));
    }

    /**
     * Define the command's schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    public function schedule(Schedule $schedule): void
    {
        // $schedule->command(static::class)->everyMinute();
    }
}
