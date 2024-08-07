<?php

namespace ReydenX\V1;

use ReydenX\V1\Exceptions\BaseException;
use ReydenX\V1\Exceptions\InvalidParamsException;
use ReydenX\V1\Model\ActionResult;
use ReydenX\V1\Model\LaunchMode;
use ReydenX\V1\Model\TaskStatus;

class Action
{
    use OrderTrait;

    protected IClient $client;

    public function __construct(IClient $client)
    {
        $this->client = $client;
    }

    /**
     * Run the Order
     *
     * @link https://api.reyden-x.com/docs#/Orders/order_run_v1_orders__order_id__action_run__patch
     * @return ActionResult
     * @throws BaseException
     *
     * @example
     * $c = new Client("EMAIL", "PASSWORD");
     * $c->auth();
     * $o = new Action($c);
     * $o->setOrderId(123456)->run();
     */
    public function run(): ActionResult
    {
        $this->checkOrderId();
        $res = $this->client->patch(sprintf('/v1/orders/%s/action/run/', $this->orderId));
        return new ActionResult($res);
    }

    /**
     * Stop the Order
     *
     * @link https://api.reyden-x.com/docs#/Orders/order_stop_v1_orders__order_id__action_stop__patch
     * @return ActionResult
     * @throws InvalidParamsException
     *
     * @example
     * $c = new Client("EMAIL", "PASSWORD");
     * $c->auth();
     * $o = new Action($c);
     * $o->setOrderId(123456)->stop();
     */
    public function stop(): ActionResult
    {
        $this->checkOrderId();
        $res = $this->client->patch(sprintf('/v1/orders/%s/action/stop/', $this->orderId));
        return new ActionResult($res);
    }

    /**
     * Cancel the Order
     *
     * @link https://api.reyden-x.com/docs#/Orders/order_cancel_v1_orders__order_id__action_cancel__patch
     * @return ActionResult
     * @throws BaseException
     *
     * @example
     * $c = new Client("EMAIL", "PASSWORD");
     * $c->auth();
     * $o = new Action($c);
     * $o->setOrderId(123456)->cancel();
     */
    public function cancel(): ActionResult
    {
        $this->checkOrderId();
        $res = $this->client->patch(sprintf('/v1/orders/%s/action/cancel/', $this->orderId));
        return new ActionResult($res);
    }

    /**
     * Change the number of viewers
     *
     * @link https://api.reyden-x.com/docs#/Orders/order_change_online_v1_orders__order_id__action_change_online__value___patch
     * @param int $value
     * @return ActionResult
     * @throws BaseException
     *
     * @example
     * $c = new Client("EMAIL", "PASSWORD");
     * $c->auth();
     * $o = new Action($c);
     * $o->setOrderId(123456)->changeOnlineValue(50);
     */
    public function changeOnlineValue(int $value): ActionResult
    {
        $this->checkOrderId();
        $res = $this->client->patch(sprintf('/v1/orders/%s/action/change/online/%s/', $this->orderId, $value));
        return new ActionResult($res);
    }

    /**
     * Change the time of the smooth set of viewers
     *
     * @link https://api.reyden-x.com/docs#/Orders/change_increase_value_v1_orders__order_id__action_increase_change__value___patch
     * @param int $value
     * @return ActionResult
     * @throws BaseException
     *
     * @example
     * $c = new Client("EMAIL", "PASSWORD");
     * $c->auth();
     * $o = new Action($c);
     * $o->setOrderId(123456)->changeIncreaseValue(50);
     */
    public function changeIncreaseValue(int $value): ActionResult
    {
        $this->checkOrderId();
        $res = $this->client->patch(sprintf('/v1/orders/%s/action/increase/change/%s/', $this->orderId, $value));
        return new ActionResult($res);
    }

    /**
     * Enable smooth increase of viewers
     *
     * @link https://api.reyden-x.com/docs#/Orders/increase_on_v1_orders__order_id__action_increase_on__value___patch
     * @param int $value
     * @return ActionResult
     * @throws BaseException
     *
     * @example
     * $c = new Client("EMAIL", "PASSWORD");
     * $c->auth();
     * $o = new Action($c);
     * $o->setOrderId(123456)->increaseOn(50);
     */
    public function increaseOn(int $value): ActionResult
    {
        $this->checkOrderId();
        $res = $this->client->patch(sprintf('/v1/orders/%s/action/increase/on/%s/', $this->orderId, $value));
        return new ActionResult($res);
    }

    /**
     * Disable smooth increase of viewers
     *
     * @link https://api.reyden-x.com/docs#/Orders/increase_off_v1_orders__order_id__action_increase_off__patch
     * @return ActionResult
     * @throws BaseException
     *
     * @example
     * $c = new Client("EMAIL", "PASSWORD");
     * $c->auth();
     * $o = new Action($c);
     * $o->setOrderId(123456)->increaseOff();
     */
    public function increaseOff(): ActionResult
    {
        $this->checkOrderId();
        $res = $this->client->patch(sprintf('/v1/orders/%s/action/increase/off/', $this->orderId));
        return new ActionResult($res);
    }

    /**
     * Add views to Order
     *
     * @link https://api.reyden-x.com/docs#/Orders/add_views_v1_orders__order_id__action_add_views__value___patch
     * @param int $value
     * @return ActionResult
     * @throws BaseException
     *
     * @example
     * $c = new Client("EMAIL", "PASSWORD");
     * $c->auth();
     * $o = new Action($c);
     * $o->setOrderId(123456)->addViews(1000);
     */
    public function addViews(int $value): ActionResult
    {
        $this->checkOrderId();
        $res = $this->client->patch(sprintf('/v1/orders/%s/action/add/views/%s/', $this->orderId, $value));
        return new ActionResult($res);
    }

    /**
     * Check the task status
     *
     * @link https://api.reyden-x.com/docs#/Orders/order_get_task_status_v1_orders__order_id__task__task_id__status__get
     * @param string $taskId
     * @return TaskStatus
     * @throws BaseException
     *
     * @example
     * $c = new Client("EMAIL", "PASSWORD");
     * $c->auth();
     * $o = new Action($c);
     * $o->setOrderId(123456)->taskStatus(123456);
     */
    public function taskStatus(string $taskId): TaskStatus
    {
        $this->checkOrderId();
        $res = $this->client->get(sprintf('/v1/orders/%s/task/%s/status/', $this->orderId, $taskId));
        if (isset($res['status'])) {
            switch ($res['status']) {
                case 'pending':
                    return TaskStatus::Pending;
                case 'error':
                    return TaskStatus::Error;
                case 'completed':
                    return TaskStatus::Completed;
                case 'in_progress':
                    return TaskStatus::InProgress;
                case 'action_required':
                    return TaskStatus::ActionRequired;
            }
        }
        return TaskStatus::Unknown;
    }

    /**
     * Change Launch Mode
     * 
     * @link https://api.reyden-x.com/docs#/Orders/change_launch_params_v1_orders__order_id__action_change_launch__patch
     * @param LaunchMode $mode
     * @param int $delayTime
     * @return ActionResult
     * @throws BaseException
     *
     * @example
     * $c = new Client("EMAIL", "PASSWORD");
     * $c->auth();
     * $o = new Action($c);
     * $o->setOrderId(123456)->changeLaunchMode(LaunchMode::Delay, 15);
     */
    public function changeLaunchMode(LaunchMode $mode, int $delayTime = 0): ActionResult
    {
        $this->checkOrderId();
        switch ($mode) {
            case LaunchMode::Auto:
            case LaunchMode::Manual:
                $delayTime = 0;
                break;
            default:
                if ($delayTime < 5 || $delayTime > 240) {
                    throw new InvalidParamsException('The number of minutes for delayed start should be from 5 to 240');
                }
                break;
        }

        $res = $this->client->patch(
            sprintf('/v1/orders/%s/action/change/launch/', $this->orderId),
            [
                'mode' => $mode,
                'delay_time' => $delayTime,
            ]
        );
        
        return new ActionResult($res);
    }
}
