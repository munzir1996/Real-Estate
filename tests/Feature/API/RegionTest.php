<?php

namespace Tests\Feature\API;

use App\Models\Region;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_can_get_all_regions()
    {
        $this->withoutExceptionHandling();
        Region::factory(2)->create();

        $response = $this->get('api/regions');

        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'name',
                ]
            ]
        ]);
    }

    /** @test */
    public function guest_can_get_selected_region()
    {
        $this->withoutExceptionHandling();
        $region = Region::factory()->create();

        $response = $this->get('api/regions/'. $region->id);

        $response->assertJsonStructure([
            'data' => [
                'id',
                'name',
            ]
        ]);
    }

}


