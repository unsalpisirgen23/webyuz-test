<?php

namespace Modules\Contact;

use App\BaseModule;
use App\IModule;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class Installation extends BaseModule implements IModule
{

    public $mergeConfigFrom = "configs/config";

    public $loadMigrationsFrom = "database/migrations/";

    public $loadRoutesFrom = "routes/web";

    public $loadViewsFrom = "views";

    public function init()
    {
        return [
            "version"=>1,
            'name'=>"contact",
            'namespace'=>"contact"
        ];
    }

}