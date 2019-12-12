<?php


namespace Fifth\GuiGenerator\Http\Controllers;

use Fifth\GuiGenerator\Http\Requests\Model\StoreRequest;
use Fifth\GuiGenerator\Jobs\RunGenerateCommand;
use Illuminate\Routing\Controller;

class ModelController extends Controller
{
    public function index()
    {
        dd(11);
    }
    public function store(StoreRequest $request)
    {
        RunGenerateCommand::dispatch($request->all());

        dd(111);
    }
}
