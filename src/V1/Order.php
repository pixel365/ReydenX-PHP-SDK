<?php

namespace ReydenX\V1;

use ReydenX\V1;
use ReydenX\V1\Exceptions\BaseException;
use ReydenX\V1\Exceptions\InvalidParamsException;
use ReydenX\V1\Exceptions\NotImplementedException;
use ReydenX\V1\Model\ActionResult;
use ReydenX\V1\Model\IdAndQuantity;
use ReydenX\V1\Model\NewOrderParams;
use ReydenX\V1\Model\Platform;
use ReydenX\V1\Model\Result;

class Order
{
    use OrderTrait;

    protected IClient $client;

    public function __construct(IClient $client)
    {
        $this->client = $client;
    }

    /**
     * @param int $orderId Order ID
     * @return $this
     */
    public function setOrderId(int $orderId): self
    {
        $this->orderId = $orderId;
        return $this;
    }

    /**
     * List of Orders
     *
     * @link https://api.reyden-x.com/docs#/default/orders_v1_orders__get
     * @param string|null $cursor
     * @return Result
     * @throws BaseException
     *
     * @example First 50 Orders
     * $client = new Client("EMAIL", "PASSWORD");
     * $client->auth();
     * $o = new Order($c);
     * $res = $o->getList();
     * foreach ($res->result as $order) {
     *      if ($order instanceof Model\Order) {
     *          //Do something
     *      }
     * }
     *
     * @example All Orders
     * $client = new Client("EMAIL", "PASSWORD");
     * $client->auth();
     * $o = new Order($c);
     * $hasNext = true;
     * $cursor = null;
     * while ($hasNext) {
     *      $res = $o->getList($cursor);
     *      $hasNext = $res->hasNext();
     *      $cursor = $res->cursor;
     *      foreach ($res->result as $order) {
     *          if ($order instanceof Model\Order) {
     *              //Do something
     *          }
     *      }
     * }
     */
    public function getList(?string $cursor = null): Result
    {
        if (!is_null($cursor)) {
            $url = sprintf('/v1/orders/?cursor=%s', $cursor);
        } else {
            $url = '/v1/orders/';
        }

        $res = $this->client->get($url);
        return new Result($res, V1\Model\Order::class);
    }

    /**
     * Order details
     *
     * @link https://api.reyden-x.com/docs#/default/order_details_v1_orders__order_id___get
     * @return Result
     * @throws BaseException
     *
     * @example
     * $c = new Client("EMAIL", "PASSWORD");
     * $c->auth();
     * $o = new Order($c);
     * $o->setOrderId(123456)->details();
     */
    public function details(): Result
    {
        $this->checkOrderId();
        $res = $this->client->get(sprintf('/v1/orders/%s/', $this->orderId));
        return new Result($res, V1\Model\Order::class);
    }

    /**
     * Order payments
     *
     * @link https://api.reyden-x.com/docs#/default/order_payments_v1_orders__order_id__payments__get
     * @param string|null $cursor
     * @return Result
     * @throws BaseException
     *
     * @example First 50 Order Payments
     * $client = new Client("EMAIL", "PASSWORD");
     * $client->auth();
     * $o = new Order($c);
     * $res = $o->setOrderId(123456)->payments();
     * foreach ($res->result as $order) {
     *      if ($order instanceof Model\Payment) {
     *          //Do something
     *      }
     * }
     *
     * @example All Order Payments
     * $client = new Client("EMAIL", "PASSWORD");
     * $client->auth();
     * $o = new Order($c);
     * $o->setOrderId(123456);
     * $hasNext = true;
     * $cursor = null;
     * while ($hasNext) {
     *      $res = $o->payments($cursor);
     *      $hasNext = $res->hasNext();
     *      $cursor = $res->cursor;
     *      foreach ($res->result as $order) {
     *          if ($order instanceof Model\Payment) {
     *              //Do something
     *          }
     *      }
     * }
     */
    public function payments(?string $cursor = null): Result
    {
        $this->checkOrderId();
        if (!is_null($cursor)) {
            $url = sprintf('/v1/orders/%s/payments/?cursor=%s', $this->orderId, $cursor);
        } else {
            $url = sprintf('/v1/orders/%s/payments/', $this->orderId);
        }

        $res = $this->client->get($url);
        return new Result($res, V1\Model\Payment::class);
    }

    /**
     * Detailed information about users online
     *
     * @link https://api.reyden-x.com/docs#/default/order_stats_online_v1_orders__order_id__statistics_online__get
     * @return Result
     * @throws BaseException
     *
     * @example
     * $c = new Client("EMAIL", "PASSWORD");
     * $c->auth();
     * $o = new Order($c);
     * $o->setOrderId(123456)->onlineStats();
     */
    public function onlineStats(): Result
    {
        $this->checkOrderId();
        $res = $this->client->get(sprintf('/v1/orders/%s/statistics/online/', $this->orderId));
        return new Result($res, V1\Model\OnlineStats::class);
    }

    /**
     * Detailed information about clicks
     *
     * @link https://api.reyden-x.com/docs#/default/order_stats_clicks_v1_orders__order_id__statistics_clicks__get
     * @return Result
     * @throws BaseException
     *
     * @example
     * $c = new Client("EMAIL", "PASSWORD");
     * $c->auth();
     * $o = new Order($c);
     * $o->setOrderId(123456)->clicksStats();
     */
    public function clicksStats(): Result
    {
        $this->checkOrderId();
        $res = $this->client->get(sprintf('/v1/orders/%s/statistics/clicks/', $this->orderId));
        return new Result($res, V1\Model\DateAndQuantityStats::class);
    }

    /**
     * Detailed information about views
     *
     * @link https://api.reyden-x.com/docs#/default/order_stats_views_v1_orders__order_id__statistics_views__get
     * @return Result
     * @throws BaseException
     *
     * @example
     * $c = new Client("EMAIL", "PASSWORD");
     * $c->auth();
     * $o = new Order($c);
     * $o->setOrderId(123456)->viewsStats();
     */
    public function viewsStats(): Result
    {
        $this->checkOrderId();
        $res = $this->client->get(sprintf('/v1/orders/%s/statistics/views/', $this->orderId));
        return new Result($res, V1\Model\DateAndQuantityStats::class);
    }

    /**
     * Detailed information about sites
     *
     * @link https://api.reyden-x.com/docs#/default/order_stats_sites_v1_orders__order_id__statistics_sites__get
     * @return Result
     * @throws BaseException
     *
     * @example
     * $c = new Client("EMAIL", "PASSWORD");
     * $c->auth();
     * $o = new Order($c);
     * $o->setOrderId(123456)->sitesStats();
     */
    public function sitesStats(): Result
    {
        $this->checkOrderId();
        $res = $this->client->get(sprintf('/v1/orders/%s/statistics/sites/', $this->orderId));
        return new Result($res, V1\Model\SiteStats::class);
    }

    /**
     * Create new order for Twitch or YouTube stream
     *
     * @param NewOrderParams $params
     * @return ActionResult
     * @throws NotImplementedException|BaseException
     * @link https://api.reyden-x.com/docs#/default/youtube_stream_v1_orders_create_youtube_stream__post
     * @link https://api.reyden-x.com/docs#/default/twitch_stream_v1_orders_create_twitch_stream__post
     *
     * @example for Twitch:
     * $params = new NewOrderParams([
     *      'platform' => Platform::Twitch,
     *      'price_id' => 123,
     *      'number_of_views' => 10000,
     *      'number_of_viewers' => 100,
     *      'launch_mode' => LaunchMode::Auto,
     *      'smooth_gain' => new SmothGain(false, 0),
     *      'delay_time' => 0,
     *      'twitch_id' => 123456,
     * ]);
     *
     * @example for YouTube:
     * $params = new NewOrderParams([
     *      'platform' => Platform::YouTube,
     *      'price_id' => 123,
     *      'number_of_views' => 10000,
     *      'number_of_viewers' => 100,
     *      'launch_mode' => LaunchMode::Auto,
     *      'smooth_gain' => new SmothGain(false, 0),
     *      'delay_time' => 0,
     *      'channel_url' => 'https://www.youtube.com/channel/UCtI0Hodo5o5dUb67FeUjDeA',
     * ]);
     *
     * $client = new Client("EMAIL", "PASSWORD");
     * $client->auth();
     * $o = new Order($client);
     * $o->create($params);
     */
    public function create(NewOrderParams $params): ActionResult
    {
        switch ($params->platform) {
            case Platform::Trovo:
            case Platform::VkPlay:
            case Platform::GoodGame:
                throw new NotImplementedException();
            default:
        }

        $payload = [
            'price_id' => $params->priceId,
            'number_of_views' => $params->numberOfViews,
            'number_of_viewers' => $params->numberOfViewers,
            'launch_mode' => $params->launchMode->getName(),
            'smooth_gain' => [
                'enabled' => $params->smothGain->enabled,
                'minutes' => $params->smothGain->enabled
            ],
            'delay_time' => $params->delayTime,
            $params->contentIdKey() => $params->contentId,
        ];
        $res = $this->client->post(
            sprintf('/v1/orders/create/%s/stream/', $params->platform->getName()),
            $payload
        );
        return new ActionResult($res);
    }

    /**
     * View statistics for multiple orders
     *
     * @link https://api.reyden-x.com/docs#/default/multiple_views_v1_orders_multiple_views__post
     * @param array $ids Array of orders identifiers (max. 100 ids)
     * @return Result
     * @throws BaseException
     *
     * @example
     * $client = new Client("EMAIL", "PASSWORD");
     * $client->auth();
     * $o = new Order($client);
     * $o->multipleViewsStats([123,456,789]);
     */
    public function multipleViewsStats(array $ids): Result
    {
        $res = $this->client->post('/v1/orders/multiple/views/', ['identifiers' => $this->getIdentifiers($ids)]);
        return new Result($res, IdAndQuantity::class);
    }

    /**
     * Click-through statistics for multiple orders
     *
     * @link https://api.reyden-x.com/docs#/default/multiple_clicks_v1_orders_multiple_clicks__post
     * @param array $ids Array of orders identifiers (max. 100 ids)
     * @return Result
     * @throws BaseException
     *
     * @example
     * $client = new Client("EMAIL", "PASSWORD");
     * $client->auth();
     * $o = new Order($client);
     * $o->multipleClicksStats([123,456,789]);
     */
    public function multipleClicksStats(array $ids): Result
    {
        $res = $this->client->post('/v1/orders/multiple/clicks/', ['identifiers' => $this->getIdentifiers($ids)]);
        return new Result($res, IdAndQuantity::class);
    }

    /**
     * @param array $ids
     * @return array
     * @throws InvalidParamsException
     */
    protected function getIdentifiers(array $ids): array
    {
        $i = 0;
        $identifiers = [];
        foreach ($ids as $id) {
            if (intval($id) > 0) {
                $identifiers[] = intval($id);
                $i++;
            }
            if ($i == 100)
                break;
        }
        if (!count($identifiers))
            throw new InvalidParamsException('Identifiers is required');
        return $identifiers;
    }
}
