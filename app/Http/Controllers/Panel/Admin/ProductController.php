<?php

namespace App\Http\Controllers\Panel\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Cart;
use App\Models\Product;
use Keygen\Keygen;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Product::orderby('created_at', 'desc')->paginate(30);
        $products = Product::orderby('name', 'asc')->pluck('name', 'id');
        return view('panel.admin.pages.produtos.index', compact('data', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel.admin.pages.produtos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $source = array('.', ',');
        $replace = array('', '.');
        $valor = str_replace($source, $replace, $request->get('valor'));
        Product::create([
            'name' => $request->get('name'),
            'desc' => $request->get('desc'),
            'qtd' => $request->get('qtd'),
            'valor' => $valor,
        ]);
        return redirect()->back()->with('success', 'Cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request)
    {
        $data = Product::orderby('created_at', 'desc')->paginate(50);
        return view('panel.admin.pages.produtos.search', compact('data'));
    }
    public function search(Request $request)
    {
        $cart = Cart::where('uid', $request->session()->get('cart'))->get();
        $total = $cart->sum('valor') - $cart->sum('desc');
        $desconto = $cart->sum('desc');

        $value = $request->get('value');
        $data = Product::where('name', 'like', '%' . $value . '%')->paginate(10);

        return view('panel.admin.pages.produtos.search', compact('data', 'cart', 'total', 'desconto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Product::find($id);
        return view('panel.admin.pages.produtos.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = Product::find($id);
        $source = array('.', ',');
        $replace = array('', '.');
        $valor = str_replace($source, $replace, $request->get('valor'));
        $data->update([
            'name' => $request->get('name'),
            'desc' => $request->get('desc'),
            'qtd' => $request->get('qtd'),
            'valor' => $valor,
        ]);
        return redirect()->back()->with('success', 'Editado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::destroy($id);
        return redirect()->back()->with('success', 'Deletado com sucesso!');
    }

    public function addItem($id, Request $request)
    {
        $product = Product::find($id);
        if ($product->qtd <= 0 || $request->get('qtd') > $product->qtd) {
            return redirect()->back()->with('error', 'Confira a quantidade de item em estoque!');
        }
        if ($request->session()->has('cart')) {
            $qtd = $request->get('qtd');
            if ($qtd <= 0) {
                return redirect()->back()->with('error', 'Informe a quantidade!');
            }
            $data = Cart::create([
                'uid' => $request->session()->get('cart'),
                'product_id' => $id,
                'valor' => $product->valor,
                'desc' => $request->get('desc'),
                'qtd' => $request->get('qtd')
            ]);
            $product->update([
                'qtd' => $product->qtd - $data->qtd
            ]);
            return redirect()->back()->with('success', 'Produto adicionado ao carrinho com sucesso!');
        } else {
            $key = Keygen::numeric(10)->generate();
            $request->session()->put('cart', $key);
            $data = Cart::create([
                'uid' => $key,
                'product_id' => $id,
                'valor' => $product->valor,
                'desc' => $request->get('desc'),
                'qtd' => $request->get('qtd')
            ]);
            return redirect()->back()->with('success', 'Produto adicionado ao carrinho com sucesso!');
        }
    }
}
