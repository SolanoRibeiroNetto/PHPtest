<?php

namespace App\Http\Controllers;

use App\Models\cep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class contatoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('contato');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     $this->validate($request, [
    //         'email' => 'required|email',
    //         'cep' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:8|max:8',
    //         'endereco' => 'required',
    //         'numero'=>'required',
    //         'complemento' => 'required',
    //         'cidade' => 'required',
    //         'estado' => 'required'
    //      ]);





    //     dd($request->endereco);
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function buscaCep(Request $request)
    {

        $cep = $request->cep;
        $cepBanco = cep::where('cep', $cep)->first();

        if(!empty($cepBanco)){

            $cepBanco = json_encode($cepBanco);

            return [
                'status' => 200,
                'msg' => 'sucess',
                'data' => $cepBanco
            ];

        }else{

            $url = 'https://viacep.com.br/ws/'.$cep.'/json/';
            $response = Http::get($url);

            if($response->clientError()){

                return [
                    'status' => 400,
                    'msg' => 'erro',
                    'data' => []
                ];
            }

            $cep = $response->json();
            $aux = explode('-', $cep['cep']);

            $cep['cep'] = $aux[0].$aux[1];

            $cepBanco = new cep();
            $cepBanco->cep = $cep['cep'];
            $cepBanco->logradouro = $cep['logradouro'];
            $cepBanco->complemento = $cep['complemento'];
            $cepBanco->bairro = $cep['bairro'];
            $cepBanco->localidade = $cep['localidade'];
            $cepBanco->uf = $cep['uf'];
            $cepBanco->save();

            return [
                'status' => 200,
                'msg' => 'sucess',
                'data' => $response->json()
            ];

        }
 
    }
}
