<?php

namespace ReydenX\V1;

use ReydenX\V1;
use ReydenX\V1\Exceptions\BaseException;
use ReydenX\V1\Model\Balance;

class User
{
    protected IClient $client;

    public function __construct(IClient $client)
    {
        $this->client = $client;
    }

    /**
     * @link https://api.reyden-x.com/docs#/default/get_balance_v1_user_balance__get
     * @return Balance
     * @throws BaseException
     *
     * @example
     * $c = new Client('EMAIL', 'PASSWORD');
     * $c->auth();
     * $o = new User($c);
     * $o->getBalance();
     */
    public function getBalance(): V1\Model\Balance
    {
        $res = $this->client->get('/v1/user/balance/');
        return new V1\Model\Balance($res);
    }

    /**
     * @link https://api.reyden-x.com/docs#/default/get_user_v1_user__get
     * @return Model\User
     * @throws BaseException
     *
     * @example
     * $c = new Client('EMAIL', 'PASSWORD');
     * $c->auth();
     * $o = new User($c);
     * $o->getAccount();
     */
    public function getAccount(): Model\User
    {
        $res = $this->client->get('/v1/user/');
        return new Model\User($res);
    }
}
