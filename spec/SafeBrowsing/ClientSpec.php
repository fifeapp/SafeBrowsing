<?php

namespace spec\SafeBrowsing;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ClientSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('MyApp', '1.2.3', '123123');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('SafeBrowsing\Client');
        $this->getClientName()->shouldReturn('MyApp');
        $this->getClientVersion()->shouldReturn('1.2.3');
        $this->getApiKey()->shouldReturn('123123');
    }
}
