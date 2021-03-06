<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class BaseRequest extends FormRequest
{
    const INT_32_MIN = 1;
    const INT_32_MAX = 2147483648;

    const ORDER_DEFAULT_LENGTH = 100;

    const WITH_DEFAULT_LENGTH = 100;

    const LIMIT_DEFAULT_MAX = 100;

    const TITLE_MIN_LENGTH = 1;
    const TITLE_MAX_LENGTH = 200;

    const DESCRIPTION_MIN_LENGTH = 1;
    const DESCRIPTION_MAX_LENGTH = 1000;

    public function rules()
    {
        return [];
    }

    /**
     * Get extra data for validation
     *
     * @return void
     */
    protected function getExtraDataForValidation()
    {
        // no default action
    }

    /**
     * Common list rules
     *
     * @return array
     */
    public function commonListRules()
    {
        return [
            'page' => [
                'bail',
                'sometimes',
                'min:' . self::INT_32_MIN,
                'max:' . self::INT_32_MAX,
            ],
            'per_page' => [
                'bail',
                'sometimes',
                'integer',
                'min:' . self::INT_32_MIN,
                'max:' . static::LIMIT_DEFAULT_MAX
            ],
            'order' => [
                'bail',
                'sometimes',
                'string',
                'max:' . self::ORDER_DEFAULT_LENGTH
            ],
            'with' => [
                'bail',
                'sometimes',
                'string',
                'max:' . self::WITH_DEFAULT_LENGTH
            ],
            'next_cursor' => [
                'bail',
                'sometimes',
                'string'
            ]
        ];
    }
}
