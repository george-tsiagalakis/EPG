<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ChannelTest extends TestCase
{
    protected $url;
    protected $response;
    protected $data;
    protected $properties;

    public function setUp(): void
    {
        parent::setUp();
        $this->url = '/api/v1/channels';
        $this->response = $this->get($this->url);
        $this->data = $this->response->getData();
        $this->properties = ['id', 'name', 'icon'];
    }

    /**
     * Basic status response
     *
     * @return void
     */
    public function testResponseStatus()
    {
        $this->response->assertStatus(200);
    }

    /**
     * Response with expected amount of data
     *
     * @return void
     */
    public function testRoughCount()
    {
        $this->assertTrue(count($this->data) > 10);
    }

    /**
     * Response with returning correctly structured data. Iterates through every property.
     *
     * @return void
     */
    public function testCorrectStructure()
    {
        $state = true;

        foreach ($this->properties as $property) {
            $state = property_exists($this->data[0], $property);
            if ($state === false) {
                break;
            }
        }

        $this->assertTrue($state);
    }

    /**
     * Response with returning non-empty data. Iterates through every property value.
     *
     * @return void
     */
    public function testNonEmptyValues()
    {
        $state = true;

        foreach ($this->properties as $property) {
            $state = !empty($this->data[0]->$property);
            if ($state === false) {
                break;
            }
        }

        $this->assertTrue($state);
    }
}
