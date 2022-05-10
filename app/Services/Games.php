<?php

namespace App\Services;


use Illuminate\Contracts\Console\Kernel;

class Games
{
    public function __construct()
    {
        $commands = [];
        foreach (array_keys(\Artisan::all()) as $command){
            if ($this->isApplicationCommand($command)){
                $commands[] = $command;
            }
        }
        return $commands;

    }

    protected function isApplicationCommand(string $signature): bool
    {
        $commands = resolve(Kernel::class)->all();
        return !empty($commands[$signature])
            && strpos(get_class($commands[$signature]), 'App\Commands') === 0;
    }

}
