<?php

namespace App\Http\Controllers;
use App\Models\Medjudic;
use Illuminate\Http\Request;

class MedjudicController extends Controller
{
    public function index()
    {
        $mjdc = Medjudic::all();
        return view('welcome', ['mjdc' => $mjdc]);
    }
    
    public function store(Request $request)
    {
        // Tratamento de Arquivo
        $xml = $request->file('nfe');
        $extensaoArquivo = $xml->getClientOriginalExtension();
        if ($extensaoArquivo === 'xml') {

            // Obtendo os dados da XML passada no Request
            // É necessário especificar todo o caminho até o campo desejado do arquivo xml
            
            $obterDados = simplexml_load_file($xml);
            $NumProcJud = $obterDados->eFinanceira->evtMovOpFin->mesCaixa->movOpFin->Cambio->MedJudic->NumProcJud;
            $Vara = $obterDados->eFinanceira->evtMovOpFin->mesCaixa->movOpFin->Cambio->MedJudic->Vara;
            $SecJud = $obterDados->eFinanceira->evtMovOpFin->mesCaixa->movOpFin->Cambio->MedJudic->SecJud;
            $SubSecJud = $obterDados->eFinanceira->evtMovOpFin->mesCaixa->movOpFin->Cambio->MedJudic->SubSecJud;
            $dtConcessao = $obterDados->eFinanceira->evtMovOpFin->mesCaixa->movOpFin->Cambio->MedJudic->dtConcessao;

            // Inserindo no banco de dados
            $mjdc = new MedJudic;
            $mjdc->NumProcJud = $NumProcJud;
            $mjdc->Vara = $Vara;
            $mjdc->SecJud = $SecJud;
            $mjdc->SubSecJud = $SubSecJud;
            $mjdc->dtConcessao = $dtConcessao;
            $mjdc->save();

            return redirect('/')->with('msg', 'Dados cadastrados com sucesso.');
        }
        else {
            return redirect('/')->with('msg', 'Apenas arquivos XML são aceitos.');
        }
    }
}