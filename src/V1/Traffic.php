<?php

namespace ReydenX\V1;

use ReydenX\V1\Exceptions\BaseException;
use ReydenX\V1\Model\Result;

class Traffic
{
    protected IClient $client;

    public function __construct(IClient $client)
    {
        $this->client = $client;
    }

    /**
     * @link https://api.reyden-x.com/docs#/Traffic/Traffic_statistics_by_country_v1_traffic_countries__get
     * @return Result
     * @throws BaseException
     *
     * @example
     * $c = new Client('EMAIL', 'PASSWORD');
     * $c->auth();
     * $o = new Traffic($c);
     * $o->getCountries();
     */
    public function getCountries(): Result
    {
        $res = $this->client->get('/v1/traffic/countries/');
        return new Result($res, Model\Traffic::class);
    }

    /**
     * @link https://api.reyden-x.com/docs#/Traffic/Traffic_statistics_by_language_v1_traffic_languages__get
     * @return Result
     * @throws BaseException
     *
     * @example
     * $c = new Client('EMAIL', 'PASSWORD');
     * $c->auth();
     * $o = new Traffic($c);
     * $o->getLanguages();
     */
    public function getLanguages(): Result
    {
        $res = $this->client->get('/v1/traffic/languages/');
        return new Result($res, Model\Traffic::class);
    }
}
