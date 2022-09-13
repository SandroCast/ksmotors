<?php

namespace App\Http\Controllers;

use Session;
use App\Models\Message;
use App\Models\User;
use App\Models\VendaProduto;
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

            $parceiro = 1;

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
    



















    public function home()
    {

        return view('chat.home');
    }
    public function index(Request $request)
    {
        $user = Auth::user();
        $novo = request('novo');

        if($novo){

            $novo = User::where([
                ['name', 'like', '%' .$novo. '%']

            ])->get();
            
        }

        return view('chat.index', compact('novo', 'user'));

    }

    public function load()
    {
        $user = Auth::user();

        $mensagens = Message::where([
            ['from', $user->id]

        ])->orwhere([
            ['to', $user->id]

        ])->orderBy('created_at', 'DESC')->get()->unique('duo');

        $visas = Message::where([
            ['duo', $mensagens->first()->duo],
            ['to', $user->id],
            ['visa','<', 1]
        ])->get();

        if(count($visas) > 0){
            foreach($visas as $visa){
                $visa->visa = 1;
                $visa->save();
            }
        }

        return view('chat.lista', compact('mensagens', 'user'));
    }

    public function conversas(Request $request, $id)
    {
        $idconversa = $id;
        $userlogado = Auth::user();
        $nome = Message::findOrFail($id);

        return view('chat.indexconversa', compact('idconversa', 'nome', 'userlogado'));
    }

    public function nova_conversa(Request $request, $id)
    {
        $userlogado = Auth::user();
        $parceiro = User::findOrFail($id);

        if($parceiro->id < $userlogado->id){
            $duo = $parceiro->id . '-' . $userlogado->id;
        }else{
            $duo = $userlogado->id . '-' . $parceiro->id;
        }

        $existemsg = Message::where([
            ['duo', $duo]
        ])->get();


        if(count($existemsg) > 0){

            return redirect('/chat/'.$existemsg->first()->id);
        }else{

            $novo = new Message;
            $novo->from = $userlogado->id;
            $novo->to = $parceiro->id;
            $novo->duo = $duo;
            $novo->content = 'Você iniciou uma nova conversa! :)';
            $novo->visa = 0;
            $novo->save();
    
            return redirect('/chat/'.$novo->id); 
        }

    }

    public function load_conversas(Request $request, $id) //-=======================================
    {
        $user = Auth::user();
        $amigo = Message::findOrFail($id);

        $mensagens = Message::where([
            ['duo', $amigo->duo]

        ])->get();

        $visas = Message::where([
            ['duo', $amigo->duo],
            ['to', $user->id],
            ['visa','<', 2]
        ])->get();

        if(count($visas) > 0){
            foreach($visas as $visa){
                $visa->visa = 2;
                $visa->save();
            }
        }

        return view('chat.conversa', compact('mensagens', 'user'));
    }


    public function update(Request $request, $id)
    {
        
        $user = Auth::user();
        $amigo = Message::findOrFail($id);
        $mensagem = Request('mensagem');

        if($mensagem){

            if($amigo->from == $user->id){
                $to = $amigo->to;
            }else{
                $to = $amigo->from;
            }

            if($to < $user->id){
                $duo = $to . '-' . $user->id;
            }else{
                $duo = $user->id . '-' . $to;
            }

            $novo = new Message;
            $novo->from = $user->id;
            $novo->to = $to;
            $novo->duo = $duo;
            $novo->content = $mensagem;
            $novo->visa = 0;

            $novo->save();
            
            return redirect('/chat/'.$id);

        }else{
            return redirect('/chat/'.$id);
        }
    }



    
}
