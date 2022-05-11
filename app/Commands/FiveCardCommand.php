<?php

namespace App\Commands;

use App\Services\HandStrength;
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
     * Execute the console command.
     *
     * @return mixed
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

        $handCards = '';
        foreach ($hand as $card){
            $handCards .= $card->value().$card->suitSign().' ';
        }

        $this->info(render('Your hand: ' .$handCards));
        $this->info('You have: '. new HandStrength($hand));
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
