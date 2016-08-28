<?php

namespace NotificationChannels\pivotal-tracker\Test;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Illuminate\Notifications\Notification;
use Mockery;
use NotificationChannels\pivotal-tracker\Exceptions\CouldNotSendNotification;
use NotificationChannels\pivotal-tracker\pivotal-trackerChannel;
use NotificationChannels\pivotal-tracker\pivotal-trackerMessage;
use Orchestra\Testbench\TestCase;

class ChannelTest extends TestCase
{
    /** @test */
    function it_can_send_a_notification()
    {
        $response = new Response(200);

        $client = Mockery::mock(Client::class);
        $client->shouldReceive('request')
            ->once()
            ->with('POST', 'https://www.pivotal-tracker.com/services/v5/projects/ProjectId/stories',
                [
                    'headers' => [
                        'X-TrackerToken' => 'NotifiableToken',
                        'Content-Type' => 'application/json',
                    ],
                    'json' => [
                        'name' => 'Story name',
                        'description' => 'Story description',
                        'story_type' => 'bug',
                        'labels' => ['bug', 'env-production'],
                    ],
                ])
            ->andReturn($response);

        $channel = new pivotal-trackerChannel($client);
        $channel->send(new TestNotifiable(), new TestNotification());
    }

    /** @test */
    function it_throws_an_exception_when_it_could_not_send_the_notification()
    {
        $this->setExpectedException(CouldNotSendNotification::class);

        $response = new Response(500);

        $client = Mockery::mock(Client::class);
        $client->shouldReceive('request')
            ->once()
            ->andReturn($response);

        $channel = new pivotal-trackerChannel($client);
        $channel->send(new TestNotifiable(), new TestNotification());
    }
}

class TestNotifiable
{
    use \Illuminate\Notifications\Notifiable;

    public function routeNotificationForpivotal-tracker()
    {
        return [
            'token' => 'NotifiableToken',
            'projectId' => 'ProjectId',
        ];
    }
}

class TestNotification extends Notification
{
    public function topivotal-tracker($notifiable)
    {
        return
            (new pivotal-trackerMessage('Story name'))
                ->description('Story description')
                ->type('bug')
                ->labels(['bug', 'env-production']);
    }
}
