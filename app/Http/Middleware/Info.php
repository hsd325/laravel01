<?php

namespace App\Http\Middleware;

use App\Models\Admin\Counter;
use App\Models\Admin\Info as AdminInfo;
use App\Models\Admin\Menu;
use App\Models\Admin\Product\Layer1;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class Info
{
    public function handle(Request $request, Closure $next)
    {
        $id = $request->lan;
        if (!empty($id)) {
            // 如果有要求換語系
            $lan = (new AdminInfo())->getLan($id);
            session()->put("lan", $lan->id);
            session()->put("language", $lan->title);

            // 需重新取得選單
            Session::forget("menu");
            Session::forget("layer1");
            Session::forget("counter");
        } else {
            if (empty(session()->get("lan"))) {
                // 需取得預設的語系
                $lan = (new AdminInfo())->getDefaultLan();
                session()->put("lan", $lan->id);
                session()->put("language", $lan->title);
            }
        }

        if (empty(session()->get("info"))) {
            // 取得全部的語系
            $lanList = AdminInfo::get();
            session()->put("lanList", $lanList);
            session()->put("info", "Y");
        }

        if (empty(session()->get("menu"))) {
            // 依語系取得選單
            $menu = (new Menu())->getList();
            session()->put("menu", $menu);
        }

        if (empty(session()->get("layer1"))) {
            $layer1 = (new Layer1())->getLayer1();
            session()->put("layer1", $layer1);
        }

        if (empty(session()->get("counter"))) {
            $counter = (new Counter())->getDayCounter();
            if (empty($counter)) {
                $cnt = new Counter();
                $cnt->lan = session()->get("lan");
                $cnt->dates = date("Y/n/j");
                $cnt->cnt = 1;
                $cnt->save();
            }else{
                $cnt=Counter::find($counter->id);
                $cnt->cnt=$counter->cnt+1;
                $cnt->update();
            }
            session()->put("counter", "Y");
        }

        return $next($request);
    }
}
