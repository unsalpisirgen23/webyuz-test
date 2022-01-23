<?php
/**
 * Created by PhpStorm.
 * User: backend
 * Date: 23.12.2021
 * Time: 16:19
 */

namespace App\Http\Responses\Admin;


use App\Http\Responses\BaseResponse;
use App\Http\Responses\IBaseResponse;

class MultimediaResponse extends BaseResponse implements IBaseResponse
{
    public function __construct()
    {
        $this->pathViews = "multimedia";
    }
}
