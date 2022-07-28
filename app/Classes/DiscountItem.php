<?php

namespace App\Classes;

use Exception;

/**
 * Class DiscountItem
 */
class DiscountItem
{
    /**
     * @var string
     */
    public $title;

    /**
     * @var string|bool
     */
    public $description = false;

    /**
     * @var float
     */
    public $amount;

    /**
     * DiscountItem constructor.
     */
    public function __construct()
    {
        $this->amount = 0.0;
    }

    /**
     * @param  string  $title
     * @return $this
     */
    public function title(string $title): DiscountItem
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @param  string  $description
     * @return $this
     */
    public function description(string $description): DiscountItem
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @param  float  $amount
     * @return $this
     *
     * @throws Exception
     */
    public function amount(float $amount): DiscountItem
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * @throws Exception
     */
    public function validate()
    {
        if (is_null($this->title)) {
            throw new Exception('DiscountItem: title not defined.');
        }
    }
}
