<?php

namespace App\Commands;

use App\Services\HandStrength;
use Fust\Cards\Deck;
use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use function Termwind\render;

class PlayCommand extends Command
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
    protected $description = 'Start Playing the Game';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Shuffling... Shuffling... Shuffling...');

        $deck = new Deck();
        $deck->shuffle();
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
