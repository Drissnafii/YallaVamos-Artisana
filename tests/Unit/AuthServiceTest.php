<?php

namespace Tests\Unit;

use App\Models\User;
use App\Services\AuthService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthServiceTest extends TestCase
{
    use RefreshDatabase;

    protected AuthService $authService;

    public function setUp(): void
    {
        parent::setUp();
        $this->authService = new AuthService();

        // Ensure session is started for testing session interactions
        // Not always strictly necessary in unit tests depending on setup,
        // but good practice when testing session-dependent code.
        if (!session()->isStarted()) {
            session()->start();
        }

        config(['auth.defaults.guard' => 'api']);
        config(['jwt.user' => User::class]);
        config(['jwt.identifier' => 'id']);
        // Optional: Ensure blacklist is enabled for relevant tests
        // config(['jwt.blacklist_enabled' => true]);
    }

    // ... (register and login tests remain mostly the same, ensure password handling)

    /** @test */
    public function register_creates_new_user_and_returns_token(): void
    {
        $userData = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
        ];

        $result = $this->authService->register($userData);

        $this->assertIsArray($result);
        $this->assertArrayHasKey('user', $result);
        $this->assertArrayHasKey('token', $result);
        $this->assertInstanceOf(User::class, $result['user']);
        $this->assertEquals($userData['email'], $result['user']->email);
        $this->assertIsString($result['token']);
        $this->assertNotEmpty($result['token']);

        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
            'name' => 'Test User'
        ]);

        $user = User::where('email', $userData['email'])->first();
        $this->assertTrue(Hash::check($userData['password'], $user->password));
    }

    /** @test */
    public function login_returns_token_for_valid_credentials(): void
    {
        $password = 'password123';
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make($password)
        ]);

        $credentials = [
            'email' => 'test@example.com',
            'password' => $password
        ];

        // Pre-condition: Ensure token is not in session before login
        $this->assertNull(session('jwt_token'));

        $result = json_decode(json_encode($this->authService->login($credentials)), true);

        $this->assertIsArray($result);
        $this->assertArrayHasKey('token', $result);
        $this->assertArrayHasKey('token_type', $result);
        $this->assertArrayHasKey('expires_in', $result);
        $this->assertEquals('bearer', $result['token_type']);
        $this->assertIsString($result['token']);
        $this->assertNotEmpty($result['token']);
        $this->assertIsInt($result['expires_in']);

        // Assert that the token IS stored in the session after login
        $this->assertEquals($result['token'], session('jwt_token'));
    }

    // ... (login_throws_exception tests remain the same) ...


    /** @test */
    public function me_returns_authenticated_user_using_session_token(): void
    {
        $password = 'password'; // Assuming factory default
        $user = User::factory()->create([
            'name' => 'Current User',
            'email' => 'current@example.com',
            'password' => Hash::make($password)
        ]);

         // --- Setup ---
        // 1. Log in using the service to get a token and populate session
        $loginResult = $this->authService->login([
            'email' => $user->email,
            'password' => $password
        ]);
        $token = $loginResult['token'];

        // 2. Ensure token is in session (redundant check, but good for clarity)
        $this->assertEquals($token, session('jwt_token'));

        // --- Action ---
        // Call the me method, which should use the session token
        $result = $this->authService->me();

        // --- Assertions ---
        $this->assertInstanceOf(User::class, $result);
        $this->assertEquals($user->id, $result->id);
        $this->assertEquals($user->name, $result->name);
        $this->assertEquals($user->email, $result->email);

        // Ensure sensitive information like password hash isn't returned
        $this->assertArrayNotHasKey('password', $result->toArray());
    }
}
