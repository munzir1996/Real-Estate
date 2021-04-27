<?php

namespace Tests\Feature\API;

use App\Models\Location;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LocationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_can_get_all_locations()
    {
        Location::factory(2)->create();

        $response = $this->get('/api/locations');

        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'longetitue',
                    'latitude',
                    'street',
                    'address',
                    'city'
                ]
            ]
        ]);
    }

    /** @test */
    public function guest_can_get_selected_location()
    {
        $location = Location::factory()->create();

        $response = $this->get('/api/locations/'. $location->id);

        $response->assertJsonStructure([
            'data' => [
                'id',
                'longetitue',
                'latitude',
                'street',
                'address',
                'city'
            ]
        ]);
    }

}


