<?php

namespace ReydenX\V1\Model;

class Token
{
    protected string $accessToken;
    protected string $expiresIn;

    /**
     * @param string $accessToken
     * @param string $expiresIn
     */
    public function __construct(string $accessToken, string $expiresIn)
    {
        $this->accessToken = $accessToken;
        $this->expiresIn = $expiresIn;
    }

    public function getAccessToken(): string
    {
        return $this->accessToken;
    }

    public function getExpiresIn(): string
    {
        return $this->expiresIn;
    }
}
