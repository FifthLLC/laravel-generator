<?php


namespace Fifth\GuiGenerator\Http\Controllers;

use Illuminate\Routing\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('fifth_gui_generator::dashboard.index');
    }
}
