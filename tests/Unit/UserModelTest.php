<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserModelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_implements_jwt_subject_interface()
    {
        $user = new User();
        $this->assertInstanceOf(\Tymon\JWTAuth\Contracts\JWTSubject::class, $user);
    }

    /** @test */
    public function get_jwt_identifier_returns_primary_key()
    {
        $user = User::factory()->create();
        $this->assertEquals($user->id, $user->getJWTIdentifier());
    }

    /** @test */
    public function get_jwt_custom_claims_returns_empty_array()
    {
        $user = User::factory()->create();
        $this->assertEquals([], $user->getJWTCustomClaims());
    }
}
