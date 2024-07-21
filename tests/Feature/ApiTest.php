<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;
use Modules\Block\Models\Block;
use Modules\Flat\Models\Flat;
use Modules\Complaint\Models\Complaint;
use App\Models\User;

class ApiTest extends TestCase
{
    use RefreshDatabase;

    protected $token;

    // Setup before each test
    protected function setUp(): void
    {
        parent::setUp();

        // Ensure the database is migrated
         $this->artisan('migrate:refresh --seed');
         //$this->artisan('db:seed');

        // Create personal access client
        $clientRepository = new \Laravel\Passport\ClientRepository();
        $client = $clientRepository->createPersonalAccessClient(null, 'Test Personal Access Client', 'http://192.168.0.106:8000');

        // Save the personal access client ID and secret to the environment
        config(['passport.personal_access_client.id' => $client->id]);
        config(['passport.personal_access_client.secret' => $client->secret]);

        // Register and login to get a token
        $response = $this->postJson('/api/register', [
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'password' => 'password',
        ]);

        $response->assertStatus(200);

        $response = $this->postJson('/api/login', [
            'email' => 'testuser@example.com',
            'password' => 'password',
        ]);

        $response->assertStatus(200);
        $this->token = $response->json('token');
    }

    // Complaints API tests
    public function testGetComplaints()
    {
        $response = $this->getJson('/api/complaints', [
            'Authorization' => "Bearer $this->token",
            'Accept' => 'application/json',
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'status',
            'data' => [
                '*' => ['id', 'subject', 'description', 'status', 'priority', 'block_id', 'flat_id'],
            ],
            'message',
        ]);
    }

    public function testPostComplaint()
    {
        // Create block and flat using factory
        $block = Block::factory()->create();
        $flat = Flat::factory()->create();

        // Post complaint data
        $response = $this->postJson(
            '/api/complaints',
            [
                'block_id' => $block->id,
                'flat_id' => $flat->id,
                'subject' => 'Water related issue',
                'description' => 'Problem with water',
                'priority' => 'medium',
            ],
            [
                'Authorization' => "Bearer {$this->token}",
                'Accept' => 'application/json',
            ],
        );

        $response->assertStatus(201);
        $response->assertJsonStructure(['status', 'data' => ['id', 'subject', 'description', 'status', 'priority', 'block_id', 'flat_id'], 'message']);
    }

    public function testUpdateComplaint()
    {
         // Create block and flat using factory
         $block = Block::factory()->create();
         $flat = Flat::factory()->create();
         $complaint = Complaint::factory()->create();
       

        $response = $this->putJson(
            "/api/complaints/{$complaint->id}",
            [
                'subject' => 'Updated subject',
                'description' => 'Updated description',
                'priority' => 'high',
            ],
            [
                'Authorization' => "Bearer $this->token",
                'Accept' => 'application/json',
            ],
        );

        $response->assertStatus(200);
        $response->assertJsonStructure(['status', 'data' => ['id', 'subject', 'description', 'status', 'priority', 'block_id', 'flat_id'], 'message']);
    }

    public function testDeleteComplaint()
    {
        // Create a complaint first
        $complaint = \App\Models\Complaint::create([
            'block_id' => 1,
            'flat_id' => 1,
            'subject' => 'Delete subject',
            'description' => 'Delete description',
            'priority' => 'medium',
        ]);

        $response = $this->deleteJson(
            "/api/complaints/{$complaint->id}",
            [],
            [
                'Authorization' => "Bearer $this->token",
                'Accept' => 'application/json',
            ],
        );

        $response->assertStatus(204);
    }

    // Visitor API tests
    public function testGetVisitors()
    {
        $response = $this->getJson('/api/visitors', [
            'Authorization' => "Bearer $this->token",
            'Accept' => 'application/json',
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            '*' => ['id', 'name', 'contact_number', 'block_id', 'flat_id', 'vehicle_number', 'purpose', 'check_in_date', 'check_out_date'],
        ]);
    }

    public function testPostVisitor()
    {
        $response = $this->postJson(
            '/api/visitors',
            [
                'name' => 'Harry',
                'contact_number' => '32142432',
                'block_id' => 1,
                'flat_id' => 1,
                'vehicle_number' => '32432432',
                'purpose' => 'Visit',
                'check_in_date' => '2024-07-13',
                'check_out_date' => '2024-07-13',
            ],
            [
                'Authorization' => "Bearer $this->token",
                'Accept' => 'application/json',
            ],
        );

        $response->assertStatus(200);
        $response->assertJsonFragment(['name' => 'Harry']);
    }

    public function testUpdateVisitor()
    {
        // Create a visitor first
        $visitor = \App\Models\Visitor::create([
            'name' => 'Old Name',
            'contact_number' => '12345678',
            'block_id' => 1,
            'flat_id' => 1,
            'vehicle_number' => '1234',
            'purpose' => 'Visit',
            'check_in_date' => '2024-07-13',
            'check_out_date' => '2024-07-13',
        ]);

        $response = $this->putJson(
            "/api/visitors/{$visitor->id}",
            [
                'name' => 'Updated Name',
                'contact_number' => '87654321',
                'block_id' => 1,
                'flat_id' => 1,
                'vehicle_number' => '5678',
                'purpose' => 'Updated Visit',
                'check_in_date' => '2024-07-13',
                'check_out_date' => '2024-07-13',
            ],
            [
                'Authorization' => "Bearer $this->token",
                'Accept' => 'application/json',
            ],
        );

        $response->assertStatus(200);
        $response->assertJsonFragment(['name' => 'Updated Name']);
    }

    public function testDeleteVisitor()
    {
        // Create a visitor first
        $visitor = \App\Models\Visitor::create([
            'name' => 'Delete Name',
            'contact_number' => '12345678',
            'block_id' => 1,
            'flat_id' => 1,
            'vehicle_number' => '1234',
            'purpose' => 'Delete Visit',
            'check_in_date' => '2024-07-13',
            'check_out_date' => '2024-07-13',
        ]);

        $response = $this->deleteJson(
            "/api/visitors/{$visitor->id}",
            [],
            [
                'Authorization' => "Bearer $this->token",
                'Accept' => 'application/json',
            ],
        );

        $response->assertStatus(204);
    }

    // Parking API tests
    public function testGetParking()
    {
        $response = $this->getJson('/api/parking', [
            'Authorization' => "Bearer $this->token",
            'Accept' => 'application/json',
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            '*' => ['id', 'block_id', 'flat_id', 'parking_id', 'allocation_date', 'expiration_date'],
        ]);
    }

    public function testGetParkingSlots()
    {
        $response = $this->getJson('/api/parking_slots', [
            'Authorization' => "Bearer $this->token",
            'Accept' => 'application/json',
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            '*' => ['id', 'slot_number', 'status'],
        ]);
    }

    public function testPostParking()
    {
        $response = $this->postJson(
            '/api/parking',
            [
                'block_id' => 1,
                'flat_id' => 1,
                'parking_id' => 40,
                'allocation_date' => '2024-03-17',
                'expiration_date' => '2024-04-17',
            ],
            [
                'Authorization' => "Bearer $this->token",
                'Accept' => 'application/json',
            ],
        );

        $response->assertStatus(200);
        $response->assertJsonFragment(['parking_id' => 40]);
    }

    public function testUpdateParking()
    {
        // Create a parking record first
        $parking = \App\Models\Parking::create([
            'block_id' => 1,
            'flat_id' => 1,
            'parking_id' => 40,
            'allocation_date' => '2024-03-17',
            'expiration_date' => '2024-04-17',
        ]);

        $response = $this->putJson(
            "/api/parking/{$parking->id}",
            [
                'block_id' => 1,
                'flat_id' => 1,
                'parking_id' => 40,
                'allocation_date' => '2024-04-01',
                'expiration_date' => '2024-05-01',
            ],
            [
                'Authorization' => "Bearer $this->token",
                'Accept' => 'application/json',
            ],
        );

        $response->assertStatus(200);
        $response->assertJsonFragment(['allocation_date' => '2024-04-01']);
    }

    public function testDeleteParking()
    {
        // Create a parking record first
        $parking = \App\Models\Parking::create([
            'block_id' => 1,
            'flat_id' => 1,
            'parking_id' => 40,
            'allocation_date' => '2024-03-17',
            'expiration_date' => '2024-04-17',
        ]);

        $response = $this->deleteJson(
            "/api/parking/{$parking->id}",
            [],
            [
                'Authorization' => "Bearer $this->token",
                'Accept' => 'application/json',
            ],
        );

        $response->assertStatus(204);
    }

    // Invoice API tests
    public function testGetInvoice()
    {
        $response = $this->getJson('/api/invoice', [
            'Authorization' => "Bearer $this->token",
            'Accept' => 'application/json',
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            '*' => ['id', 'amount', 'due_date', 'status'],
        ]);
    }

    // Flats API tests
    public function testGetFlats()
    {
        $response = $this->getJson('/api/flats', [
            'Authorization' => "Bearer $this->token",
            'Accept' => 'application/json',
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            '*' => ['id', 'block_id', 'flat_number', 'owner_name'],
        ]);
    }

    public function testGetBlocks()
    {
        $response = $this->getJson('/api/blocks', [
            'Authorization' => "Bearer $this->token",
            'Accept' => 'application/json',
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            '*' => ['id', 'block_name', 'total_floors'],
        ]);
    }

    // Register API tests
    public function testRegister()
    {
        $response = $this->postJson(
            '/api/register',
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'password' => 'securepassword',
            ],
            [
                'Accept' => 'application/json',
            ],
        );

        $response->assertStatus(200);
        $response->assertJsonFragment(['name' => 'John Doe']);
    }

    // Login API tests
    public function testLogin()
    {
        $response = $this->postJson(
            '/api/login',
            [
                'email' => 'testuser@example.com',
                'password' => 'password',
            ],
            [
                'Accept' => 'application/json',
            ],
        );

        $response->assertStatus(200);
        $response->assertJsonStructure(['token']);
    }

    // Logout API tests
    public function testLogout()
    {
        $response = $this->postJson(
            '/api/logout',
            [],
            [
                'Authorization' => "Bearer $this->token",
                'Accept' => 'application/json',
            ],
        );

        $response->assertStatus(200);
    }

    // Notification markAsRead API tests
    public function testMarkNotificationAsRead()
    {
        $notificationId = 'd260c907-593c-4664-97ff-69ba58f06af0'; // example notification ID

        $response = $this->postJson(
            "/api/notifications/read/{$notificationId}",
            [],
            [
                'Authorization' => "Bearer $this->token",
                'Accept' => 'application/json',
            ],
        );

        $response->assertStatus(200);
    }

    // Edit Profile API tests
    public function testEditProfile()
    {
        $response = $this->putJson(
            '/api/profile',
            [
                'name' => 'Updated User',
                'email' => 'updateduser@example.com',
            ],
            [
                'Authorization' => "Bearer $this->token",
                'Accept' => 'application/json',
            ],
        );

        $response->assertStatus(200);
        $response->assertJsonFragment(['name' => 'Updated User']);
    }

    // Profile API tests
    public function testGetProfile()
    {
        $response = $this->getJson('/api/profile', [
            'Authorization' => "Bearer $this->token",
            'Accept' => 'application/json',
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure(['id', 'name', 'email']);
    }

    // Emergency Details API tests
    public function testGetEmergencyDetails()
    {
        $response = $this->getJson('/api/emergencyDetails', [
            'Authorization' => "Bearer $this->token",
            'Accept' => 'application/json',
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure(['contact_number', 'address', 'additional_info']);
    }

    // Notifications API tests
    public function testGetNotifications()
    {
        $response = $this->getJson('/api/notifications/list', [
            'Authorization' => "Bearer $this->token",
            'Accept' => 'application/json',
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            '*' => ['id', 'title', 'body', 'read_at'],
        ]);
    }
}
