<?php

namespace App\Services\Item;

trait HelperTrait 
{
    public function setWith(string $with)
    {
        $this->with = $with;

        return $this;
    }

    public function prepareWithData()
    {

        if ($this->data->has('with') && !is_null($this->with)) {
            $this->data->put('with', $this->data->get('with') . ',' . $this->with);
            return ;
        }

        $this->data->put('with', $this->with);
    }
}