<?php

namespace ReydenX\V1;

use ReydenX\V1\Exceptions\BaseException;
use ReydenX\V1\Model\Token;

interface IClient
{
    public const BASE_URL = 'https://api.reyden-x.com';

    public function getToken(): ?Token;

    public function setToken(Token $token): IClient;

    /**
     * @throws BaseException
     */
    public function auth(): IClient;

    public function isAuthenticated(): bool;

    /**
     * @throws BaseException
     */
    public function get(string $path): array;

    /**
     * @throws BaseException
     */
    public function patch(string $path, ?array $payload = null): array;

    /**
     * @throws BaseException
     */
    public function post(string $path, array $payload): array;
}
