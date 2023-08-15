<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\User; // Pastikan Anda menggunakan namespace yang sesuai

class AdminLayoutComposer
{
    public function compose(View $view)
    {
        $inactiveUserCount = User::where('is_active', 0)->count();
        $view->with('inactiveUserCount', $inactiveUserCount);
    }
}
