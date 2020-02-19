<?php


class Task
{

    const STATUS_NEW = 'new';
    const STATUS_ACTIVE = 'active';
    const STATUS_COMPLETED = 'completed';
    const STATUS_CANCELED = 'canceled';
    const STATUS_INACTIVE = 'inactive';

    const ACTION_ADD = 'add';
    const ACTION_RESPOND = 'respond';
    const ACTION_CANCEL = 'cancel';
    const ACTION_COMPLETE = 'complete';
    const ACTION_MESSAGE = 'message';

    private $implementer_id;
    private $customer_id;
    private $statuses_map = [];
    private $actions_map = [];
    private $current_status;
    private $current_action;
    private $possible_current_actions = [];

    /**
     * Класс получает id исполнителя
     * @param $implementer_id
     * и id заказчика
     * @param $customer_id
     * черз конструктор
     */

    public function __construct($implementer_id, $customer_id)
    {
        $this->implementer_id = $implementer_id;
        $this->customer_id = $customer_id;
    }

    /**
     * Возвращает id исполнителя
     */

    public function getImplementerId()
    {
        return $this->implementer_id;
    }

    /**
     * Устанавливает id исполнителя
     */

    public function setImplementerId($implementer_id)
    {
        $this->implementer_id = $implementer_id;
    }

    /**
     * Возвращает id заказчика
     */

    public function getCustomerId()
    {
        return $this->customer_id;
    }

    /**
     * Устанавливает id заказчика
     */

    public function setCustomerId($customer_id)
    {
        $this->customer_id = $customer_id;
    }

    /**
     * Возвращает карту статусов в виде массива
     */

    public function statusMap()
    {
        return $this->statuses_map = [
            self::STATUS_NEW => 'Новое',
            self::STATUS_ACTIVE => 'Выполняется',
            self::STATUS_COMPLETED => 'Завершено',
            self::STATUS_CANCELED => 'Отменено',
            self::STATUS_INACTIVE => 'Ожидание'
        ];
    }

    /**
     * Возвращает карту действий в виде массива
     */

    public function actionMap()
    {
        return $this->actions_map = [
            self::ACTION_ADD => 'Добавить',
            self::ACTION_RESPOND => 'Откликнуться',
            self::ACTION_CANCEL => 'Отказаться',
            self::ACTION_COMPLETE => 'Завершить',
            self::ACTION_MESSAGE => 'Написать сообщение'
        ];
    }

    /**
     * Возвращает текущий статус
     */

    public function getCurrentStatus()
    {
        switch ($this->current_action) {
            case self::ACTION_ADD:
                $this->current_status = self::STATUS_NEW;
                break;
            case self::ACTION_RESPOND:
                $this->current_status = self::STATUS_ACTIVE;
                break;
            case self::ACTION_COMPLETE:
                $this->current_status = self::STATUS_COMPLETED;
                break;
            case self::ACTION_CANCEL:
                $this->current_status = self::STATUS_CANCELED;
                break;
            default:
                $this->current_status = self::STATUS_INACTIVE;
        }

        return $this->current_status;
    }

    /**
     * Возвращает все возможные действия в виде массива
     */

    public function getPossibleCurrentActions()
    {
        if ($this->current_status == self::STATUS_NEW)
        {
            $this->possible_current_actions = [
                self::ACTION_RESPOND,
                self::ACTION_CANCEL,
                self::ACTION_MESSAGE
            ];
        } elseif ($this->current_status == self::STATUS_ACTIVE)
        {
            $this->possible_current_actions = [
                self::ACTION_CANCEL,
                self::ACTION_COMPLETE,
                self::ACTION_MESSAGE
            ];
        } elseif ($this->current_status == self::STATUS_COMPLETED)
        {
            $this->possible_current_actions = [
                self::ACTION_MESSAGE,
                self::ACTION_ADD
            ];
        } elseif ($this->current_status == self::STATUS_CANCELED || $this->current_status == self::STATUS_INACTIVE)
        {
            $this->possible_current_actions = [
                self::ACTION_MESSAGE,
                self::ACTION_ADD
            ];
        }

        return $this->possible_current_actions;
    }

}