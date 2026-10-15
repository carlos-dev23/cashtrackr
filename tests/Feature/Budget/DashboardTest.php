<?php

use App\Models\Budget;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('show empty state when the user has no budgets', function (){
    $user = User::factory()->create([
        'email_verified_at' => now()
    ]);
    $response = $this->actingAs($user)->get(route('dashboard'));
    $response->assertOk();
    $response->assertSee('No Hay Presupuestos.');
    $response->assertSee('Comienza creando uno');
});

it('only show the authenticated user budgets', function () {
    $user = User::factory()->create([
        'email_verified_at' => now()
    ]);
    Budget::factory()->for($user)->create([
        'name' => 'Mi Presupuesto'
    ]);

    $otherUser = User::factory()->create([
        'email_verified_at' => now()
    ]);
    Budget::factory()->for($otherUser)->create([
        'name' => 'Presupuesto de Otro Usuario'
    ]);

    $response = $this->actingAs($user)->get(route('dashboard'));
    $response->assertOk();
    $response->assertSee('Mi Presupuesto');
    $response->assertDontSee('Presupuesto de Otro Usuario');

});