<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;

class SidebarMenuRequest extends BaseRequest
{
    protected $sidebarMenu;

    public function authorize()
    {
        return parent::authorize(); // TODO: Change the autogenerated stub
    }
    public function postSidebarMenu()
    {
        $this->sidebarMenu = $this->post();
        unset($this->sidebarMenu['_token']);
        return $this->sidebarMenu;
    }

    public function allSidebarMenu()
    {
        $this->sidebarMenu = $this->all();
        unset($this->sidebarMenu['_token']);
        return $this->sidebarMenu;
    }

    public function rules()
    {
        parent::rules();
        return [
            'title'=>"required|max:200|min:2"
        ];
    }
}
