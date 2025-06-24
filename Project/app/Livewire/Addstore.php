<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Cart;
use App\Models\category;
use App\Models\Hold_order;
use App\Models\customer;
use App\Models\Supplier;
use App\Models\addstorecart;

class Addstore extends Component

{
    public $orders, $products, $suppliers = [], $product_code, $massage = '', $addstorecart, $qty, $holdlists, $qtyprice, $full_price;

    // public $product_code= ""  ;
    public $pay_money;
    public $balance;
    public $cashtxt;
    public $banktxt;
    public $credittxt;

    public function mount()
    {
        $this->suppliers = Supplier::all();
        $this->products = Product::all();
        $this->addstorecart = addstorecart::where('user_id', auth()->user()->id)->get();
    }

    public function InsertoCart()
    {
        $countProduct = Product::where('barcode', $this->product_code)->first();  // this change id
        $qtyadd = $this->qty;
        $qtyprice = $this->qtyprice;
        if (!$countProduct) {
            return session()->flash('error', 'Product not found');
            // return $this->massage ='Product not found';
        }


        $countCartProduct = addstorecart::where('barcode', $this->product_code)->where('user_id', auth()->user()->id)->count();
        $cartProductprice = addstorecart::where('barcode', $this->product_code)->where('user_id', auth()->user()->id)->first();
        if ($countCartProduct > 0 && $cartProductprice->product_price == $qtyprice && $qtyprice && $qtyadd) {
            // $this->IncrementQty($this->product_code);
            $carts = addstorecart::where("barcode", $this->product_code)->where('user_id', auth()->user()->id)->first();
            $carts->increment('product_qty', $qtyadd);
            $total_price = $carts->product_price *  $carts->product_qty;
            
            $carts->update(['total_price' => $total_price]);
            $this->mount();
            return session()->flash('success', 'Product ' . $carts->product->product_name . ' already exist in cart add quantity');
        }  
        
        else if ($countCartProduct > 0 && $cartProductprice->product_price == $qtyprice && !$qtyprice && !$qtyadd) {
            // $this->IncrementQty($this->product_code);
            $carts = addstorecart::where("barcode", $this->product_code)->where('user_id', auth()->user()->id)->first();
            $carts->increment('product_qty', 1);
            $total_price = $carts->product_price *  $carts->product_qty;
            
            $carts->update(['total_price' => $total_price]);
            $this->mount();
            return session()->flash('success', 'Product ' . $carts->product->product_name . ' already exist in cart add quantity');
        }



        
          else if (!$qtyprice && !$qtyadd) {
            $add_to_cart = new addstorecart;
            $add_to_cart->product_id = $countProduct->id;
            $add_to_cart->barcode = $countProduct->barcode;
            $add_to_cart->product_qty = 1;
            $add_to_cart->product_price = 0;
            $add_to_cart->total_price = $qtyadd * 0;
            $add_to_cart->user_id = auth()->user()->id;
            $add_to_cart->save();
        } 
        else if(!$qtyprice){
            $add_to_cart = new addstorecart;
            $add_to_cart->product_id = $countProduct->id;
            $add_to_cart->barcode = $countProduct->barcode;
            $add_to_cart->product_qty = $qtyadd;
            $add_to_cart->product_price = 0;
            $add_to_cart->total_price = $qtyadd * 0;
            $add_to_cart->user_id = auth()->user()->id;
            $add_to_cart->save();
        }else {
            $add_to_cart = new addstorecart;
            $add_to_cart->product_id = $countProduct->id;
            $add_to_cart->barcode = $countProduct->barcode;
            $add_to_cart->product_qty = $qtyadd;
            $add_to_cart->product_price = $qtyprice;
            $add_to_cart->total_price = $qtyadd * $qtyprice;
            $add_to_cart->user_id = auth()->user()->id;
            $add_to_cart->save();
            // $this->mount();

            // $this->productIncart->prepend($add_to_cart);
            // $this->product_code = "";
        }


        $this->mount();
        return session()->flash('success', 'Product Added succcessfully');
        // return $this->massage ="Product Added succcessfully";
        dd($countProduct);
    }

    public function IncrementQty($cartId)
    {
        
        $carts = addstorecart::find($cartId);
        $carts->increment('product_qty', 1);
        $total_price = $carts->product_price *  $carts->product_qty;
        $carts->update(['total_price' => $total_price]);
        $this->mount();
    }

    public function DecrementQty($cartId)
    {
        $carts = addstorecart::find($cartId);
        if ($carts->product_qty == 0) {
            return session()->flash('info', 'Product' . $carts->product->name . 'Quantity can be less than 1,add quantity or remove in cart.');
        }
        $carts->decrement('product_qty', 1);
        $total_price = $carts->product_price *  $carts->product_qty;
        $carts->update(['total_price' => $total_price]);
        $this->mount();
    }

    public function removeProduct($cartId)
    {
        $deleteCart = addstorecart::find($cartId);
        $deleteCart->delete();
        // $this->massage = "Product removed from Cart";
        $this->mount();

        return session()->flash('success', 'Product' . $deleteCart->product->name . 'removed from cart');
    }


    public function render()
    {
        return view('livewire.addstore');
    }
}
