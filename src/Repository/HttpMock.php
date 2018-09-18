<?php
/**
 * Created by PhpStorm.
 * User: nassim.kirouane
 * Date: 9/13/18
 * Time: 1:47 PM
 */

namespace Imposter\Repository;

use GuzzleHttp\Client;
use Imposter\Model\Mock;
use Imposter\Server;

/**
 * Class HttpMock
 * @package Imposter\Repository
 */
class HttpMock
{
    /**
     * @var \\GuzzleHttp\ClientInterface
     */
    private $client;

    /**
     * HttpMock constructor.
     * @param \GuzzleHttp\ClientInterface|null $client
     */
    public function __construct(\GuzzleHttp\ClientInterface $client = null)
    {
        $this->client = $client ?: new \GuzzleHttp\Client();
    }

    /**
     * @param Mock $mock
     * @return Mock
     * @throws \Exception
     */
    public function insert(Mock $mock): Mock
    {
        $request = $this->client->post(Server::URL . '/mock', null, serialize($mock));
        $body    = $this->client->send($request);

        if (!$body) {
            throw new \UnexpectedValueException('Response body not found');
        }

        return unserialize($body->getBody(true), [Mock::class]);
    }

    /**
     * @param Mock $mock
     * @return Mock
     * @throws \Exception
     */
    public function find(Mock $mock): Mock
    {
        $request = $this->client->get(Server::URL . '/mock', null);
        $request->getQuery()->set('id', $mock->getId());
        $body = $this->client->send($request);

        if (!$body) {
            throw new \UnexpectedValueException('Response body not found');
        }

        return unserialize($body->getBody(true), [Mock::class]);
    }

    /**
     * @throws \Exception
     */
    public function drop()
    {
        $request = $this->client->delete(Server::URL . '/mock', null);
        $this->client->send($request);
    }
}
