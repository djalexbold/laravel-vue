<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
class UserController extends Controller
{
    /**
     * Показать список всех пользователей приложения.
     */
    public function index(): View
    {
        $users = DB::select('select * from devices where active = ?', [1]);

        return view('name.index', ['name' => $users]);
    }
}
