<?php

namespace App\Http\Controllers;

use App\Http\Repositorys\GitSistemaRepository;
use App\Http\Util\Dado;
use Github\Api\Repository\Contents;
use Github\Client;
use Illuminate\Http\Request;

class GitController extends Controller
{
    private function funcionalidades()
    {
        return [
            'Merge & checkout',
            'Create & Delete',
            'Commit Branch',
            'Pull & Push Repository',
            'Initialization Repository'
        ];
    }

    private function rotas()
    {
        return [
            'index_merge_checkout',
            'index_create_delete',
            'index_commit_branch',
            'index_pull_push',
            'index_init'
        ];
    }

    public function index_merge_checkout()
    {
        $git = new GitSistemaRepository();
        $branch_atual = $git->get_branch_current();
        $branchs = $git->get_branchs();
        return view('controle_versao.merge_checkout', compact('branch_atual', 'branchs'));
    }

    public function index_create_delete()
    {
        $git = new GitSistemaRepository();
        $branch_atual = $git->get_branch_current();
        $branchs = $git->get_branchs();
        return view('controle_versao.create_delete', compact('branch_atual', 'branchs'));
    }

    public function index_commit_branch()
    {
        $git = new GitSistemaRepository();
        $branch_atual = $git->get_branch_current();
        $branchs = $git->get_branchs();
        return view('controle_versao.commit', compact('branch_atual', 'branchs'));
    }

    public function index_pull_push()
    {
        $git = new GitSistemaRepository();
        $branch_atual = $git->get_branch_current();
        $branchs = $git->get_branchs();
        return view('controle_versao.pull_push', compact('branch_atual', 'branchs'));
    }

    public function index_init()
    {
        $git = new GitSistemaRepository();
        $branch_atual = $git->get_branch_current();
        return view('controle_versao.init', compact('tipo', 'branch_atual'));
    }

    public function index()
    {
        $git = new GitSistemaRepository();
        $branch_atual = $git->get_branch_current();
        $funcionalidades = [];
        $rotas = self::rotas();
        $dados = self::funcionalidades();
        for ($indice = 0; $indice < 5; $indice++) {
            $funcionalidades[$indice] = new Dado();
            $funcionalidades[$indice]->titulo = $dados[$indice];
            $funcionalidades[$indice]->rota = $rotas[$indice];
        }
        return view('controle_versao.index', compact('branch_atual', 'funcionalidades'));
    }


    public function init()
    {
        $git = new GitSistemaRepository();
        $git->git_init();
        $branch_atual = $git->get_branch_current();
        $git->git_commit('inicializacao do repositorio');

        return view('controle_versao.index', compact('tipo', 'branch_atual'));
    }

    public function delete(Request $request)
    {
        $git = new GitSistemaRepository();
        $git->git_remove_branch($request->branch);
        return redirect()->route('index_create_delete');
    }

    public function create(Request $request)
    {
        $git = new GitSistemaRepository();
        $git->git_create_branch($request->branch);
        return redirect()->route('index_create_delete');
    }

    public function push(Request $request)
    {

    }

    public function pull(Request $request)
    {
    }

    private function merge(Request $request)
    {
        $git = new GitSistemaRepository();
        if ($git->is_exchanges()) {
            $git->git_commit('merge');
        }
        $git->git_merge_branch($request->branch);
        if ($git->is_exchanges()) {
            $git->git_commit('merge');
        }
        return redirect()->route('index_merge_checkout');
    }


    public function merge_checkout(Request $request)
    {
        if ($request->tipo === 'merge') {
            return $this->merge($request);
        }
        return $this->checkout($request);
    }

    private function checkout(Request $request)
    {


//            $git_comando = new GitComando('/home/vagrant/code/projeto21/database/banco');
//            $git_comando->checkout($request->branch);
//                $git = new GitRepository('/home/vagrant/code/projeto21/database/banco');
//                $git->execute('checkout '.$request->branch);
//                $git->execute('reset --hard');
        shell_exec('cd /home/vagrant/code/projeto21/database/banco && git checkout ' . $request->branch);
//        shell_exec('cd /home/vagrant/code/projeto21/database/banco && git reset --hard');

        return redirect()->route('index_merge_checkout');
    }

    public function commit(Request $request)
    {
        $git = new GitSistemaRepository();
        $git->git_commit($request->mensagem);
        $branch_atual = $git->get_branch_current();
        return redirect()->route('index_commit_branch');
    }

    //token github
//'b67159b091d9ec2f5953de0361fc47d37efa0591'

public function sobe_arquivo_repositorio(Request $request){
    $client = new Client();
    $client->authenticate(Client::AUTH_HTTP_TOKEN, Client::AUTH_HTTP_PASSWORD);
    $repo = $client->repository();
//        dd($repo->show('jeancarlos2015', 'teste2015'));
//        $user = $client->user();
    $contents = new Contents($client);
    $client->repo()->branches('jeancarlos2015', 'teste2015', 'master');
//        dd($request->file('foo'));
    $file_name = $request->file('foo')->getRealPath();

    $handle = fopen($file_name, "r");
    $conteudo = fread($handle, filesize($file_name));
    fclose($handle);
    $formato = $request->file('foo')->guessExtension();
    $path = $request->file('foo')->path();
    $nome = $request->nome.".".$formato;
    $contents->archive('jeancarlos2015', 'teste2015', $formato);
    $contents->create('jeancarlos2015', 'teste2015',$nome ,$conteudo , 'teste');
    return redirect()->route('index_reset_files');
}

public function sobe_database_sqlite(){
    $client = new Client();
    $client->authenticate(Client::AUTH_HTTP_TOKEN, Client::AUTH_HTTP_PASSWORD);
    $contents = new Contents($client);
    $client->repo()->branches('jeancarlos2015', 'teste2015', 'master');
    $file_name = database_path('banco/database.sqlite');
    $handle = fopen($file_name, "r");
    $conteudo = fread($handle, filesize($file_name));
    fclose($handle);
    $formato = "sqlite";
    $path = database_path('banco');
    $nome = "database.sqlite";
    $contents->archive('jeancarlos2015', 'teste2015', $formato);
    $contents->create('jeancarlos2015', 'teste2015',$nome ,$conteudo , 'teste');
    return redirect()->route('index_reset_files');
}
    public function reset_files(Request $request)
    {
        $client = new Client();
        $client->authenticate(Client::AUTH_HTTP_TOKEN, Client::AUTH_HTTP_PASSWORD);
        $http_Client = $client->getHttpClient();
        $base_url = "https://api.github.com";
        $rota = "repos/jeancarlos2015/teste2015/branches";
        $url_branchs = $base_url."/".$rota;


//        https://api.github.com/repos/<AUTHOR>/<REPO>/git/refs


        $url_post = $base_url."/repos/jeancarlos2015/teste2015/git/refs";
//        dd($client->repository()->branches('jeancarlos2015', 'teste2015'));
//        dd($url_post);


        $authorization = $client->authorization();
        $authorizations = $client->authorizations();
        dd($authorizations->all());
        return redirect()->route('index_reset_files');
    }

    public function index_reset_files()
    {
        $git = new GitSistemaRepository();
        $branch_atual = $git->get_branch_current();
        return view('controle_versao.teste', compact('branch_atual'));
    }

    /**
     *
     */

}
