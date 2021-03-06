<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{


    public function appearance_edit()
    {
            return view("admin.settings.appearance_edit");
    }


    public function appearance_update(Request $request)
    {
             $data = $request->post("");
            DB::connection("user_database")->table("settings")->update($data);
        return redirect()->back()->with("success","Görünüm ayarları başarıyla kaydedildi.");
    }


    public function site_setting_edit()
    {
       $site_settings = DB::connection("user_database")->table("settings")->first();
        return view("admin.settings.site_setting",['settings' => $site_settings]);
    }

    public function site_setting_update(Request $request)
    {
         $data = $request->post("setting");
        unset($data["_token"]);
        if (DB::connection("user_database")->table("settings")->get()->count() < 1)
        {
           DB::connection("user_database")->table("settings")->insert($data);
        }else{
            $update =   DB::connection("user_database")->table("settings")->update($data);
        }
      return redirect()->back()->with("success","Site ayarları başarıyla kaydedildi.");
    }


}
