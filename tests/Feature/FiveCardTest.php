<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FiveCardTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */


    public function test_five_card_command(){
        $this->artisan('play:five-card')
            ->expectsOutputToContain('You have')
            ->assertExitCode(0);
        $this->assertCommandCalled('play:five-card');
    }
}
