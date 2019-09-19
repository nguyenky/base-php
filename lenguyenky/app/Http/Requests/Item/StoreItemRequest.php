<?php

namespace App\Http\Requests\Item;

use App\Http\Requests\BaseRequest;
use App\Models\Channel;
use Illuminate\Validation\Rule;

class StoreItemRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => [
                'required',
                'string',
                'min:'. self::TITLE_MIN_LENGTH,
                'max:'. self::TITLE_MAX_LENGTH,
            ],
            'description' => [
                'required',
                'string',
                'min:'. self::DESCRIPTION_MIN_LENGTH,
                'max:'. self::DESCRIPTION_MAX_LENGTH,
            ],
            'link' => [
                'required',
                'string',
                'regex:' . Channel::HTTP_REGEX
            ],
            'category' => [
                'required',
                'string',
                'min:'. self::TITLE_MIN_LENGTH,
                'max:'. self::TITLE_MAX_LENGTH,
            ],
            'comments' => [
                'required',
                'string',
                'min:'. self::TITLE_MIN_LENGTH,
                'max:'. self::TITLE_MAX_LENGTH,
            ],
            'channel_id' => [
                'required',
                'integer',
                Rule::exists('channels', 'id')
            ]
        ];
    }
}
