<?php

namespace App\Http\Controllers\Panel\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\FinishCart;
use App\Models\Product;
use Barryvdh\DomPDF\Facade as PDF;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $data = Cart::where('uid', $request->session()->get('cart'))->get();
        $total = $data->sum('valor');
        return view('panel.admin.pages.produtos.cart', compact('data', 'total'));
        # code...
    }

    public function finalizar(Request $request)
    {
        $uid = $request->session()->get('cart');
        $cart = FinishCart::create([
            'uid' => $uid,
            'status' => 'finalizado'
        ]);
        $request->session()->forget('cart');

        $data = Cart::where('uid', $cart->uid)->get();
        $total = $data->sum('valor') - $data->sum('desc');
        $desconto = $data->sum('desc');
        return PDF::loadView('panel.admin.pages.produtos.cart_print', [
            'data' => $data,
            'desconto' => $desconto,
            'total' => $total,
            'cart' => $cart
        ])->stream();
       
        // return $pdf->download('product.pdf');
    }

    public function deleteItem($id)
    {
        $cart = Cart::find($id);
        $product = Product::where('id', $cart->product_id)->first();

        $product->update([
            'qtd' => $product->qtd + $cart->qtd
        ]);
        Cart::destroy($id);
        return redirect()->back()->with('success', 'Item removido do carrinho com sucesso.');
    }
}
