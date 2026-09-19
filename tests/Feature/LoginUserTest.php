<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('show the login screen', function(){
    $response = $this->get(route('login'));
    $response->assertOk();
});

it('logs in a verified user succesfully', function(){
    User::factory()->create([
        'email' => 'juan@gmail.com',
        'password' => bcrypt('password'),
        'email_verified_at' => now()
    ]);

    $response = $this->post(route('login.store'),[
        'email' => 'juan@gmail.com',
        'password' => 'password'
    ]);
    $response->assertRedirect(route('dashboard'));
    $this->assertAuthenticated();
});

it('does not log in with invalid credentials', function(){
    User::factory()->create([
        'email' => 'juan@gmail.com',
        'password' => bcrypt('password')
    ]);

    $response = $this->from(route('login'))->post(route('login.store'), [
        'email' => 'juan@gmail.com',
        'password' => 'incorect-password'
    ]);

    $response->assertRedirect(route('login'));
    $response->assertSessionHas('error','Credenciales Incorrectas');
    $this->assertGuest();
});

it('prevents unverified user from accesing dashboard',function(){
    User::factory()->unverified()->create([
        'email' => 'juan@gmail.com',
        'password' => bcrypt('password')
    ]);
    $response = $this->post(route('login.store'),[
        'email' => 'juan@gmail.com',
        'password' => 'password'
    ]);

    $response->assertRedirect(route('dashboard'));
    $this->assertAuthenticated();

    $dashboardResponse = $this->get(route('dashboard'));
    $dashboardResponse->assertRedirect(route('verification.notice'));  
});

it('does not allow access to dashboard if email is not verified', function (){
    $user = User::factory()->create([
        'email_verified_at' => null
    ]);

    $response = $this->actingAs($user)->get(route('dashboard'));
    $response->assertRedirect(route('verification.notice'));
});

it('allow access to dashboard if email is verified', function (){
    $user = User::factory()->create([
        'email_verified_at' =>now()
    ]);

    $response = $this->actingAs($user)->get(route('dashboard'));
    $response->assertOk();
});

it('fails login if user does not exist', function(){
    $response = $this->from(route('login'))->post(route('login.store'),[
        'email' => 'noexiste@gmail.com',
        'password' => 'password'
    ]);

    $response->assertRedirect(route('login'));
    $response->assertSessionHasErrors([
        'email' => 'El campo correo electrónico no existe.'
    ]);

    $this->assertGuest();
});