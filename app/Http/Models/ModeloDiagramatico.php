<?php

namespace App\Http\Models;

use App\Http\Util\Dado;
use App\Http\Models\Projeto;
use App\Http\Models\Repositorio;
use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Http\Models\ModeloDiagramatico
 *
 * @property int $codmodelo
 * @property string $nome
 * @property string $descricao
 * @property string $tipo
 * @property string $xml_modelo
 * @property int $codprojeto
 * @property int $codrepositorio
 * @property int $codusuario
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Http\Models\Repositorio $repositorio
 * @property-read \App\Http\Models\Projeto $projeto
 * @property-read \App\Http\Models\Regra $regras
 * @property-read \App\Http\Models\ObjetoDeFluxo $tarefas
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\ModeloDiagramatico whereCodmodelo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\ModeloDiagramatico whereCodorganizacao($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\ModeloDiagramatico whereCodprojeto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\ModeloDiagramatico whereCodusuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\ModeloDiagramatico whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\ModeloDiagramatico whereDescricao($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\ModeloDiagramatico whereNome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\ModeloDiagramatico whereTipo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\ModeloDiagramatico whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\ModeloDiagramatico whereXmlModelo($value)
 * @mixin \Eloquent
 */
class ModeloDiagramatico extends Model
{
    protected $connection = 'banco';
    protected $primaryKey = 'codmodelodiagramatico';
    protected $table = 'modelos_diagramaticos';
    protected $fillable = [
        'nome',
        'descricao',
        'xml_modelo',

        'codprojeto',
        'codrepositorio',
        'codusuario',

        'visibilidade',
        'publico',
        'tipo'
    ];


    public static function titulos()
    {
        return [
            'Modelos',
            'Ações'
        ];
    }

    public static function campos()
    {
        return [
            'Nome',
            'Descrição'
        ];
    }

    public static function types()
    {
        return [
            'text',
            'text'
        ];
    }

    public static function atributos()
    {
        return [
            'nome',
            'descricao',
            'codprojeto',
            'codrepositorio',
            'xml_modelo'

        ];

    }

//Instancia todas as posições de memória que serão exibidas no título
    public static function dados_objeto()
    {
        $dado = array();
        for ($indice = 0; $indice < 3; $indice++) {
            $dado[$indice] = new Dado();
        }
        return $dado;
    }

//Instancia somente os campos que serão exibidos no formulário e preenche os títulos da listagem
    public static function dados()
    {
        $campos = self::campos();
        $atributos = self::atributos();
        $dados = self::dados_objeto();
        $titulos = self::titulos();
        $types = self::types();
        //quantidade de atributos
        for ($indice = 0; $indice < 3; $indice++) {
            //quantidade do restante dos campos
            if ($indice < 2) {
                $dados[$indice]->campo = $campos[$indice];
                $dados[$indice]->tipo = $types[$indice];
                $dados[$indice]->titulo = $titulos[$indice];
            }
            $dados[$indice]->atributo = $atributos[$indice];


        }
        return $dados;
    }

//Relacionamentos
    public function projeto()
    {
        return $this->hasOne(Projeto::class, 'codprojeto', 'codprojeto');
    }

    public function repositorio()
    {
        return $this->hasOne(Repositorio::class, 'codrepositorio', 'codrepositorio');
    }

    public static function validacao()
    {
        return [
            'nome' => 'required',
            'descricao' => 'required'
        ];
    }


    protected static function boot()
    {
        parent::boot();


    }
    public static function get_modelo_default($nome_modelo)
    {
        $data = "
        <?xml version=\"1.0\" encoding=\"UTF-8\"?>
<bpmn:definitions xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xmlns:bpmn=\"http://www.omg.org/spec/BPMN/20100524/MODEL\" xmlns:bpmndi=\"http://www.omg.org/spec/BPMN/20100524/DI\" xmlns:dc=\"http://www.omg.org/spec/DD/20100524/DC\" id=\"Definitions_1om5q7p\" targetNamespace=\"http://bpmn.io/schema/bpmn\">
  <bpmn:collaboration id=\"Collaboration_1635u9x\">
    <bpmn:participant id=\"Participant_1r9kbtn\" name=\"".$nome_modelo."\" processRef=\"Process_1\" />
  </bpmn:collaboration>
  <bpmn:process id=\"Process_1\" isExecutable=\"false\">
    <bpmn:startEvent id=\"StartEvent_1\" />
  </bpmn:process>
  <bpmndi:BPMNDiagram id=\"BPMNDiagram_1\">
    <bpmndi:BPMNPlane id=\"BPMNPlane_1\" bpmnElement=\"Collaboration_1635u9x\">
      <bpmndi:BPMNShape id=\"Participant_1r9kbtn_di\" bpmnElement=\"Participant_1r9kbtn\">
        <dc:Bounds x=\"288\" y=\"118\" width=\"600\" height=\"250\" />
      </bpmndi:BPMNShape>
      <bpmndi:BPMNShape id=\"_BPMNShape_StartEvent_2\" bpmnElement=\"StartEvent_1\">
        <dc:Bounds x=\"344\" y=\"225\" width=\"36\" height=\"36\" />
      </bpmndi:BPMNShape>
    </bpmndi:BPMNPlane>
  </bpmndi:BPMNDiagram>
</bpmn:definitions>

        ";
        return $data;

    }

    public static function get_modelo_default1()
    {
        $data = "
        <?xml version=\"1.0\" encoding=\"UTF-8\"?>
<bpmn:definitions xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xmlns:bpmn=\"http://www.omg.org/spec/BPMN/20100524/MODEL\" xmlns:bpmndi=\"http://www.omg.org/spec/BPMN/20100524/DI\" xmlns:dc=\"http://www.omg.org/spec/DD/20100524/DC\" id=\"Definitions_141dzwv\" targetNamespace=\"http://bpmn.io/schema/bpmn\">
  <bpmn:process id=\"Process_1\" isExecutable=\"false\">
    <bpmn:startEvent id=\"StartEvent_1\" />
  </bpmn:process>
  <bpmndi:BPMNDiagram id=\"BPMNDiagram_1\">
    <bpmndi:BPMNPlane id=\"BPMNPlane_1\" bpmnElement=\"Process_1\">
      <bpmndi:BPMNShape id=\"_BPMNShape_StartEvent_2\" bpmnElement=\"StartEvent_1\">
        <dc:Bounds x=\"173\" y=\"102\" width=\"36\" height=\"36\" />
      </bpmndi:BPMNShape>
    </bpmndi:BPMNPlane>
  </bpmndi:BPMNDiagram>
</bpmn:definitions>
        ";
        return $data;

    }

    public function usuario()
    {
        return $this->hasOne(User::class, 'codusuario', 'codusuario');
    }
}
