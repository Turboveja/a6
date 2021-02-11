<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * Class AltaConciertoTest
 * @package Tests\Feature
 */
class AltaConciertoTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->post('conciertos/alta',[
            'nombre' => 'The O2 Arena Muse',
            'fecha' => '2019-09-15',
            'recinto_id' => '1',
            'numero_espectadores' => '100',
            'promotor_id' => '1',
            'grupos_ids' => [1,2],
            'medios_publicitarios_ids' => [1,2],
        ]);

        $response->assertStatus(200);
    }
}
