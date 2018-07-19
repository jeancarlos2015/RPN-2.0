<?php

namespace App\Http\Controllers;

use App\Http\Repositorys\GitSistemaRepository;
use App\Http\Util\Dado;
use Github\Api\Repository\Contents;
use Github\Client;
use Http\Client\Exception;
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
        $branch_atual = 'Em construção';
        return view('controle_versao.merge_checkout', compact('branch_atual', 'branchs'));
    }

    public function index_create_delete()
    {
        $branch_atual = 'Em construção';
        return view('controle_versao.create_delete', compact('branch_atual', 'branchs'));
    }

    public function index_commit_branch()
    {
        $branch_atual = 'Em construção';
        return view('controle_versao.commit', compact('branch_atual', 'branchs'));
    }

    public function index_pull_push()
    {
        $branch_atual = 'Em construção';
        return view('controle_versao.pull_push', compact('branch_atual', 'branchs'));
    }

    public function index_init()
    {
        $branch_atual = 'Em construção';
        return view('controle_versao.init', compact('tipo', 'branch_atual'));
    }

    public function index()
    {
        $funcionalidades = [];
        $rotas = self::rotas();
        $dados = self::funcionalidades();
        for ($indice = 0; $indice < 5; $indice++) {
            $funcionalidades[$indice] = new Dado();
            $funcionalidades[$indice]->titulo = $dados[$indice];
            $funcionalidades[$indice]->rota = $rotas[$indice];
        }
        $branch_atual = 'Em construção';

        return view('controle_versao.index', compact('branch_atual', 'funcionalidades'));
    }


    public function init()
    {
        $branch_atual = 'Em construção';
        return view('controle_versao.index', compact('tipo', 'branch_atual'));
    }

    public function delete(Request $request)
    {

        return redirect()->route('index_create_delete');
    }

    public function create(Request $request)
    {

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

        return redirect()->route('index_merge_checkout');
    }


    public function merge_checkout(Request $request)
    {

        return $this->checkout($request);
    }

    private function checkout(Request $request)
    {


        return redirect()->route('index_merge_checkout');
    }

    public function commit(Request $request)
    {

        return redirect()->route('index_commit_branch');
    }

    //token github
//'b67159b091d9ec2f5953de0361fc47d37efa0591'

    private function upload_file_github(Request $request)
    {
        //recebe o caminho do arquivo
        $file_name = $request->file('foo')->getRealPath();
        //ler o arquivo
        $conteudo = $this->ler_arquivo($file_name);

        //configura os parametros para upload
        $formato = $request->file('foo')->guessExtension();
        $path = $request->file('foo')->path();
        $nome = $request->nome . "." . $formato;

        //faz o upload do arquivo
        $this->upload_github_create($nome, $conteudo, $formato);
    }

    private function ler_arquivo($path)
    {
        $handle = fopen($path, "r");
        $conteudo = fread($handle, filesize($path));
        fclose($handle);
        return $conteudo;
    }

    private function escrer_arquivo($path, $conteudo)
    {
        file_put_contents($path, $conteudo);
    }

    private function upload_github_create($nome, $conteudo, $formato, $branch)
    {
        $client = new Client();
        $client->authenticate(Client::AUTH_HTTP_TOKEN, Client::AUTH_HTTP_PASSWORD);
        $contents = new Contents($client);

        if (!$contents->exists('jeancarlos2015', 'teste2015', $nome, $branch)) {
            $contents->archive('jeancarlos2015', 'teste2015', $formato, $branch);

            $contents->create(
                'jeancarlos2015',
                'teste2015',
                $nome,
                $conteudo,
                'teste',
                $branch);

        }
    }

    private function upload_github_update($nome, $conteudo, $formato, $branch)
    {
        $client = new Client();
        $client->authenticate(Client::AUTH_HTTP_TOKEN, Client::AUTH_HTTP_PASSWORD);
        $contents = new Contents($client);
        $commiter = array('name' => 'jeancarlos2015', 'email' => 'jeancarlospenas25@gmail.com');
        $oldfile = $client->repo()->contents()->show('jeancarlos2015', 'teste2015', $nome, $branch);
        $contents->archive('jeancarlos2015', 'teste2015', $formato, $branch);
        $contents->update(
            'jeancarlos2015',
            'teste2015',
            $nome,
            $conteudo,
            'atualizacao',
            $oldfile['sha'],
            $branch,
            $commiter);


    }

    private function upload_github_database_not_exists()
    {
        $conteudo = $this->ler_arquivo(database_path('banco/database.sqlite'));
        $this->upload_github_create("database3232.sqlite", $conteudo, 'sqlite', 'teste');
    }

    private function upload_github_database()
    {
        $conteudo = $this->ler_arquivo(database_path('banco/database.sqlite'));
        $this->upload_github_update("database.sqlite", $conteudo, 'sqlite', 'teste');
    }


    private function create_branch($branch, $repositorio, $usuario_git)
    {
        $client = new Client();
        $client->authenticate(Client::AUTH_HTTP_TOKEN, Client::AUTH_HTTP_PASSWORD);
        $http_Client = $client->getHttpClient();
        $url = 'https://api.github.com/repos/' . $usuario_git . '/' . $repositorio . '/git/refs';
        $header = [
            [
                'Authorization' => 'Basic amVhbmNhcmxvc3BlbmFzMjVAZ21haWwuY29tOmFzbmFlYjEyM3BldA=='
            ]
        ];

        $body = array("ref" => "refs/heads/" . $branch, "sha" => "a84deace201e8f873741cf82b5f999b482b1c91c");

        try {
            $http_Client->post($url, $header, $body);
            flash('Branch ' . $branch . ' criada com sucesso!!!');
        } catch (Exception $e) {

            flash($e->getMessage());
        }
    }

    private function delete_branch_teste()
    {
        $client = new Client();
        $client->authenticate(Client::AUTH_HTTP_TOKEN, Client::AUTH_HTTP_PASSWORD);
        $http_Client = $client->getHttpClient();
        $base_url = "https://api.github.com";

        $url = 'https://api.github.com/repos/jeancarlos2015/teste2015/git/refs/heads/teste';
        $header = [
            [
                'Authorization' => 'Basic amVhbmNhcmxvc3BlbmFzMjVAZ21haWwuY29tOmFzbmFlYjEyM3BldA=='
            ]

        ];

        $body = '
        {
            
                "ref" : "refs/heads/teste1",
                "sha" : "a84deace201e8f873741cf82b5f999b482b1c91c"
        }

        ';

        dd($http_Client->delete($url, $header)->getStatusCode());

    }

    private function update_branch_teste()
    {
        $client = new Client();
        $client->authenticate(Client::AUTH_HTTP_TOKEN, Client::AUTH_HTTP_PASSWORD);
        $branchs = $client->repo()->branches('jeancarlos2015', 'teste2015');
//        dd($branchs);
        $http_Client = $client->getHttpClient();

        $url = 'https://api.github.com/repos/jeancarlos2015/teste2015/git/refs/:ref';
        $header = [
            [
                'Authorization' => 'Basic amVhbmNhcmxvc3BlbmFzMjVAZ21haWwuY29tOmFzbmFlYjEyM3BldA=='
            ]

        ];

        $body = '
        {
                "ref" : "refs/heads/teste"
                "sha" : "a84deace201e8f873741cf82b5f999b482b1c91c",
                "force" : true
        }

        ';

        dd($client->repository()->merge('jeancarlos2015', 'teste2015', 'master', 'teste'));
    }

    private function merge_branch_teste($base, $branch, $mensagem)
    {
        $client = new Client();
        $client->authenticate(Client::AUTH_HTTP_TOKEN, Client::AUTH_HTTP_PASSWORD);
        $client->repo()->merge(
            'jeancarlos2015',
            'teste2015',
            $base,
            $branch,
            $mensagem);
    }

    private function map_files_local($path)
    {
        $Iterator = new \DirectoryIterator($path);
        $i = 0;
        for ($Iterator; $Iterator->valid(); $Iterator->next()) {
            if ($Iterator->isFile() && !$Iterator->isDot()) {
                $Files[++$i] = $Iterator->getFilename();
            }
        }
        return $Files;
    }

    private function teste_sob_arquivo_serializado()
    {
        $client = new Client();
        $client->authenticate(Client::AUTH_HTTP_TOKEN, Client::AUTH_HTTP_PASSWORD);
        $dado = new Dado();
        $dado->modelos = $this->ler_arquivo(database_path('banco/modelos/diagram.bpmn'));
        $dado->banco = $this->ler_arquivo(database_path('banco/database.sqlite'));
        $serializado = serialize($dado);
        $this->upload_github_create("database.dat", $serializado, '.dat', 'teste');

    }

    private function get_files_github()
    {
        $client = new Client();
        $client->authenticate(Client::AUTH_HTTP_TOKEN, Client::AUTH_HTTP_PASSWORD);

        dd($client->repo()->contents()->archive('jeancarlos2015', 'teste2015', '.sqlite'));
    }

    private function get_file_http()
    {
        $client = new Client();
        $client->authenticate(Client::AUTH_HTTP_TOKEN, Client::AUTH_HTTP_PASSWORD);
        $conteudo = $client->repo()->contents()->download('jeancarlos2015', 'teste2015', 'database.sqlite');

    }

    public function pull_banco()
    {
        $client = new Client();
        $client->authenticate(Client::AUTH_HTTP_TOKEN, Client::AUTH_HTTP_PASSWORD);
        $conteudo = $client->repo()->contents()->download('jeancarlos2015', 'teste2015', 'database.sqlite', 'master');
        $this->escrer_arquivo(database_path('banco/database.sqlite'), $conteudo);
    }

    private function create_repository($repositorio){
        $client = new Client();
        $client->authenticate(Client::AUTH_HTTP_TOKEN, Client::AUTH_HTTP_PASSWORD);
        $client->repo()->create($repositorio);
    }
    public function delete_repository($repositorio, $usuario_git){
        $client = new Client();
        $client->authenticate(Client::AUTH_HTTP_TOKEN, Client::AUTH_HTTP_PASSWORD);
        $client->repo()->remove($usuario_git, $repositorio);
    }

    public function reset_files(Request $request)
    {
        $client = new Client();
        $client->authenticate(Client::AUTH_HTTP_TOKEN, Client::AUTH_HTTP_PASSWORD);

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
