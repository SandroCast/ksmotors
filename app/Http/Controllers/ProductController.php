<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Favorite;
use App\Models\Like;
use App\Models\User;
use App\Models\FotoProduto;
use App\Models\VendaProduto;
use BaconQrCode\Renderer\Color\Rgb;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class ProductController extends Controller
{

    public function index()
    {
        $user = auth()->user();

        $search = request('search');

        if($user){
            $favoritos = Favorite::where('user_id', $user->id)->get();
        }else{
            $favoritos = 0;
        }

        if($search) {

            $products = Product::where([
                ['title', 'like', '%'.$search.'%']

            ])->orderBy('created_at', 'DESC')->get();

        } else {
            $products = Product::orderBy('created_at', 'DESC')->skip(0)->take(30)->get();
        }

        return view('produtos.index', ['favoritos' => $favoritos, 'products' => $products, 'search' => $search, 'user' => $user]);  

    }

    public function favorito(Request $request)
    {
        $user = auth()->user();

        $produtos = Favorite::where('user_id', $user->id)->get();

        return view('produtos.favoritos', compact('user', 'produtos'));
    }

    public function favorito_remover($id)
    {
        Favorite::findOrFail($id)->delete();

        return redirect('/favorito')->with('msg', 'Produto removidodos favoritos com sucesso!');

    }

    public function create()
    {
        $user = auth()->user();

        if($user->adms > 0){
            return view('produtos.create', ['user' => $user]);
        }else{
            return redirect('/');
        }

    }

    public function store(Request $request)
    {
        $user = auth()->user();

        $product = new Product;

        $product->title = $request->title;
        $product->description = $request->description;
        $product->preco = $request->preco;
        $product->user_id = $user->id;
        $product->save();

        //Image Upload
        if($request->image) {

            foreach($request['image'] as $imagem){

                $requestImage = $imagem;
                $extension = $requestImage->extension();
                $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
                $requestImage->move(public_path('img/produtos'), $imageName);

                $fotoProduto = new FotoProduto;
                $fotoProduto->id_produto = $product->id;
                $fotoProduto->path = $imageName;
                $fotoProduto->save();

            }

        }

        return redirect('/product/edit/'.$product->id)->with('msg', 'Produto adicionado com sucesso!');

      //
    }

    public function show($id)
    {
        $user = auth()->user();

        $qtdeVenda = VendaProduto::where('id_produto', $id)->where('status', 'Finalizada')->count();
        $fotos = FotoProduto::where('id_produto', $id)->get();
        $produto = Product::findOrFail($id);
        
        return view('produtos.show', compact('user', 'fotos', 'produto', 'qtdeVenda'));

    }

    public function edit($id)
    {
        $user = auth()->user();
        $product = Product::findOrFail($id);

        return view('produtos.edit', ['user' => $user, 'product' => $product]);
    }

    public function update(Request $request, $id)
    {
        $user = auth()->user();
        
        //Image Upload
        if($request->image) {

            $apagarFotos  = FotoProduto::where('id_produto', $request->id)->get();
            foreach($apagarFotos as $apagarFoto){
                $apagarFoto->delete();
            }

            foreach($request['image'] as $imagem){

                $requestImage = $imagem;
                $extension = $requestImage->extension();
                $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
                $requestImage->move(public_path('img/produtos'), $imageName);

                $fotoProduto = new FotoProduto;
                $fotoProduto->id_produto = $request->id;
                $fotoProduto->path = $imageName;
                $fotoProduto->save();

            }

        }

        $product = Product::findOrFail($request->id);
        $product->title = $request->title;
        $product->description = $request->description;
        $product->preco = $request->preco;
        $product->token_pagamento = $request->token_pagamento;
        $product->user_id = $user->id;
        $product->save();

        return redirect('/produtos')->with('msg', 'Produto editado com sucesso!');

    }

    public function destroy($id)
    {
        $likes = Like::where('product_id', $id)->get();
        foreach($likes as $like){
            $like->delete();
        }

        $favorites = Favorite::where('product_id', $id)->get();
        foreach($favorites as $favorite){
            $favorite->delete();
        }

        $fotos = FotoProduto::where('id_produto', $id)->get();
        foreach($fotos as $foto){
            $foto->delete();
        }

        Product::findOrFail($id)->delete();

        return redirect('/produtos')->with('msg', 'Produto excluido com sucesso!');
    }

    public function dashboard()
    {
        $user = auth()->user();

        if($user->adms > 0){
            $products = Product::all();
            return view('produtos.dashboard', ['user' => $user, 'products' => $products]);
        }else{
            return redirect('/');
        }


    }

    public function joinProduct($id)
    {
        $array = array();

        $user = auth()->user();

        $user->productsAsParticipant()->attach($id);

        $curtidas = Like::where('product_id', $id)->get();

        $array['qtdeCurtidas'] = count($curtidas);

        return response()->json($array);

    }

    public function favorito_novo($id)
    {
        $user = auth()->user();

        $novo = New Favorite;
        $novo->product_id = $id;
        $novo->user_id = $user->id;

        $novo->save();

    }

    public function usuarios()
    {
        $user = auth()->user();

        if($user->adms > 1){

            $users = User::where('id', '>', 0)->orderBy('adms', 'desc')->get();

            return view('usuarios', compact('users', 'user'));
        }else{
            return redirect('/');
        }

    }

    public function usuario_acao_promover($id, Request $request)
    {
        $user = User::findOrFail($id);

        if($user->adms < 2){
            $user->adms = $user->adms + 1;
            $user->save();
        }

        return redirect()->back();

    }
    public function usuario_acao_rebaixar($id, Request $request)
    {
        $user = User::findOrFail($id);

        if($user->adms > 0){
        $user->adms = $user->adms - 1;
        $user->save();
        }

        return redirect()->back();

    }

    public function removeFotoPerfil($id)
    {
        $user = auth()->user();

        if($id == $user->id){

            $update = User::findOrFail($id);
            $update->profile_photo_path = null;
            $update->save();

            return redirect()->back();
        }else{
            return redirect('/');
        }
    }


    public function emailEnvia()
    {

        $codigo = rand(1000, 9999);
        $email = '';
        
        $this->emailVerifica($codigo, $email);



        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions

        try {

            $mail->CharSet = 'UTF-8';
            //Server settings
            $mail->SMTPDebug = 0;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            //$mail->isMail();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'sandrocastro2555@gmail.com';                 // SMTP username
            $mail->Password = 'phrwobvfwhhsmyzm';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom('sandrocastro2555@gmail.com', '3DPrintEvolution');

            $mail->addAddress($email);               // Name is optional
            //$mail->addReplyTo('info@example.com', 'Information');
            //$mail->addCC('cc@example.com');
            // $mail->addBCC('fabio@oncore.com.br');
            // $mail->AddAttachment($nome_excel);
            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Verificação de Email';
            $mail->Body    = '<p>Olá,</p>

            <p>Seu código de verificação é:</p>
            <br>
            <h1 style="color: green; font-weight: bold; text-align: center; font-size: 50px;">'.$codigo.'</h1>';

            //web$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();


        } catch (Exception $e) {


            echo '<br>Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }   


    }


    public function time($id)
    {

        if($id <= 300){
            $tempo = date('i:s', 300 - $id);
        }else{
            $tempo = date('i:s', 300 - 300);
        } 

        return $tempo;

    }

    public function cancela_cadastro(Request $request)
    {
        $userID = auth()->user();
        $user = User::findOrFail($userID->id);

        if($user->email_verificado == null){

            if(isset($request->codigo_1)){

                if($request->codigo_1.$request->codigo_2.$request->codigo_3.$request->codigo_4 == $user->cod_verificacao){
                    $user->email_verificado = 1;
                    $user->save();
                }else{
                    
                    if($user->erro_verificacao == 2){
                        $user->delete();
                        return redirect('/register');
                    }else{
                        $user->erro_verificacao = $user->erro_verificacao + 1;
                        $user->save();
                    }

                }
            }else{
                $user->delete();
                return redirect('/register');
            }
        }

        return redirect('/');

    }




    public function pedidosAbertos(Request $request)
    {
        $user = auth()->user();

        if($user->adms > 0){

            $pedidos = VendaProduto::where('id', '>', 0)->orderBy('id', 'desc')->get();

            return view('produtos.pedidos_abertos', compact('user', 'pedidos'));
        }else{
            return redirect('/');
        }

    }



    public function meusPedidos(Request $request)
    {
        $user = auth()->user();

        $pedidos = VendaProduto::where('id_user', $user->id)->orderBy('id', 'desc')->get();

        return view('produtos.meus_pedidos', compact('user', 'pedidos'));

    }

    public function autorizaPedidos($id, Request $request)
    {
        $user = auth()->user();

        if($user->adms > 0){
            $pedido = VendaProduto::findOrFail($id);
            $pedido->status = 'Aguardando Pagamento';
            $pedido->save();

            return redirect()->back()->with('msg', 'Compra autorizada com sucesso!');
        }else{
            return redirect('/');
        }


    }

    public function cancelaPedidos($id, Request $request)
    {
        $user = auth()->user();
        $pedido = VendaProduto::findOrFail($id);

        if($user->adms > 0 || $pedido->id_user == $user->id){
            $pedido->status = 'Cancelado';
            $pedido->save();

            return redirect()->back()->with('msg', 'Pedido cancelado com sucesso!');
        }else{
            return redirect('/');
        }


    }



    public function pagamentoAprovado($id, Request $request)
    {
        $user = auth()->user();

        $pedido = VendaProduto::where('status', 'Aguardando Pagamento')->where('id_produto', $id)->where('id_user', $user->id)->first();
    
        if($pedido){
            $pedido->status = 'Análisando Pagamento';
            $pedido->save();
        }

        return redirect('/meus/pedidos');

    }

    public function analizarPagamentoAprovado($id, Request $request)
    {
        $user = auth()->user();

        $pedido = VendaProduto::findOrFail($id);

        if($user->id == $pedido->id_user){
            $pedido->status = 'Análisando Pagamento';
            $pedido->save();
        }

        return redirect()->back();

    }
    
    public function pagamentoRecebido($id, Request $request)
    {
        $user = auth()->user();
        $pedido = VendaProduto::findOrFail($id);

        if($user->adms > 0){
            $pedido->status = 'Preparando Envio';
            $pedido->save();

        }

        return redirect()->back();

    }

    public function pedidoaCaminho($id, Request $request)
    {
        $user = auth()->user();
        $pedido = VendaProduto::findOrFail($id);

        if($user->adms > 0){
            $pedido->status = 'A Caminho';
            $pedido->save();

        }

        return redirect()->back();

    }

    public function pedidoEntregue($id, Request $request)
    {
        $user = auth()->user();
        $pedido = VendaProduto::findOrFail($id);

        if($user->adms > 0){
            $pedido->status = 'Entregue';
            $pedido->save();

        }

        return redirect()->back();

    }
    
    
    


}
