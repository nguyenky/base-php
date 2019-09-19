<?php

namespace App\Services;

trait HelperServiceTrait 
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

    public function perepareData()
    {
        $this->preparePubDate();
    }

    public function preparePubDate()
    {
        if (!$this->data->has('pub_date')) {
            $this->data->put('pub_date', now());
        }
    }
}