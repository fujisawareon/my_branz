<?php

declare(strict_types=1);

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Traits\FormTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    use FormTrait;


    public function __construct() {}

    /**
     * ダッシュボード画面を表示する
     *
     * @param Request $request
     * @return RedirectResponse|View
     */
    public function __invoke(Request $request): RedirectResponse|View
    {

        return view('manager.dashboard', []);
    }
}
