<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PlayCommandTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_play()
    {
        $this->artisan('play')
            ->expectsChoice('Which Variant do you want to play','Badugi',["1" => 'Five Card',"2" => 'Badugi'])
             ->assertNotExitCode(0)
            ->expectsQuestion('Do you wish to retry/change game?', false)
            ->assertExitCode(0);
    }

    public function testChooseFiveCard()
    {
        $this->artisan('play')
            ->expectsChoice('Which Variant do you want to play','Five Card',["1" => 'Five Card', "2" => 'Badugi'])
            ->expectsQuestion('Do you wish to retry/change game?', false)
            ->assertExitCode(0);
        $this->assertCommandCalled('play:five-card');
    }

}
