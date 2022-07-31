<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Mercadoria;
use App\Models\Categoria;
use App\Models\Lote;

class MercadoriasController extends Controller
{
    // Index - Home
    public function index()
    {
        return view('welcome');
    }
    
    // Form de Criação
    public function create(){
        $lote = Lote::whereNull('fk_mercadoria')->get(); // Apenas lotes que não estejam preenchidos com fk_mercadoria
        return view('form', ['lote' => $lote]);
    }

    // Form de Edição
    public function edit($id){
        $mercadoria = Mercadoria::findOrFail($id);
        $lote = Lote::all();
        return view('formEdit', ['mercadoria' => $mercadoria, 'lote' => $lote]);
    }
    
    // Inserir Mercadoria
    public function store(Request $request, Mercadoria $mercadoria)
    {
        if($request->codigo){
            $mercadoria->create($request->all())->save();
        }else{
            // Definindo o valor do código (int)
            // com base no último registro do banco
            if($ultimaMercadoriaRegistrada = Mercadoria::orderBy('id', 'desc')->first()){
                $code = $ultimaMercadoriaRegistrada->codigo + 1;
            }else{
                $code = 1;
            }
            
            $mercadoria = new Mercadoria;
            $mercadoria->codigo = $code;
            $mercadoria->value = $request->value;
            $mercadoria->title = $request->title;
            $mercadoria->fk_categoria_1 = $request->fk_categoria_1;
            $mercadoria->fk_categoria_2 = $request->fk_categoria_2;
            $mercadoria->fk_categoria_3 = $request->fk_categoria_3;
            $mercadoria->id = $request->id; // Se estiver vazio, será auto-increment

            $mercadoria->save();
        }

        // Enviando ID da mercadoria para o lote
        if($request->loteSelecionado){
            $lote = Lote::findOrFail($request->loteSelecionado);
            $lote->fk_mercadoria = $mercadoria->id;
            $lote->save();
        }
        return redirect('/')->with('msg', 'Parabéns! Mercadoria cadastrada com sucesso!');
    }

    // Update mercadoria
    public function update(Request $request){
        if(Mercadoria::findOrFail($request->id)->update($request->all())){
            return redirect('/')->with('msg', "Parabéns! Mercadoria foi atulizada com sucesso.");
        }else{
            return redirect('/')->with('msg', "Erro. Tente novamente.");
        }
    }
    
    // Actions para as requisições da Fech API

    // Buscando Mercadorias
    public function buscarMercadorias(){
        return response()->json(['dados' => Mercadoria::all()]);        
    }

    // Buscando Categorias
    public function buscarCategorias(){
        return response()->json(['dados' => Categoria::all()]);        
    }

    // Deletar mercadoria
    public function delete($id){
        if(Mercadoria::findOrFail($id)->delete()){
            dd('dado recebido');
            return response()->json(['resposta' => "Parabéns! Mercadoria foi excluída com sucesso."]);
        }else{
            return response()->json(['resposta' => "Erro! Não foi possível excluir mercadoria."]);
        }
    }

    // XML Upload
    public function storexml(Request $request)
    {
        // Tratamento de Arquivo
        $xml = $request->file('nfe');
        $extensaoArquivo = $xml->getClientOriginalExtension();
        if ($extensaoArquivo === 'xml') {

            // Obtendo os dados da XML passada no Request
            // É necessário especificar todo o caminho até o campo desejado do arquivo xml
            // Inserindo no banco de dados

            $obterDados = simplexml_load_file($xml);

            $mercadoria = new Mercadoria;
            $mercadoria->title = $obterDados->mercadorias->title;
            $mercadoria->value = $obterDados->mercadorias->value;
            $mercadoria->codigo = $obterDados->mercadorias->codigo;
            $mercadoria->fk_categoria_1 = $obterDados->mercadorias->fk_categoria_1;            

            if($mercadoria->save()){
                return response()->json(['resposta' => "Parabéns! Mercadoria foi cadastrada com sucesso."]);
            }else{
                return response()->json(['resposta' => "Erro! Não foi possível cadastrar mercadoria."]);
            }
        }
        else {
            return response()->json(['resposta' => "Erro! Apenas arquivos XML são aceitos."]);
        }
    }
}