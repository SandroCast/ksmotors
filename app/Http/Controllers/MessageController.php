<?php

namespace App\Http\Controllers;

use Session;
use App\Models\Message;
use App\Models\User;
use App\Models\VendaProduto;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Foreach_;

class MessageController extends Controller
{

	public function apiMensagens(Request $request)
    {
        $array = array();

        $user = Auth::user();

        $mensagens = Message::where([
            ['from', $user->id]

        ])->orwhere([
            ['to', $user->id]

        ])->orderBy('created_at', 'DESC')->get()->unique('duo');

        if($mensagens && count($mensagens) > 0){

            foreach ($mensagens as $mensagem){

                if($mensagem->userfrom->name == $user->name){
                    $array['conversas'][] = $mensagem->id.' '.$mensagem->userto->name;
                }else{
                    $array['conversas'][] = $mensagem->id.' '.$mensagem->userfrom->name;
                }

            }

        }

        $array['naoVisualizada'] = $mensagens = Message::where('to', $user->id)->where('visa', 0)->count();

        if(Session::has('conversaAberta')){

            $amigo = Message::findOrFail(Session::get('conversaAberta'));
    
            $mensagensAbertas = Message::where([
                 ['duo', $amigo->duo]

            ])->get();

            if($mensagensAbertas->first()->from == $user->id){
                $array['conversaAbertaNome'] = $mensagensAbertas->first()->userto->name;
            }else{
                $array['conversaAbertaNome'] = $mensagensAbertas->first()->userfrom->name;
            }

            foreach ($mensagensAbertas as $mensagensAberta){
                $array['conversaAberta'][] = $mensagensAberta;
            }

        }

		return response()->json($array);

	}


    public function apiCarregaMensagens($id)
    {

        // if(Session::has('conversaAberta')){
        //     Session::forget('conversaAberta');
        // }
        Session::put('conversaAberta', $id);
        //Session::get('conversaAberta');

    }

    public function apiEnviaMensagens(Request $request)
    {

        $userlogado = Auth::user();

        if(Message::findOrFail(Session::get('conversaAberta'))->from == $userlogado->id){
            $parceiro = Message::findOrFail(Session::get('conversaAberta'))->userto->id;
        }else{
            $parceiro = Message::findOrFail(Session::get('conversaAberta'))->userfrom->id;
        }

        if($parceiro < $userlogado->id){
            $duo = $parceiro . '-' . $userlogado->id;
        }else{
            $duo = $userlogado->id . '-' . $parceiro;
        }

        $novo = new Message;
        $novo->from = $userlogado->id;
        $novo->to = $parceiro;
        $novo->duo = $duo;
        $novo->content = $request->conteudoMensagem;
        $novo->visa = 0;
        $novo->save();


    }


    public function apiVisualizaMensagens()
    {
        $userlogado = Auth::user();

        $mensagens = Message::where('to', $userlogado->id)->where('visa', 0)->get();

        foreach ($mensagens as $mensagem) {
            $mensagem->visa = 1;
            $mensagem->save();
        }

    }


    
    public function apiIniciaConversa($id)
    {
        $userlogado = Auth::user();

        $verificaDuplicatas = VendaProduto::where('id_produto', $id)->where('id_user', $userlogado->id)->where('status', 'Em análise')->first();

        if(!$verificaDuplicatas){

            $produto = Product::findOrFail($id);

            if($produto->user->adms > 0){
                $parceiro = $produto->user_id;
            }else{
                $parceiro = 1;
            }

            if($parceiro < $userlogado->id){
                $duo = $parceiro . '-' . $userlogado->id;
            }else{
                $duo = $userlogado->id . '-' . $parceiro;
            }

            $pedido = new VendaProduto;
            $pedido->id_produto = $id;
            $pedido->id_user = $userlogado->id;
            $pedido->status = 'Em análise';
            $pedido->save();

            if($pedido->id < 10){
                $n = '0000'.$pedido->id;
            }elseif($pedido->id < 100){
                $n = '000'.$pedido->id;
            }elseif($pedido->id < 1000){
                $n = '00'.$pedido->id;
            }elseif($pedido->id < 10000){
                $n = '0'.$pedido->id;
            }else{
                $n = $pedido->id;
            }

            $novo = new Message;
            $novo->from = $userlogado->id;
            $novo->to = $parceiro;
            $novo->duo = $duo;
            $novo->content = 'PEDIDO: '.$n;
            $novo->visa = 0;
            $novo->save();

        }


    }
    





    
}
