<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Shared/Dashboard');
    }

    public function adminPanel(): Response
    {
        return Inertia::render('Admin/Panel');
    }

    public function financeReports(): Response
    {
        return Inertia::render('Finance/Reports');
    }

    public function supportLogs(): Response
    {
        return Inertia::render('Support/Logs');
    }

    public function salesDashboard(): Response
    {
        return Inertia::render('Commercial/Sales');
    }
}

