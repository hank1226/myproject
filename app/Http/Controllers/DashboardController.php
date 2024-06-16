<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Device;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $fk_id = Auth::user()->id;

        // 使用 Eloquent 關聯載入 User 的 devices
        $user = User::with('devices')->find($fk_id);

        // 如果你的 User 模型有定義 devices 關聯，可以直接存取
        $devices = $user->devices;

        return view('dashboard')->with('devices', $devices);
    }
}
