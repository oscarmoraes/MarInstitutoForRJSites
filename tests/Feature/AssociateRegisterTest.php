<?php

namespace Tests\Feature;

use App\Livewire\AssociateRegister;
use App\Models\City;
use App\Models\State;
use Livewire\Livewire;
use Tests\TestCase;

class AssociateRegisterTest extends TestCase
{
    public function test_selecting_a_state_populates_cities_and_sets_first_city(): void
    {
        $state = State::create([
            'title' => 'São Paulo',
            'letter' => 'SP',
            'iso' => 35,
            'slug' => 'sao-paulo',
        ]);

        $firstCity = City::create([
            'state_id' => $state->id,
            'title' => 'Campinas',
            'iso' => 3500,
            'iso_ddd' => 19,
            'slug' => 'campinas',
        ]);

        City::create([
            'state_id' => $state->id,
            'title' => 'São Paulo',
            'iso' => 3550,
            'iso_ddd' => 11,
            'slug' => 'sao-paulo',
        ]);

        Livewire::test(AssociateRegister::class)
            ->set('state_id', $state->id)
            ->assertSet('cities', function ($cities) use ($firstCity) {
                return $cities->pluck('id')->contains($firstCity->id)
                    && $cities->count() === 2;
            })
            ->assertSet('city_id', $firstCity->id);
    }
}
