<?php

namespace Tests\Feature\API;

use App\Models\City;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CityTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_can_get_all_cities()
    {
        City::factory(2)->create();

        $response = $this->get('api/cities');

        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'region_id',
                    'region',
                ]
            ]
        ]);

    }

    /** @test */
    public function guest_can_get_selected_city()
    {
        $this->withoutExceptionHandling();
        $city = City::factory()->create();

        $response = $this->get('api/cities/'. $city->id);

        $response->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'region_id',
                'region',
            ]
        ]);
    }

}
