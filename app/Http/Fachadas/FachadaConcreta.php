<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 16/09/2018
 * Time: 17:24
 */

namespace App\Http\Fachadas;


use Illuminate\Http\Request;

class FachadaConcreta extends FachadaAbstrata
{

    public function index($codigo1 = null, $codigo2 = null)
    {
        return null;
    }

    public function store(Request $request)
    {
        return null;
    }

    public function update(Request $request, $codigo = null)
    {
        return null;
    }

    public function destroy($codigo)
    {
        return null;
    }

    public function edit($codigo)
    {
        return null;
    }

    public function create(Request $request = null, $codigo = null)
    {
        return null;
    }

    public function show($codigo = null)
    {
        return null;
    }

    public function all()
    {
        return null;
    }

    public function pull()
    {
        return null;
    }

    public function delete(Request $request)
    {
        return null;
    }

    public function edit_repository(Request $request)
    {
        return null;
    }

    public function delete_repository($repositorio_atual)
    {
        return null;
    }

    public function criar_base(Request $request)
    {
        return null;
    }

    public function selecionar_repositorio($repositorio_atual, $default_branch)
    {
        return null;
    }

    public function index_init()
    {
        return null;
    }

    public function index_pull_push()
    {
        return null;
    }

    public function index_commit_branch()
    {
        return null;
    }

    public function index_create_delete()
    {
        return null;
    }

    public function index_merge_checkout()
    {
        return null;
    }
}