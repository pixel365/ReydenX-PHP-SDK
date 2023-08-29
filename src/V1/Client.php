<?php

namespace ReydenX\V1;

use GuzzleHttp\Exception\GuzzleException;
use ReydenX\V1\Exceptions\BaseException;
use ReydenX\V1\Exceptions\InvalidCredentialsBaseException;
use ReydenX\V1\Exceptions\NotFoundException;
use ReydenX\V1\Exceptions\TooManyRequestsException;
use ReydenX\V1\Exceptions\UnauthorizedException;
use ReydenX\V1\Exceptions\UnknownException;
use ReydenX\V1\Model\Token;

class Client implements IClient
{
    protected ?string $userName = null;
    protected ?string $password = null;
    protected ?Token $token = null;
    protected \GuzzleHttp\Client $client;

    public function __construct(string $userName, string $password)
    {
        $this->userName = $userName;
        $this->password = $password;
        $this->client = new \GuzzleHttp\Client([
            'base_uri' => self::BASE_URL,
            'timeout' => 5.0,
        ]);
    }

    public function getToken(): ?Token
    {
        return $this->token;
    }

    public function getClient(): \GuzzleHttp\Client
    {
        return $this->client;
    }

    public function setToken(Token $token): static
    {
        $this->token = $token;
        return $this;
    }

    /**
     * @link https://api.reyden-x.com/docs#/default/get_token_v1_token__post
     * @return IClient
     * @throws BaseException
     */
    public function auth(): static
    {
        if ($this->isAuthenticated()) return $this;

        try {
            $r = $this->getClient()->post('/v1/token/', [
                'form_params' => [
                    'username' => $this->userName,
                    'password' => $this->password
                ],
                'headers' => [
                    'Accept' => 'application/json',
                ],
            ]);
            if ($r->getStatusCode() != 200)
                throw new InvalidCredentialsBaseException('Incorrect username or password');

            $json = json_decode($r->getBody()->getContents());
            $this->token = new Token($json->access_token, $json->expires_in);
        } catch (GuzzleException $e) {
            throw match ($e->getCode()) {
                400 => new InvalidCredentialsBaseException('Incorrect username or password'),
                429 => new TooManyRequestsException(),
                default => new UnknownException($e->getMessage()),
            };
        }

        return $this;
    }

    public function isAuthenticated(): bool
    {
        if (!is_null($this->token))
            return strtotime($this->token->getExpiresIn()) > time();

        return false;
    }

    /**
     * @param string $method
     * @param string $path
     * @param array|null $payload
     * @return array
     * @throws NotFoundException
     * @throws TooManyRequestsException
     * @throws UnauthorizedException
     * @throws UnknownException
     */
    protected function request(string $method, string $path, ?array $payload = null): array
    {
        if (!$this->isAuthenticated()) throw new UnauthorizedException();

        $opts = [
            'headers' => [
                'Authorization' => sprintf('Bearer %s', $this->getToken()->getAccessToken()),
                'Accept' => 'application/json',
            ]
        ];

        try {
            switch ($method) {
                case 'POST':
                    $opts['json'] = $payload;
                    $r = $this->client->post($path, $opts);
                    break;
                case 'PATCH':
                    $r = $this->client->patch($path, $opts);
                    break;
                default:
                    $r = $this->client->get($path, $opts);
            }
            return json_decode($r->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            throw match ($e->getCode()) {
                401 => new UnauthorizedException(),
                404 => new NotFoundException(),
                429 => new TooManyRequestsException(),
                default => new UnknownException($e->getMessage()),
            };
        }
    }

    /**
     * @param string $path
     * @return array
     * @throws BaseException
     */
    public function get(string $path): array
    {
        return $this->request('GET', $path);
    }

    /**
     * @param string $path
     * @return array
     * @throws BaseException
     */
    public function patch(string $path): array
    {
        return $this->request('PATCH', $path);
    }

    /**
     * @param string $path
     * @param array $payload
     * @return array
     * @throws BaseException
     */
    public function post(string $path, array $payload): array
    {
        return $this->request('POST', $path, $payload);
    }
}
