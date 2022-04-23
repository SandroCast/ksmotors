<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Favorite;
use App\Models\User;

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

    public function favoritos()
    {
        $user = auth()->user();

        $produtos = Favorite::where('user_id', $user->id)->get();

        return view('produtos.favoritos', compact('user', 'produtos'));
    }

    public function favorito_remover($id)
    {
        Favorite::findOrFail($id)->delete();

        return redirect('/product/favorite')->with('msg', 'Produto removidodos favoritos com sucesso!');

    }

    public function create()
    {
        $user = auth()->user();

        return view('produtos.create', ['user' => $user]);
    }

    public function store(Request $request)
    {

        $product = new Product;

        $product->title = $request->title;
        $product->description = $request->description;
        $product->preco = $request->preco;

        //Image Upload
        if($request->hasFile('image') && $request->file('image')->isValid()) {

            $requestImage = $request->image;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $requestImage->move(public_path('img/produtos'), $imageName);

            $product->image = $imageName;

        }

        $user = auth()->user();
        $product->user_id = $user->id;

        $product->save();

        return redirect('/product/dashboard')->with('msg', 'Produto adicionado com sucesso!');

      //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $user = auth()->user();
        $product = Product::findOrFail($id);

        return view('produtos.edit', ['user' => $user, 'product' => $product]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        //Image Upload
        if($request->hasFile('image') && $request->file('image')->isValid()) {

            $requestImage = $request->image;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $requestImage->move(public_path('img/produtos'), $imageName);

            $data['image'] = $imageName;

        }

        Product::findOrFail($request->id)->update($data);

        return redirect('/product/dashboard')->with('msg', 'Produto editado com sucesso!');

    }

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();

        return redirect('/product/dashboard')->with('msg', 'Produto excluido com sucesso!');
    }

    public function dashboard()
    {
        $user = auth()->user();
        $products = Product::all();

        return view('produtos.dashboard', ['user' => $user, 'products' => $products]);
    }

    public function joinProduct($id)
    {
        $user = auth()->user();

        $user->productsAsParticipant()->attach($id);

        return redirect('/')->with('click', $id);

    }

    public function favorito_novo($id)
    {
        $user = auth()->user();

        $novo = New Favorite;
        $novo->product_id = $id;
        $novo->user_id = $user->id;

        $novo->save();

        return redirect('/')->with('click', $id);

    }





}
