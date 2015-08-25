<?php

namespace spec\SafeBrowsing;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use SafeBrowsing\MalwareDetected;

class ClientSpec extends ObjectBehavior
{
    function let(Client $guzzle)
    {
        $this->beConstructedWith($guzzle);
        $this->setClientName('MyApp');
        $this->setClientVersion('1.2.3');
        $this->setApiKey('123123');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('SafeBrowsing\Client');
        $this->getClientName()->shouldReturn('MyApp');
        $this->getClientVersion()->shouldReturn('1.2.3');
        $this->getApiKey()->shouldReturn('123123');
    }

    function it_returns_true_for_a_legitimate_site(Client $guzzle, Response $response)
    {
        // Mock Guzzle response to return 204 (legit)
        $response->getStatusCode()->willReturn(204);

        // How the query string should look
        $query = [
            'client' => 'MyApp',
            'appver' => '1.2.3',
            'key' => '123123',
            'pver' => '3.1',
            'url' => urlencode(utf8_encode('http://example.com')),
        ];

        // Mock Guzzle client
        $guzzle
            ->get('https://sb-ssl.google.com/safebrowsing/api/lookup', ['query' => $query])
            ->willReturn($response);

        // Do the lookup
        $this->lookup('http://example.com')->shouldReturn(true);
    }

    function it_reports_malware(Client $guzzle, Response $response)
    {
        // Mock Guzzle response to return 200 (malware)
        $response->getStatusCode()->willReturn(200);

        // How the query string should look
        $query = [
            'client' => 'MyApp',
            'appver' => '1.2.3',
            'key' => '123123',
            'pver' => '3.1',
            'url' => urlencode(utf8_encode('http://example.com')),
        ];

        // Mock Guzzle client
        $guzzle
            ->get('https://sb-ssl.google.com/safebrowsing/api/lookup', ['query' => $query])
            ->willReturn($response);

        // Do the lookup
        $this->shouldThrow(MalwareDetected::class)->during('lookup', ['http://example.com']);
    }
}
