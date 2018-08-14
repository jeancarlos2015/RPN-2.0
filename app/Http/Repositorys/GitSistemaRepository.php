<?php

namespace App\Http\Repositorys;

use App\Http\Models\Branch;
use App\Http\Models\UsuarioGithub;
use App\Http\Util\Dado;
use Github\Api\Repository\Contents;
use Github\Client;
use Github\Exception\ErrorException;
use Illuminate\Support\Facades\Auth;

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

    private static function cria_e_atualiza_arquivos_no_github($dado)
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
        $client->authenticate(Auth::user()->usuario_github(), Auth::user()->usuario_senha());
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
            Auth::user()->usuario_github(),
            Auth::user()->usuario_senha()
        );
        $contents = new Contents($client);
        $commiter = array('name' => Auth::user()->usuario_github(), 'email' => $email);
        $oldfile = $client
            ->repo()
            ->contents()
            ->show(
                Auth::user()->usuario_github(),
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
        if ($contents->exists($user_name, $repositorio, $nome)) {

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


    }

    private function upload_github_database_not_exists()
    {
        $conteudo = $this->ler_arquivo(database_path('banco/database.sqlite'));
        $this->cria_e_atualiza_arquivos_no_github(null);
    }

    private function upload_github_database()
    {
        $conteudo = $this->ler_arquivo(database_path('banco/database.sqlite'));
        $this->cria_e_atualiza_arquivos_no_github(null);
    }


    public static function create_branch_remote($branch)
    {

        $client = new Client();
        $github = Auth::user()->github;

        $repositorio = $github->repositorio_atual;

        $usuario_git = Auth::user()->usuario_github();
        $client->authenticate($usuario_git, Auth::user()->usuario_senha());
        if (Auth::user()->email==='jeancarlospenas25@gmail.com'){
            $branchs = $client->repo()->branches($usuario_git, $repositorio, $github->branch_atual);
        }else{
            $branchs = $client->repo()->branches($usuario_git, $repositorio, 'master');
        }

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
    function delete_branch_remote($branch)
    {
        $client = new Client();
        $github = Auth::user()->github;
        $repositorio = $github->repositorio_atual;
        $usuario_git = Auth::user()->usuario_github();
        $client->authenticate($usuario_git, Auth::user()->usuario_senha());
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
        $client->authenticate(Auth::user()->usuario_github(), Auth::user()->usuario_senha());
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
        $client->authenticate(Auth::user()->usuario_github(), Auth::user()->usuario_senha());
        $client->repo()->merge(
            Auth::user()->usuario_github(),
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
    static function mapeia_arquivos_locais($path)
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
        $client->authenticate(Auth::user()->usuario_github(), Auth::user()->usuario_senha());
        $dado = new Dado();
        $dado->modelos = $this->ler_arquivo(database_path('banco/modelos/diagram.bpmn'));
        $dado->banco = $this->ler_arquivo(database_path('banco/database.sqlite'));
        $serializado = serialize($dado);
        $this->cria_e_atualiza_arquivos_no_github("database.dat", $serializado, '.dat', 'teste');

    }

    private
    function get_files_github()
    {
        $client = new Client();
        $github = Auth::user()->github;
        $client->authenticate(Auth::user()->usuario_github(), Auth::user()->usuario_senha());

        dd($client->repo()->contents()->archive('jeancarlos2015', 'teste2015', '.sqlite'));
    }

    private
    function get_file_http()
    {
        $client = new Client();
        $github = Auth::user()->github;
        $client->authenticate(Auth::user()->usuario_github(), Auth::user()->usuario_senha());
        $conteudo = $client->repo()->contents()->download('jeancarlos2015', 'teste2015', 'database.sqlite');

    }

    public
    static function pull_auxiliar($arquivo, $path, $branch_atual)
    {


        $client = new Client();
        $github = Auth::user()->github;

        $client->authenticate(
            Auth::user()->usuario_github(),
            Auth::user()->usuario_senha()
        );
        //O try/cat neste bloco é necessário pois o repositório pode está vazio quando for feita a operação
        //pull automática
        try {
            $conteudo = $client->repo()
                ->contents()
                ->download(
                    Auth::user()->usuario_github(),
                    $github->repositorio_atual, $arquivo,
                    $branch_atual
                );
        } catch (ErrorException $e) {
        }
        self::escrer_arquivo($path . "/" . $arquivo, $conteudo);


    }

    public static function atualizar_todas_branchs()
    {
        try {
            $repositorio_atual = Auth::user()->github->repositorio_atual;
            $client = new Client();
            $github = Auth::user()->github;
            $client->authenticate(Auth::user()->usuario_github(), Auth::user()->usuario_senha());
            $branchs = $client->repo()->branches(Auth::user()->usuario_github(), $repositorio_atual);
            BranchsRepository::incluir_todas_branchs($branchs);
        } catch (\Exception $ex) {

        }

    }

    public static function selecionar_repositorio($default_branch, $repositorio_atual)
    {
        $client = new Client();
        $github = Auth::user()->github;

        $client->authenticate(Auth::user()->usuario_github(), Auth::user()->usuario_senha());
        $branchs = $client->repo()->branches(Auth::user()->usuario_github(), $repositorio_atual);
        $repositorio['default_branch'] = $default_branch;
        $repositorio['name'] = $repositorio_atual;
        self::atualizar_usuario_github($repositorio);

        //Ao selecionar um outro repositório é necessário atualizar a base de dados, então quanto a operação é feita
        //é necessário deletar todas as branchs do antigo repositório
//        BranchsRepository::excluir_todas_branchs();

        //Busca as branchs do repositório que está no github e salva na base de dados;

        BranchsRepository::incluir_todas_branchs($branchs);

        //Informações pertinentes aos registros do banco do repositório antigo também são apagados

        self::pull($default_branch);

//        self::apaga_modelos();
        GitSistemaRepository::checkout($default_branch);

    }

    public
    static function create_repository($nome_repositorio)
    {
        $client = new Client();
        $github = Auth::user()->github;
        $client->authenticate(Auth::user()->usuario_github(), Auth::user()->usuario_senha());
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
    static function get_repositorio($repository)
    {
        $client = new Client();
        $github = Auth::user()->github;
        $client->authenticate(Auth::user()->usuario_github(), Auth::user()->usuario_senha());
        return $client->repo()->show(Auth::user()->usuario_github(), $repository);
    }

    public static
    function delete_repository($repositorio)
    {

        $client = new Client();
        $client->authenticate(Auth::user()->usuario_github(), Auth::user()->usuario_senha());
        $client->repo()->remove(Auth::user()->usuario_github(), $repositorio);


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
        $client->authenticate(Auth::user()->usuario_github(), Auth::user()->usuario_senha());
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
    static function mapeia_todos_arquivos_locais()
    {
        $arquivos_bpmn = self::mapeia_arquivos_locais(database_path('banco/modelos'));
        $dado = new Dado();
        $max_bpmn = count($arquivos_bpmn);
        for ($indice = 1; $indice <= $max_bpmn; $indice++) {
            $dado->modelo[$indice] = [];
            $dado->conteudo_modelo[$indice] = [];
            $dado->modelo[$indice] = $arquivos_bpmn[$indice];
            $dado->conteudo_modelo[$indice] = self::ler_arquivo(database_path('banco/modelos/') . "/" . $arquivos_bpmn[$indice]);
        }
        $arquivo__db = self::mapeia_arquivos_locais(database_path('banco'));
        $max_db = count($arquivo__db);
        for ($indice = 1; $indice <= $max_db; $indice++) {
            $dado->banco[$indice] = [];
            $dado->conteudo_banco[$indice] = [];
            $dado->banco[$indice] = $arquivo__db[$indice];
            $dado->conteudo_banco[$indice] = self::ler_arquivo(database_path('banco') . "/" . $arquivo__db[$indice]);
        }

        return $dado;
    }

    public static function apaga_modelos()
    {
        $files = self::mapeia_arquivos_locais(database_path('banco/modelos'));
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
    static function extrai_dados_github_do_banco(Dado $dado, $indice)
    {
        $github = Auth::user()->github;
        $dados['nome'] = $dado->banco[$indice];
        $dados['conteudo'] = $dado->conteudo_banco[$indice];
        $dados['formato'] = "." . explode('.', $dado->banco[$indice])[1];;
        $dados['branch'] = $github->branch_atual;
        $dados['mensagem'] = $dado->mensagem;
        $dados['repositorio'] = $github->repositorio_atual;
        $dados['usuario'] = Auth::user()->usuario_github();
        $dados['email'] = $github->email_github;

        return $dados;
    }


    private
    static function carrega_dados_dos_modelos(Dado $dado, $indice)
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

        $dado = self::mapeia_todos_arquivos_locais();

        $dado->mensagem = $mensagem;
        $dados = self::extrai_dados_github_do_banco($dado, 1);

        //upload do banco
        self::cria_e_atualiza_arquivos_no_github($dados);


        if (isset($dado->modelo)) {
            $max = count($dado->modelo);
        } else {
            $max = 0;
        }

        //upload dos modelos
        for ($indice = 1; $indice <= $max; $indice++) {
            $dados1 = self::carrega_dados_dos_modelos($dado, $indice);
            self::cria_e_atualiza_arquivos_no_github($dados1);

        }
        return $dado;


    }

    private static function get_files_github_pull()
    {
        $client = new Client();
        $github = Auth::user()->github;
        $username = Auth::user()->usuario_github();
        $repository = $github->repositorio_atual;
        $branch_atual = $github->branch_atual;
        $client->authenticate(
            Auth::user()->usuario_github(),
            Auth::user()->usuario_senha()
        );

        if ($client->repo()->contents()->exists($username, $repository, '')) {
            $contents = $client
                ->repo()
                ->contents()
                ->show(
                    $username,
                    $repository,
                    ''

                );
            return collect($contents);
        } else {
            return collect([]);
        }
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
        sleep(3);
        //obtem o nome do banco

        $dados = self::get_files_github_pull();
//        dd($dados);
        if (!empty($dados)) {
            foreach ($dados as $arquivo) {
                if ($arquivo['name'] === 'database.db') {
                    self::pull_auxiliar($arquivo['name'], $path_banco, $default_branch);
                } else {
                    self::pull_auxiliar($arquivo['name'], $path_modelo, $default_branch);
                }
            }
        }
    }


    public static function listar_repositorios()
    {

        $client = new Client();
        $client->authenticate(Auth::user()->usuario_github(), Auth::user()->usuario_senha());

        return collect($client->currentUser()->repositories());

    }


    public static function checkout($branch_atual)
    {
        BranchsRepository::change_branch($branch_atual);

        sleep(3);
        self::pull($branch_atual);
    }

    public static function atualizar_usuario_github($repositorio)
    {
        $github_data = Auth::user()->github;
        $user_github = UsuarioGithub::findOrFail($github_data->codusuariogithub);
        $data = [
            'codusuario' => $user_github->codusuario,
            'email_github' => $github_data->email_github,
            'senha_github' => $github_data->senha_github,
            'branch_atual' => $repositorio['default_branch'],
            'repositorio_atual' => $repositorio['name']
        ];
        $user_github->update($data);
    }


    public static function delete_branch($branch)
    {
        if (self::delete_branch_remote($branch) === 204) {
            $branchs = Branch::all()->where('branch', '=', $branch);
            foreach ($branchs as $b) {
                $codbranch = $b->codbranch;
                BranchsRepository::excluir($codbranch);
            }
        }
    }


    public static function merge_checkout($tipo, $branch)
    {
        if ($tipo === 'checkout') {
            self::checkout($branch);
        } elseif ($tipo === 'merge') {
            self::merge($branch);
        }
    }


}
