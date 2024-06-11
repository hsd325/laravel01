<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Manager
{
    public function handle(Request $request, Closure $next)
   {
    // 如果暫存在session(記憶體)中沒有managerId
    // 表示未登入後台，或登入後台不成功
    if(empty(session()->get("managerId")))
    {
        // 跳轉回登入頁面
        return redirect("/admin");
        // 結束往下執行
        exit;
    }
    // 進入路由下一個路徑
    return $next($request);
   }   
}
