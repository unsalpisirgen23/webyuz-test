<?php

namespace App\Http\Requests\Admin;


use App\Helpers\Permalink;
use App\Http\Requests\BaseRequest;

class PageRequest extends BaseRequest
{
    protected $page;

    public function authorize()
    {
        return parent::authorize(); // TODO: Change the autogenerated stub
    }

    public function postPage()
    {
        $this->page = $this->post();
        $this->page["link"] = Permalink::get($this->page["title"]);
        $this->page["created_at"] = date('Y-m-d H:i:s');
        $this->page["updated_at"] = date('Y-m-d H:i:s');
        unset($this->page['_token']);
        return $this->page;
    }

    public function allPage()
    {
        $this->page = $this->all();
        unset($this->page['_token']);
        return $this->page;
    }

    public function rules()
    {
        parent::rules();
        return [
            'title'=>"required"
        ];
    }
}