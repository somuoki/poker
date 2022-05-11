<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

class PlayCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'play';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Start Playing Poker';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $game = $this->choice(
            'Which Variant do you want to play',
            [
                "1" => 'Five Card',
                "2" => 'Badugi',
            ]
        );

        // Check selected game and play the game
        if ($game == 'Five Card'){
            $this->comment('You are now playing the Five Card variant');
            // use command to fetch the game
            PlayCommand::call('play:five-card');

        }else {
            $this->comment('Any other game has not been implemented the option is only there to showcase the possibility of expansion');
        }

        // Check if player wants to retry, change game or exit
        if ($this->confirm('Do you wish to retry/change game?', true)) {
            PlayCommand::call('play');
        }
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
