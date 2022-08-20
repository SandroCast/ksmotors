<?php

namespace App\Http\Controllers;

use Session;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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


        if(Session::has('conversaAberta')){

            $amigo = Message::findOrFail(Session::get('conversaAberta'));
    
            $mensagensAbertas = Message::where([
                 ['duo', $amigo->duo]

            ])->get();

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
