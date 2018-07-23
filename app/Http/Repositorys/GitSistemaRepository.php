<?php

namespace App\Http\Repositorys;

use App\Http\Models\UsuarioGithub;
use App\Http\Util\Dado;
use Github\Api\Repository\Contents;
use Github\Client;
use Illuminate\Support\Facades\Auth;

class GitSistemaRepository
{
    private function upload_file_github(\Request $request)
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
        $user_name = $dado['usuario'];
        $email = $dado['email'];

        $client = new Client();
        $github = Auth::user()->github;
        $client->authenticate($github->usuario_github, $github->senha_github);
        $contents = new Contents($client);

        if (!$contents->exists($user_name, $repositorio, $nome, $branch)) {
            try {
                $contents->archive('jeancarlos2015', 'teste', '.db', 'master');
            } catch (\Exception $ex) {
                dd($ex->getMessage());
            }


            $contents->create(
                $user_name,
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
        $client->authenticate($github->usuario_github, $github->senha_github);
        $contents = new Contents($client);
        $commiter = array('name' => $user_name, 'email' => $email);
        $oldfile = $client->repo()->contents()->show($user_name, $repositorio, $nome, $branch);
        $contents->archive($user_name, $repositorio, $formato, $branch);
        $contents->update(
            $user_name,
            $repositorio,
            $nome,
            $conteudo,
            $mensagem,
            $oldfile['sha'],
            $branch,
            $commiter);


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
        $usuario_git = $github->usuario_github;
        $client->authenticate($github->usuario_github, $github->senha_github);
        $http_Client = $client->getHttpClient();
        $url = 'https://api.github.com/repos/' . $usuario_git . '/' . $repositorio . '/git/refs';
        $header = [
            [
//                'Authorization' => 'Basic amVhbmNhcmxvc3BlbmFzMjVAZ21haWwuY29tOmFzbmFlYjEyM3BldA=='
            ]
        ];

        $body = array("ref" => "refs/heads/" . $branch, "sha" => "a84deace201e8f873741cf82b5f999b482b1c91c");

        try {
            $http_Client->post($url, $header, $body);
            flash('Branch ' . $branch . ' criada com sucesso!!!');
        } catch (\Exception $e) {

            flash($e->getMessage());
        }
    }

    private function delete_branch_teste()
    {
        $client = new Client();
        $github = Auth::user()->github;
        $client->authenticate($github->usuario_github, $github->senha_github);
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
        $github = Auth::user()->github;
        $client->authenticate($github->usuario_github, $github->senha_github);
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
        $github = Auth::user()->github;
        $client->authenticate($github->usuario_github, $github->senha_github);
        $client->repo()->merge(
            'jeancarlos2015',
            'teste2015',
            $base,
            $branch,
            $mensagem);
    }

    private static function map_files_local($path)
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
        $github = Auth::user()->github;
        $client->authenticate($github->usuario_github, $github->senha_github);
        $dado = new Dado();
        $dado->modelos = $this->ler_arquivo(database_path('banco/modelos/diagram.bpmn'));
        $dado->banco = $this->ler_arquivo(database_path('banco/database.sqlite'));
        $serializado = serialize($dado);
        $this->upload_github_create("database.dat", $serializado, '.dat', 'teste');

    }

    private function get_files_github()
    {
        $client = new Client();
        $github = Auth::user()->github;
        $client->authenticate($github->usuario_github, $github->senha_github);

        dd($client->repo()->contents()->archive('jeancarlos2015', 'teste2015', '.sqlite'));
    }

    private function get_file_http()
    {
        $client = new Client();
        $github = Auth::user()->github;
        $client->authenticate($github->usuario_github, $github->senha_github);
        $conteudo = $client->repo()->contents()->download('jeancarlos2015', 'teste2015', 'database.sqlite');

    }

    public static function pull_auxiliar($arquivo, $path)
    {
        $client = new Client();
        $github = Auth::user()->github;
        $client->authenticate($github->usuario_github, $github->senha_github);
        $conteudo = $client->repo()->contents()->download($github->usuario_github, $github->repositorio_atual, $arquivo, $github->branch_atual);
        self::escrer_arquivo($path . "/" . $arquivo, $conteudo);
    }

    public static function create_repository($nome_repositorio)
    {
        $client = new Client();
        $github = Auth::user()->github;
        $client->authenticate($github->usuario_github, $github->senha_github);
        try {
            return $client->repo()->create($nome_repositorio);
        } catch (\Exception $ex) {
            $client->repo()->remove($github->usuario_github, $nome_repositorio);
            return $client->repo()->create($nome_repositorio);
        }
    }

    public static function get_repositorio($username, $repository)
    {
        $client = new Client();
        $github = Auth::user()->github;
        $client->authenticate($github->usuario_github, $github->senha_github);
        return $client->repo()->show($username, $repository);
    }

    public function delete_repository($repositorio, $usuario_git)
    {
        $client = new Client();
        $github = Auth::user()->github;
        $client->authenticate($github->usuario_github, $github->senha_github);
        $client->repo()->remove($usuario_git, $repositorio);
    }

    public static function titulos_repositorio()
    {
        return [
            'nome',
            'Ações'
        ];
    }

    public function client_autenticate()
    {
        $client = new Client();
        $github = Auth::user()->github;
        $client->authenticate($github->usuario_github, $github->senha_github);
        return $client;
    }

    public static function listar_githubs()
    {
        return UsuarioGithub::all()->where('codusuario', \Auth::user()->codusuario);
    }

    public static function delete_all_github()
    {
        foreach (UsuarioGithub::all() as $github) {
            $github->delete();
        }
    }

    private static function carrega_dados()
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

    private static function extrai_dados_banco(Dado $dado, $indice)
    {
        $github = Auth::user()->github;
        $dados['nome'] = $dado->banco[$indice];
        $dados['conteudo'] = $dado->conteudo_banco[$indice];
        $dados['formato'] = "." . explode('.', $dado->banco[$indice])[1];;
        $dados['branch'] = $github->branch_atual;
        $dados['mensagem'] = $dado->mensagem;
        $dados['repositorio'] = $github->repositorio_atual;
        $dados['usuario'] = $github->usuario_github;
        $dados['email'] = $github->email_github;

        return $dados;
    }


    private static function extrai_dados_modelos(Dado $dado, $indice)
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

    public static function commit($mensagem)
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

    public static function pull()
    {
        //obtem o caminho do banco
        $path_banco = database_path('banco');
        //obtem o caminho dos modelos
        $path_modelo = database_path('banco/modelos');
        //obtem o nome do banco
        $file_banco = self::map_files_local($path_banco);
        //obtem o nome dos modelos
        $file_modelos = self::map_files_local($path_modelo);
        //baixa o banco e sobrescreve-o
        self::pull_auxiliar($file_banco[1], $path_banco);
        //baixa os modelos e os sobrescreve
        for ($indice = 1; $indice <= count($file_modelos); $indice++) {
            self::pull_auxiliar($file_modelos[$indice], $path_modelo);
        }
    }

    
}
