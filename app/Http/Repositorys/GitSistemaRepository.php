<?php

namespace App\Http\Repositorys;

use App\Http\Models\UsuarioGithub;
use App\Http\Util\Dado;
use Github\Api\Repository\Contents;
use Github\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class GitSistemaRepository
{


    private static function ler_arquivo($path)
    {

        $handle = fopen($path, "r");
        $conteudo = fread($handle, filesize($path));
        fclose($handle);
        return $conteudo;


    }

    private static function escrer_arquivo($path, $conteudo)
    {

        file_put_contents($path, $conteudo);

    }

    private static function upload_github_create($dado)
    {

        $nome = $dado['nome'];
        $conteudo = $dado['conteudo'];
        $formato = $dado['formato'];
        $branch = $dado['branch'];
        $mensagem = $dado['mensagem'];
        $repositorio = $dado['repositorio'];
//            $user_name = $dado['usuario'];
//            $email = $dado['email'];

        $client = new Client();
        $github = Auth::user()->github;
        $client->authenticate(Crypt::decrypt($github->usuario_github), Crypt::decrypt($github->senha_github));
        $contents = new Contents($client);

        if (!$contents->exists(decrypt($github->usuario_github), $repositorio, $nome, $branch)) {

            $contents->create(
                decrypt($github->usuario_github),
                $repositorio,
                $nome,
                $conteudo,
                $mensagem,
                $branch);

        } else {

            self::upload_github_update($dado);
        }


    }

    private static function upload_github_update($dado)
    {

        $nome = $dado['nome'];
        $conteudo = $dado['conteudo'];
        $formato = $dado['formato'];
        $branch = $dado['branch'];
        $mensagem = $dado['mensagem'];
        $repositorio = $dado['repositorio'];
        $user_name = $dado['usuario'];
        $email = $dado['email'];
        $client = new Client();
        $github = Auth::user()->github;
        $client->authenticate(
            Crypt::decrypt($github->usuario_github),
            Crypt::decrypt($github->senha_github)
        );
        $contents = new Contents($client);
        $commiter = array('name' => Crypt::decrypt($github->usuario_github), 'email' => $email);
        $oldfile = $client
            ->repo()
            ->contents()
            ->show(
                Crypt::decrypt($github->usuario_github),
                $repositorio,
                $nome,
                $branch
            );
        $contents->archive(
            $user_name,
            $repositorio,
            $formato,
            $branch
        );
        $contents->update(
            $user_name,
            $repositorio,
            $nome,
            $conteudo,
            $mensagem,
            $oldfile['sha'],
            $branch,
            $commiter
        );


    }

    private function upload_github_database_not_exists()
    {
        $conteudo = $this->ler_arquivo(database_path('banco/database.sqlite'));
        $this->upload_github_create(null);
    }

    private function upload_github_database()
    {
        $conteudo = $this->ler_arquivo(database_path('banco/database.sqlite'));
        $this->upload_github_create(null);
    }


    public static function create_branch($branch)
    {
        $client = new Client();
        $github = Auth::user()->github;
        $repositorio = $github->repositorio_atual;
        $usuario_git = Crypt::decrypt($github->usuario_github);
        $client->authenticate($usuario_git, Crypt::decrypt($github->senha_github));
        $branchs = $client->repo()->branches($usuario_git, $repositorio, $github->branch_atual);
        $sha = $branchs['commit']['sha'];
        $http_Client = $client->getHttpClient();
        $url = 'https://api.github.com/repos/' . $usuario_git . '/' . $repositorio . '/git/refs';
        $header = array("Authorization" => "");
        $body = '{
                "ref" : "refs/heads/' . $branch . '",
                "sha" : "' . $sha . '"
        }';
        $http_Client->post($url, $header, $body);
    }

    public static
    function delete_branch($branch)
    {
        $client = new Client();
        $github = Auth::user()->github;
        $repositorio = $github->repositorio_atual;
        $usuario_git = Crypt::decrypt($github->usuario_github);
        $client->authenticate($usuario_git, Crypt::decrypt($github->senha_github));
        $branchs = $client->repo()->branches($usuario_git, $repositorio, $branch);
        $sha = $branchs['commit']['sha'];
        $http_Client = $client->getHttpClient();
        $url = 'https://api.github.com/repos/' . $usuario_git . '/' . $repositorio . '/git/refs/heads/' . $branch;
        return $http_Client->delete($url)->getStatusCode();
    }

    private
    function update_branch_teste()
    {
        $client = new Client();
        $github = Auth::user()->github;
        $client->authenticate(Crypt::decrypt($github->usuario_github), Crypt::decrypt($github->senha_github));
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

    private static
    function merge_auxiliar($branch)
    {
        $client = new Client();
        $github = Auth::user()->github;
        $client->authenticate(Crypt::decrypt($github->usuario_github), Crypt::decrypt($github->senha_github));
        $client->repo()->merge(
            Crypt::decrypt($github->usuario_github),
            $github->repositorio_atual,
            $github->branch_atual,
            $branch,
            'Merger da ' . $branch . ' para dentro ' . $github->branch_atual
        );
    }

    public static function merge($branch)
    {
        self::merge_auxiliar($branch);
        $github = Auth::user()->github;
        self::pull($github->branch_atual);
    }

    private
    static function map_files_local($path)
    {
        if (file_exists($path)) {
            try {
                $Iterator = new \DirectoryIterator($path);
                $i = 0;
                $Files = [];
                for ($Iterator; $Iterator->valid(); $Iterator->next()) {
                    if ($Iterator->isFile() && !$Iterator->isDot()) {
                        $Files[++$i] = $Iterator->getFilename();
                    }
                }
                return $Files;
            } catch (\Exception $ex) {
                flash($ex->getMessage())->warning();
            }
        }
        return array();


    }

    private
    function teste_sob_arquivo_serializado()
    {
        $client = new Client();
        $github = Auth::user()->github;
        $client->authenticate(Crypt::decrypt($github->usuario_github), Crypt::decrypt($github->senha_github));
        $dado = new Dado();
        $dado->modelos = $this->ler_arquivo(database_path('banco/modelos/diagram.bpmn'));
        $dado->banco = $this->ler_arquivo(database_path('banco/database.sqlite'));
        $serializado = serialize($dado);
        $this->upload_github_create("database.dat", $serializado, '.dat', 'teste');

    }

    private
    function get_files_github()
    {
        $client = new Client();
        $github = Auth::user()->github;
        $client->authenticate(Crypt::decrypt($github->usuario_github), Crypt::decrypt($github->senha_github));

        dd($client->repo()->contents()->archive('jeancarlos2015', 'teste2015', '.sqlite'));
    }

    private
    function get_file_http()
    {
        $client = new Client();
        $github = Auth::user()->github;
        $client->authenticate(Crypt::decrypt($github->usuario_github), Crypt::decrypt($github->senha_github));
        $conteudo = $client->repo()->contents()->download('jeancarlos2015', 'teste2015', 'database.sqlite');

    }

    public
    static function pull_auxiliar($arquivo, $path, $branch_atual)
    {


        $client = new Client();
        $github = Auth::user()->github;

        $client->authenticate(
            Crypt::decrypt($github->usuario_github),
            Crypt::decrypt($github->senha_github)
        );
        $conteudo = $client->repo()
            ->contents()
            ->download(
                Crypt::decrypt($github->usuario_github),
                $github->repositorio_atual, $arquivo,
                $branch_atual
            );
        self::escrer_arquivo($path . "/" . $arquivo, $conteudo);


    }

    public
    static function create_repository($nome_repositorio)
    {
        $client = new Client();
        $github = Auth::user()->github;
        $client->authenticate(Crypt::decrypt($github->usuario_github), Crypt::decrypt($github->senha_github));
        return $client->repo()->create(
            $nome_repositorio,
            '',
            '',
            true,
            null,
            false,
            false,
            false,
            null,
            true);


    }

    public
    static function get_repositorio($username, $repository)
    {
        $client = new Client();
        $github = Auth::user()->github;
        $client->authenticate(Crypt::decrypt($github->usuario_github), Crypt::decrypt($github->senha_github));
        return $client->repo()->show($username, $repository);
    }

    public static
    function delete_repository($repositorio)
    {

        $client = new Client();
        $github = Auth::user()->github;
        $client->authenticate(Crypt::decrypt($github->usuario_github), Crypt::decrypt($github->senha_github));
        $client->repo()->remove(Crypt::decrypt($github->usuario_github), $repositorio);


    }

    public
    static function titulos_repositorio()
    {
        return [
            'nome',
            'Ações'
        ];
    }

    public
    function client_autenticate()
    {

        $client = new Client();
        $github = Auth::user()->github;
        $client->authenticate(Crypt::decrypt($github->usuario_github), Crypt::decrypt($github->senha_github));
        return $client;

    }

    public
    static function listar_githubs()
    {
        return UsuarioGithub::all()->where('codusuario', \Auth::user()->codusuario);
    }

    public
    static function delete_all_github()
    {
        foreach (UsuarioGithub::all() as $github) {
            $github->delete();
        }
    }

    private
    static function carrega_dados()
    {
        $files_bpmn = self::map_files_local(database_path('banco/modelos'));
        $dado = new Dado();
        for ($indice = 1; $indice <= count($files_bpmn); $indice++) {
            $dado->modelo[$indice] = [];
            $dado->conteudo_modelo[$indice] = [];
            $dado->modelo[$indice] = $files_bpmn[$indice];
            $dado->conteudo_modelo[$indice] = self::ler_arquivo(database_path('banco/modelos/') . "/" . $files_bpmn[$indice]);
        }
        $files__db = self::map_files_local(database_path('banco'));
        for ($indice = 1; $indice <= count($files__db); $indice++) {
            $dado->banco[$indice] = [];
            $dado->conteudo_banco[$indice] = [];
            $dado->banco[$indice] = $files__db[$indice];
            $dado->conteudo_banco[$indice] = self::ler_arquivo(database_path('banco') . "/" . $files__db[$indice]);
        }

        return $dado;
    }

    public static function apaga_modelos()
    {
        $files = self::map_files_local(database_path('banco/modelos'));
        if (!empty($files)) {
            foreach ($files as $file) {
                unlink(database_path('banco/modelos/') . $file);
            }
        }
    }

//$nome = $dado['nome'];
//$conteudo =  $dado['conteudo'];
//$formato = $dado['formato'];
//$branch = $dado['branch'];

//$table->bigIncrements('codusuariogithub');
//$table->string('usuario_github')->unique();
//$table->string('email_github');
//$table->string('token_github');
//$table->string('repositorio_atual')->nullable();
//$table->string('branch_atual')->nullable();
//$table->string('senha_github');
//$table->bigInteger('codusuario');

    private
    static function extrai_dados_banco(Dado $dado, $indice)
    {
        $github = Auth::user()->github;
        $dados['nome'] = $dado->banco[$indice];
        $dados['conteudo'] = $dado->conteudo_banco[$indice];
        $dados['formato'] = "." . explode('.', $dado->banco[$indice])[1];;
        $dados['branch'] = $github->branch_atual;
        $dados['mensagem'] = $dado->mensagem;
        $dados['repositorio'] = $github->repositorio_atual;
        $dados['usuario'] = Crypt::decrypt($github->usuario_github);
        $dados['email'] = $github->email_github;

        return $dados;
    }


    private
    static function extrai_dados_modelos(Dado $dado, $indice)
    {
        $github = Auth::user()->github;
        $dados['nome'] = $dado->modelo[$indice];
        $dados['conteudo'] = $dado->conteudo_modelo[$indice];
        $dados['formato'] = "." . explode('.', $dado->modelo[$indice])[1];;
        $dados['branch'] = $github->branch_atual;
        $dados['mensagem'] = $dado->mensagem;
        $dados['repositorio'] = $github->repositorio_atual;
        $dados['usuario'] = $github->usuario_github;
        $dados['email'] = $github->email_github;
        return $dados;
    }

    public
    static function commit($mensagem)
    {

        $dado = self::carrega_dados();
        $dado->mensagem = $mensagem;
        $dados = self::extrai_dados_banco($dado, 1);

        //upload do banco
        self::upload_github_create($dados);

        //upload dos modelos
        for ($indice = 1; $indice <= count($dado->modelo); $indice++) {
            $dados1 = self::extrai_dados_modelos($dado, $indice);
            self::upload_github_create($dados1);
        }
        return $dado;


    }

    private static function get_files_github_pull()
    {
        $client = new Client();
        $github = Auth::user()->github;

        $client->authenticate(
            Crypt::decrypt($github->usuario_github),
            Crypt::decrypt($github->senha_github)
        );
        $contents = $client
            ->repo()
            ->contents()
            ->show(
                Crypt::decrypt($github->usuario_github),
                'IFES',
                '',
                'master'
            );
        $banco = collect($contents)->where('name', '=', 'database.db');
        $modelos = collect($contents)->where('name', '!=', 'database.db');
        $dados['banco'] = $banco[0];
        $dados['modelos'] = $modelos;
        return $dados;
    }

    private static function verifica_arquivos($path_banco, $path_modelo)
    {
        //obtem o caminho do banco
        $path_banco = database_path('banco');
        //obtem o caminho dos modelos
        $path_modelo = database_path('banco/modelos');
        //obtem o nome do banco
        if (!file_exists($path_banco)) {
            mkdir($path_modelo, 777);
        }
        if (!file_exists($path_modelo)) {
            mkdir($path_modelo, 777);
        }
    }

    public
    static function pull($default_branch)
    {

        //obtem o caminho do banco
        $path_banco = database_path('banco');
        //obtem o caminho dos modelos
        $path_modelo = database_path('banco/modelos');
        self::verifica_arquivos($path_banco, $path_modelo);
        //obtem o nome do banco
        $dados = self::get_files_github_pull();
        $nome_banco = $dados['banco']['name'];
        $modelos = $dados['modelos'];

        //baixa os modelos e os sobrescreve
        self::pull_auxiliar($nome_banco, $path_banco, $default_branch);
        foreach ($modelos as $modelo) {
            self::pull_auxiliar($modelo['name'], $path_modelo, $default_branch);
        }


    }


    public static function listar_repositorios()
    {
        try {
            $client = new Client();
            $github = Auth::user()->github;
            $client->authenticate(Crypt::decrypt($github->usuario_github), Crypt::decrypt($github->senha_github));
            return collect($client->currentUser()->repositories());
        } catch (\Exception $ex) {
            flash(
                'Error ao obter dados do usuário do github, é provável que não tenha 
                          sincronizado com a conta do github, se o mesmo foi sincronizado da 
                          forma correta favor desconsiderar esta mensagem. Para Configurar a conta
                          é necessário ir na aba Configuração->Github e prencher o formulário')->warning();
            return collect(array());
        }
    }

    public static function change_branch($repositorio_atual, $default_branch)
    {


        $github_data = Auth::user()->github;
        $user_github = (new \App\Http\Models\UsuarioGithub)->findOrFail($github_data->codusuariogithub);
        $data = [
            'codusuario' => Auth::user()->codusuario,
            'email_github' => $github_data->email_github,
            'senha_github' => $github_data->senha_github,
            'branch_atual' => $default_branch,
            'repositorio_atual' => $repositorio_atual
        ];
        $user_github->update($data);

    }

    public static function checkout($default_branch)
    {

        $github = Auth::user()->github;
        self::change_branch($github->repositorio_atual, $default_branch);
        sleep(3);
        self::pull($default_branch);


    }

}
