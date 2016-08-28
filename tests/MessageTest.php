<?php

namespace NotificationChannels\pivotal-tracker\Test;

use Illuminate\Support\Arr;
use NotificationChannels\pivotal-tracker\Exceptions\CouldNotCreateMessage;
use NotificationChannels\pivotal-tracker\pivotal-trackerMessage;

class MessageTest extends \PHPUnit_Framework_TestCase
{
    /** @var \NotificationChannels\pivotal-tracker\pivotal-trackerMessage */
    protected $message;

    function setUp()
    {
        parent::setUp();

        $this->message = new pivotal-trackerMessage();
    }

    /** @test */
    function it_accepts_a_name_when_constructing_a_message()
    {
        $message = new pivotal-trackerMessage('Name');

        $this->assertEquals('Name', Arr::get($message->toArray(), 'name'));
    }

    /** @test */
    function it_provides_a_create_method()
    {
        $message = pivotal-trackerMessage::create('Name');

        $this->assertEquals('Name', Arr::get($message->toArray(), 'name'));
    }

    /** @test */
    function it_can_set_the_name()
    {
        $this->message->name('Story name');

        $this->assertEquals('Story name', Arr::get($this->message->toArray(), 'name'));
    }

    /** @test */
    function it_can_set_the_description()
    {
        $this->message->description('Story description');

        $this->assertEquals('Story description', Arr::get($this->message->toArray(), 'description'));
    }

    /** @test */
    function it_can_set_the_story_type()
    {
        $this->message->type('feature');

        $this->assertEquals('feature', Arr::get($this->message->toArray(), 'story_type'));
    }

    /** @test */
    function it_throws_an_exception_when_story_type_is_invalid()
    {
        $this->setExpectedException(CouldNotCreateMessage::class);

        $this->message->type('foo');
    }

    /** @test */
    function it_can_set_story_labels_from_array()
    {
        $this->message->labels(['foo', 'bar']);

        $this->assertEquals(['foo', 'bar'], Arr::get($this->message->toArray(), 'labels'));
    }

    /** @test */
    function it_can_set_story_labels_from_arguments()
    {
        $this->message->labels('foo', 'bar');

        $this->assertEquals(['foo', 'bar'], Arr::get($this->message->toArray(), 'labels'));
    }

}
