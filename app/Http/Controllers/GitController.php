<?php

namespace App\Http\Controllers;

use App\Http\Models\Regra;
use App\Http\Repositories\GitWrapperRepository;
use App\Http\Repositories\VersionamentoRepository;
use Illuminate\Http\Request;

class GitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $git = $this->get_repository();
        $branchs = $git->get_branchs();
        return view('controle_versao.index',compact('branchs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function get_repository(){
        return new VersionamentoRepository();
    }
    private function get_repository_wrapper(){
        return new GitWrapperRepository();
    }
    public function init(){
        $git = self::get_repository_wrapper();
        $git->git_init();
        return redirect()->route('controle_versao.index');
    }
//    public function init(){
//        $git = $this->get_repository();
//        $git->git_init();
//        $git->git_commit('layout_admin');
//        return redirect()->route('controle_versao.index');
//    }

    public function create_branch(Request $request){
        $git = $this->get_repository();
        $git->git_create_branch($request->nome_branch);
        $branchs = $git->get_branchs();
        return view('controle_versao.index',compact('branchs'));
    }

    public function commit(Request $request){
        $git = $this->get_repository();
        $git->git_commit($request->mensagem);
        $branch_atual = $git->get_branch_current();
        $branchs = $git->get_branchs();
        return view('controle_versao.index',compact('branch_atual','branchs'));
    }

    public function pagina_inicializacao_repositorio(){
        return view('controle_versao.init_repository');
    }

    public function checkout(Request $request){
        $git = $this->get_repository();
        $git->git_checkout_branch($request->branch);
        $branch_atual = $git->get_branch_current();
        $branchs = $git->get_branchs();
        return view('controle_versao.index',compact('branch_atual','branchs'));
    }

    public function merge(Request $request){
        $git = $this->get_repository();
        $git->git_merge_branch($request->branch);
        return redirect()->route('controle_versao.index');
    }

    public function delete(Request $request){
        $git = $this->get_repository();
        $git->git_remove_branch($request->branch);
        return redirect()->route('controle_versao.index');
    }

}
