<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Channel;
use App\Timetable;

class TimetableTest extends TestCase
{
    protected $url;
    protected $response;
    protected $data;
    protected $properties;

    public function setUp():void
    {
		parent::setUp();

        // dynamically seeded, so looking up
        $tmp = Channel::first()->toArray();
        $channel_id = $tmp['id'];

        $tmp = Timetable::channel($channel_id)->first()->toArray();
        $programme_id = $tmp['programme_id'];

		$this->url = '/api/v1/channels/' . $channel_id . '/programmes/' . $programme_id;

        $this->response = $this->get($this->url);
        $this->data = $this->response->getData();
        $this->properties = ['uuid', 'name', 'description', 'thumbnail', 'start_time', 'end_time', 'duration', 'channel'];
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
     * Response with returning correctly structured data. Iterates through every property.
     *
     * @return void
     */
    public function testCorrectStructure()
    {
        $state = true;

        foreach ($this->properties as $property) {

			$state = property_exists($this->data[0], $property);
            if ($state === false) break;
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
            if ($state === false) break;
        }

        $this->assertTrue($state);
    }

}
