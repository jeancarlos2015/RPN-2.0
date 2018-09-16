<?php

namespace App\Http\Controllers;

use App\Http\Fachadas\FachadaAbstrata;
use Illuminate\Http\Request;

class ControllerAbstrata extends Controller
{
    protected $controller;

    function __construct($tipo)
    {
        parent::__construct();
        $this->controller = FachadaAbstrata::make($tipo);
    }

    public function index()
    {
        $numArgs = (int)func_num_args();
        $args = func_get_args();
        if ($numArgs == 0) {
            return $this->controller->index();
        } else if ($numArgs == 1) {
            return $this->controller->index($args[0]);
        }
    }

    public function create()
    {
        $numArgs = (int)func_num_args();
        $args = func_get_args();
        if ($numArgs == 0) {
            return $this->controller->create();
        } else if ($numArgs == 1) {
            return $this->controller->create($args[0]);
        }else if ($numArgs == 2){
            return $this->controller->create($args[0],$args[1]);
        }
    }

    public function destroy($id)
    {
        return $this->controller->destroy($id);
    }

    public function show()
    {
        $numArgs = (int)func_num_args();
        $args = func_get_args();
        if ($numArgs == 0) {
            return $this->controller->show();
        } else if ($numArgs == 1) {
            return $this->controller->show($args[0]);
        }
    }

    public function edit($codigo)
    {
        return $this->controller->edit($codigo);
    }

    public function store(Request $request)
    {
        return $this->controller->store($request);
    }


    public function update(Request $request, $codigo)
    {
        return $this->controller->update($request, $codigo);
    }

    public function all()
    {
        return $this->controller->all();
    }
}
