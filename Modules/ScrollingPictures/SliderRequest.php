<?php

namespace Modules\ScrollingPictures;


use App\Http\Requests\BaseRequest;

class SliderRequest extends BaseRequest
{
    protected $slider;

    public function authorize()
    {
        return parent::authorize(); // TODO: Change the autogenerated stub
    }
    public function postSlider()
    {
        $this->slider = $this->post();
        unset($this->slider['_token']);
        return $this->slider;
    }

    public function allSlider()
    {
        $this->slider = $this->all();
        unset($this->slider['_token']);
        return $this->slider;
    }

    public function rules()
    {
        parent::rules();
        return [
             
        ];
    }
}
