<?php

namespace ReydenX\V1;

use ReydenX\V1\Exceptions\BaseException;
use ReydenX\V1\Model\Platform;
use ReydenX\V1\Model\Price;
use ReydenX\V1\Model\PriceCategory;
use ReydenX\V1\Model\Result;

class Prices
{
    protected IClient $client;

    public function __construct(IClient $client)
    {
        $this->client = $client;
    }

    /**
     * @link https://api.reyden-x.com/docs#/Prices/prices_v1_prices__platform_code___get
     * @param Platform $platform
     * @return Result
     * @throws BaseException
     *
     * @example
     * $c = new Client('EMAIL', 'PASSWORD');
     * $c->auth();
     * $o = new Prices($c);
     * $o->getPrices(Platform::Twitch);
     */
    public function getPrices(Platform $platform): Result
    {
        $res = $this->client->get(sprintf('/v1/prices/%s/', $platform->getName()));
        return new Result($res, Price::class);
    }

    /**
     * @link https://api.reyden-x.com/docs#/Price%20Categories/categories_v1_price_categories__get
     * @return Result
     * @throws BaseException
     *
     * @example
     * $c = new Client('EMAIL', 'PASSWORD');
     * $c->auth();
     * $o = new Prices($c);
     * $o->getCategories();
     */
    public function getCategories(): Result
    {
        $res = $this->client->get('/price-categories/');
        return new Result($res, PriceCategory::class);
    }
}
