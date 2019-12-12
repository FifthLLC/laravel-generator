<?php


namespace Fifth\GuiGenerator\Http\Controllers;

use Illuminate\Routing\Controller;

class GuiGeneratorController extends Controller
{
    public function index()
    {
        return view('fifth_gui_generator::generator.index');
    }
}
