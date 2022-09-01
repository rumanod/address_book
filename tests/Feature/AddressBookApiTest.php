<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AddressBookApiTest extends TestCase
{
    /**
     * Test create person.
     *
     * @return void
     */
    public function test_create_person()
    {
        $requestData = [
            'firstname' => 'Rumano',
            'lastname' => 'Balie',
            'emails' => [
                'rumanod@gmail.com'
            ]
        ];

        $response = $this->post('/api/person', $requestData);

        $response->assertStatus(201)->assertJson(["message" => "person record created"]);
    }

    /**
     * Test create group.
     *
     * @return void
     */
    public function test_create_group()
    {
        $requestData = [
            'name' => 'TestGroup'
        ];

        $response = $this->post('/api/group', $requestData);

        $response->assertStatus(201)->assertJson(["message" => "group record created"]);
    }

    /**
     * Test create group.
     *
     * @return void
     */
    public function test_create_group_emptyname()
    {
        $requestData = [
            'name' => ''
        ];

        $response = $this->post('/api/group', $requestData);

        $response->assertStatus(202)->assertJson(["message" => "group name cannot be empty"]);
    }

    /**
     * Get all people in a group
     *
     * @return void
     */
    public function test_get_people_group()
    {

        $requestData = [
            'firstname' => 'Rumano',
            'lastname' => 'Balie',
            'emails' => [
                'rumanod@gmail.com'
            ],
            'groupname' => 'testgroup'
        ];

        $response = $this->post('/api/person', $requestData);

        $response->assertStatus(201)->assertJson(["message" => "person record created"]);
    }  
}
