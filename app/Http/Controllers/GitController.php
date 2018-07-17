<?php

namespace App\Http\Controllers;

use App\Http\Repositorys\GitSistemaRepository;
use App\Http\Util\Dado;
use Github\Api\Repo;
use Github\Api\Repository\Contents;
use Github\Client;
use Github\HttpClient\Plugin\GithubExceptionThrower;
use GrahamCampbell\GitHub\Facades\GitHub;
use GrahamCampbell\GitHub\GitHubManager;
use Illuminate\Config\Repository;
use Illuminate\Http\Request;
use PHPStan\Type\Type;

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
    public function reset_files(Request $request)
    {
        $client = new Client();
        $client->authenticate(Client::AUTH_HTTP_TOKEN,Client::AUTH_HTTP_PASSWORD);
        $repo = $client->repository();
//        dd($repo->show('jeancarlos2015', 'teste2015'));
//        $user = $client->user();
        $contents = new Contents($client);
        $client->repo()->branches('jeancarlos2015', 'teste2015', 'master');
        $client->getHttpClient()->post('/repos/jeancarlos2015/teste2015/git/refs',[],[
            
                "ref"=>"refs/heads/teste",
                "sha" => "master"

        ]);
//        $contents->archive('jeancarlos2015', 'teste2015', '.sqlite');
//        $contents->configure();
//        $contents->create('jeancarlos2015', 'teste2015', 'database.sqlite','conteudo' , 'teste');
//        $treeSHA = 'master';
//        $commitData = ['message' => 'Upgrading documentation', 'tree' => $treeSHA, 'parents' => [$parentCommitSHA]];
//        $commit = $client->api('gitData')->commits()->create('KnpLabs', 'php-github-api', $commitData);

//        $committer = array('name' => 'jeancarlos2015', 'email' => 'jeancarlospenas25@gmail.com');
//
//        $oldFile = $client->repo()->contents()->show('jeancarlos2015', 'teste2015', 'banco', '/home/vagrant/code/projeto21/database/banco/database.sqlite');
//
//        $fileInfo = $client->repo()->contents()->update('jeancarlos2015', 'teste2015', '/home/vagrant/code/projeto21/database/banco', '/home/vagrant/code/projeto21/database/banco/database.sqlite', 'teste', $oldFile['sha'], 'master', $committer);
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
