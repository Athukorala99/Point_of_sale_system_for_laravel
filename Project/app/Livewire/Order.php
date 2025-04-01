<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Cart;
use LengthException;
use App\Models\customer;
use App\Models\Hold_order;
use App\Models\Deleteitem;

class Order extends Component
{
    public $orders, $products,$customers = [], $product_code, $massage = '', $productIncart, $qty ,$holdlists;

    // public $product_code= ""  ;
    public $pay_money;
    public $balance;
    public $cashtxt;
    public $banktxt;
    public $credittxt;

    public function mount()
    {
        $this->customers= customer::all();
        $this->products = Product::all();
        $this->productIncart = Cart::where('user_id',auth()->user()->id)->get();
        $this->holdlists = Hold_order::where('user_id',auth()->user()->id)->get();
    }
    public function InsertoCart_wholesale()
    {
        $countProduct = Product::where('barcode', $this->product_code)->first();  // this change id
        $qtyadd = $this->qty;
        if (!$qtyadd) {
            //scale product filter
            if (strlen($this->product_code) == 12) {
                // Get the first 7 characters of the barcode
                $firstPart = substr($this->product_code, 0, 7);

                // Get the last 5 characters and calculate the percentage
                $lastPart = substr($this->product_code, 7, 5);

                $kilogram = substr($lastPart, 0, 2);
                $grame = substr($lastPart, 2, 5);
                $percentage = $kilogram . '.' . $grame;

                // Format the message to display both parts
                if (!$firstPart) {
                    return session()->flash('error', 'Product not found');
                }
                $countCartProduct = Cart::where('barcode', $firstPart)->where('user_id', auth()->user()->id)->count();
                if ($countCartProduct > 0) {

                    // $this->IncrementQty($this->product_code);
                    $carts = Cart::where('barcode', $firstPart)->where('user_id', auth()->user()->id)->first();

                    $carts->increment('product_qty', $percentage);
                    $updatePrice = $carts->product_qty * $carts->product->wholesale_price;
                    $updatediscount = $carts->product_qty * ($carts->product->price - $carts->product->wholesale_price);
                    $carts->update(['product_price' => $updatePrice,'discount' => $updatediscount]);
                    $this->mount();
                    return session()->flash('success', 'Product ' . $carts->product->product_name . ' already exist in cart add quantity');
                } else {
                    $product = Product::where('barcode', $firstPart)->first();
                    if (!$product) {
                        return session()->flash('error', 'Product not found');
                    }
                    $add_to_cart = new Cart;
                    $add_to_cart->product_id = $product->id;
                    $add_to_cart->barcode = $firstPart;
                    $add_to_cart->product_qty = $percentage;
                    $add_to_cart->product_price = (($product->wholesale_price) * $percentage);
                    $add_to_cart->user_id = auth()->user()->id;
                    $add_to_cart->discount = $product->price - $product->wholesale_price;
                    $add_to_cart->save();
                    // $this->mount();




                    $this->productIncart->prepend($add_to_cart);
                    // $this->product_code = "";
                }
            } else {
                if (!$countProduct) {
                    return session()->flash('error', 'Product not found');
                    // return $this->massage ='Product not found';
                }
                $countCartProduct = Cart::where('barcode', $this->product_code)->where('user_id', auth()->user()->id)->count();
                if ($countCartProduct > 0) {
                    // $this->IncrementQty($this->product_code);
                    $carts = Cart::where("barcode", $this->product_code)->where('user_id', auth()->user()->id)->first();
                    $carts->increment('product_qty', 1);
                    $updatePrice = $carts->product_qty * $carts->product->wholesale_price;
                    $updatediscount = $carts->product_qty * ($carts->product->price - $carts->product->wholesale_price);
                    $carts->update(['product_price' => $updatePrice,'discount' => $updatediscount]);
                    $this->mount();
                    return session()->flash('success', 'Product ' . $carts->product->product_name . ' already exist in cart add quantity');
                } else {
                    $add_to_cart = new Cart;
                    $add_to_cart->product_id = $countProduct->id;
                    $add_to_cart->barcode = $countProduct->barcode;
                    $add_to_cart->product_qty = 1;
                    $add_to_cart->product_price = $countProduct->wholesale_price;
                    $add_to_cart->user_id = auth()->user()->id;
                    $add_to_cart->discount = $countProduct->price - $countProduct->wholesale_price;
                    $add_to_cart->save();
                    // $this->mount();




                    $this->productIncart->prepend($add_to_cart);
                    // $this->product_code = "";
                }
            }
        } else {
            if (strlen($this->product_code) == 12) {
                // Get the first 7 characters of the barcode
                $firstPart = substr($this->product_code, 0, 7);

                // Get the last 5 characters and calculate the percentage
                $lastPart = substr($this->product_code, 7, 5);

                $kilogram = substr($lastPart, 0, 2);
                $grame = substr($lastPart, 2, 5);
                $percentage = $kilogram . '.' . $grame;

                // Format the message to display both parts
                //  $message = "Product: " . $percentage . " | Percentage: " . ( $lastPart) ;

                // Return success message with the processed barcode
                // return session()->flash('success', $message);
                if (!$firstPart) {
                    return session()->flash('error', 'Product not found');
                }
                $countCartProduct = Cart::where('barcode', $firstPart)->where('user_id',auth()->user()->id)->count();
                if ($countCartProduct > 0) {

                    // $this->IncrementQty($this->product_code);
                    $carts = Cart::where('barcode', $firstPart)->where('user_id',auth()->user()->id)->first();

                    $carts->increment('product_qty', ($percentage * $qtyadd));
                    $updatePrice = $carts->product_qty * $carts->product->wholesale_price;
                    $updatediscount = $carts->product_qty * ($carts->product->price - $carts->product->wholesale_price);
                    $carts->update(['product_price' => $updatePrice,'discount' => $updatediscount]);
                    $this->mount();
                    return session()->flash('success', 'Product ' . $carts->product->product_name . ' already exist in cart add quantity');
                } else {
                    $product = Product::where('barcode', $firstPart)->first();
                    if (!$product) {
                        return session()->flash('error', 'Product not found');
                    }
                    $add_to_cart = new Cart;
                    $add_to_cart->product_id = $product->id;
                    $add_to_cart->barcode = $firstPart;
                    $add_to_cart->product_qty = ($percentage * $qtyadd);

                    $add_to_cart->product_price = (($product->wholesale_price) * ($percentage * $qtyadd));

                    $add_to_cart->user_id = auth()->user()->id;
                    $add_to_cart->discount = ($product->price - $product->wholesale_price)*$add_to_cart->product_qty;
                    $add_to_cart->save();
                    // $this->mount();




                    $this->productIncart->prepend($add_to_cart);
                    // $this->product_code = "";
                }
            } else {
                if (!$countProduct) {
                    return session()->flash('error', 'Product not found');
                    // return $this->massage ='Product not found';
                }
                $countCartProduct = Cart::where('barcode', $this->product_code)->where('user_id',auth()->user()->id)->count();
                if ($countCartProduct > 0) {
                    // $this->IncrementQty($this->product_code);
                    $carts = Cart::where("barcode", $this->product_code)->where('user_id',auth()->user()->id)->first();
                    $carts->increment('product_qty', $qtyadd);
                    $updatePrice = $carts->product_qty * $carts->product->wholesale_price;
                    $updatediscount = $carts->product_qty * ($carts->product->price - $carts->product->wholesale_price);
                    $carts->update(['product_price' => $updatePrice,'discount' => $updatediscount]);
                    $this->mount();
                    return session()->flash('success', 'Product ' . $carts->product->product_name . ' already exist in cart add quantity');
                } else {
                    $add_to_cart = new Cart;
                    $add_to_cart->product_id = $countProduct->id;
                    $add_to_cart->barcode = $countProduct->barcode;
                    $add_to_cart->product_qty = $qtyadd;
                    $add_to_cart->product_price = ($countProduct->wholesale_price * $qtyadd);
                    $add_to_cart->user_id = auth()->user()->id;
                    $add_to_cart->discount = ($countProduct->price - $countProduct->wholesale_price)*$qtyadd;

                    $add_to_cart->save();
                    // $this->mount();

                    $this->productIncart->prepend($add_to_cart);
                    // $this->product_code = "";
                }
            }
        }
        $this->mount();
        return session()->flash('success', 'Product Added succcessfully');
        // return $this->massage ="Product Added succcessfully";
        dd($countProduct);
    }
    public function InsertoCart_retail()
    {
        // $this->mount();
        $countProduct = Product::where('barcode', $this->product_code)->first();  // this change id
        $qtyadd = $this->qty;
       
        if (!$qtyadd) {
            //scale product filter
            if (strlen($this->product_code) == 12) {
                // Get the first 7 characters of the barcode
                $firstPart = substr($this->product_code, 0, 7);

                // Get the last 5 characters and calculate the percentage
                $lastPart = substr($this->product_code, 7, 5);

                $kilogram = substr($lastPart, 0, 2);
                $grame = substr($lastPart, 2, 5);
                $percentage = $kilogram . '.' . $grame;

                // Format the message to display both parts
                if (!$firstPart) {
                    return session()->flash('error', 'Product not found');
                }
                $countCartProduct = Cart::where('barcode', $firstPart)->where('user_id', auth()->user()->id)->count();
                if ($countCartProduct > 0) {

                    // $this->IncrementQty($this->product_code);
                    $carts = Cart::where('barcode', $firstPart)->where('user_id', auth()->user()->id)->first();

                    $carts->increment('product_qty', $percentage);
                    $updatePrice = $carts->product_qty * $carts->product->retail_price;
                    $updatediscount = $carts->product_qty * ($carts->product->price - $carts->product->retail_price);
                    $carts->update(['product_price' => $updatePrice,'discount' => $updatediscount]);
                    $this->mount();
                    return session()->flash('success', 'Product ' . $carts->product->product_name . ' already exist in cart add quantity');
                } else {
                    $product = Product::where('barcode', $firstPart)->first();
                    if (!$product) {
                        return session()->flash('error', 'Product not found');
                    }
                    $add_to_cart = new Cart;
                    $add_to_cart->product_id = $product->id;
                    $add_to_cart->barcode = $firstPart;
                    $add_to_cart->product_qty = $percentage;
                    $add_to_cart->product_price = (($product->retail_price) * $percentage);
                    $add_to_cart->user_id = auth()->user()->id;
                    $add_to_cart->discount = $product->price - $product->retail_price;
                    $add_to_cart->save();
                    $this->productIncart->prepend($add_to_cart);
                }
            } else {
                if (!$countProduct) {
                    return session()->flash('error', 'Product not found');
                }
                $countCartProduct = Cart::where('barcode', $this->product_code)->where('user_id', auth()->user()->id)->count();
                if ($countCartProduct > 0) {
                    $carts = Cart::where("barcode", $this->product_code)->where('user_id', auth()->user()->id)->first();
                    $carts->increment('product_qty', 1);
                    $updatePrice = $carts->product_qty * $carts->product->retail_price;
                    $updatediscount = $carts->product_qty * ($carts->product->price - $carts->product->retail_price);
                    $carts->update(['product_price' => $updatePrice,'discount' => $updatediscount]);
                    $this->mount();
                    return session()->flash('success', 'Product ' . $carts->product->product_name . ' already exist in cart add quantity');
                } else {
                    $add_to_cart = new Cart;
                    $add_to_cart->product_id = $countProduct->id;
                    $add_to_cart->barcode = $countProduct->barcode;
                    $add_to_cart->product_qty = 1;
                    $add_to_cart->product_price = $countProduct->retail_price;
                    $add_to_cart->user_id = auth()->user()->id;
                    $add_to_cart->discount = $countProduct->price - $countProduct->retail_price;
                    $add_to_cart->save();

                    $this->productIncart->prepend($add_to_cart);
                }
            }
        } else {
            if (strlen($this->product_code) == 12) {
                // Get the first 7 characters of the barcode
                $firstPart = substr($this->product_code, 0, 7);

                // Get the last 5 characters and calculate the percentage
                $lastPart = substr($this->product_code, 7, 5);

                $kilogram = substr($lastPart, 0, 2);
                $grame = substr($lastPart, 2, 5);
                $percentage = $kilogram . '.' . $grame;

                // Format the message to display both parts
                if (!$firstPart) {
                    return session()->flash('error', 'Product not found');
                }
                $countCartProduct = Cart::where('barcode', $firstPart)->where('user_id',auth()->user()->id)->count();
                if ($countCartProduct > 0) {

                    // $this->IncrementQty($this->product_code);
                    $carts = Cart::where('barcode', $firstPart)->where('user_id',auth()->user()->id)->first();

                    $carts->increment('product_qty', ($percentage * $qtyadd));
                    $updatePrice = $carts->product_qty * $carts->product->retail_price;
                    $updatediscount = $carts->product_qty * ($carts->product->price - $carts->product->retail_price);
                    $carts->update(['product_price' => $updatePrice,'discount' => $updatediscount]);
                    $this->mount();
                    return session()->flash('success', 'Product ' . $carts->product->product_name . ' already exist in cart add quantity');
                } else {
                    $product = Product::where('barcode', $firstPart)->first();
                    if (!$product) {
                        return session()->flash('error', 'Product not found');
                    }
                    $add_to_cart = new Cart;
                    $add_to_cart->product_id = $product->id;
                    $add_to_cart->barcode = $firstPart;
                    $add_to_cart->product_qty = ($percentage * $qtyadd);
                    $add_to_cart->product_price = (($product->retail_price) * ($percentage * $qtyadd));
                    $add_to_cart->user_id = auth()->user()->id;
                    $add_to_cart->discount = ($product->price - $product->retail_price)*$add_to_cart->product_qty;
                    $add_to_cart->save();
                    // $this->mount();

                    $this->productIncart->prepend($add_to_cart);
                    // $this->product_code = "";
                }
            } else {
                if (!$countProduct) {
                    return session()->flash('error', 'Product not found');
                    // return $this->massage ='Product not found';
                }
                $countCartProduct = Cart::where('barcode', $this->product_code)->where('user_id',auth()->user()->id)->count();
                if ($countCartProduct > 0) {
                    // $this->IncrementQty($this->product_code);
                    $carts = Cart::where("barcode", $this->product_code)->where('user_id',auth()->user()->id)->first();
                    $carts->increment('product_qty', $qtyadd);
                    $updatePrice = $carts->product_qty * $carts->product->retail_price;
                    $updatediscount = $carts->product_qty * ($carts->product->price - $carts->product->retail_price);
                    $carts->update(['product_price' => $updatePrice,'discount' => $updatediscount]);
                    $this->mount();
                    return session()->flash('success', 'Product ' . $carts->product->product_name . ' already exist in cart add quantity');
                } else {
                    $add_to_cart = new Cart;
                    $add_to_cart->product_id = $countProduct->id;
                    $add_to_cart->barcode = $countProduct->barcode;
                    $add_to_cart->product_qty = $qtyadd;
                    $add_to_cart->product_price = ($countProduct->retail_price * $qtyadd);
                    $add_to_cart->user_id = auth()->user()->id;
                    $add_to_cart->discount = ($countProduct->price - $countProduct->retail_price)*$qtyadd;
                    $add_to_cart->save();

                    $this->productIncart->prepend($add_to_cart);
                }
            }
        }
        $this->mount();
        return session()->flash('success', 'Product Added succcessfully');
        // return $this->massage ="Product Added succcessfully";
        dd($countProduct);
    }
    public function InsertoCart_special()
    {
        // $this->mount();
        $countProduct = Product::where('barcode', $this->product_code)->first();  // this change id
        $qtyadd = $this->qty;
        
        if (!$qtyadd) {
            //scale product filter
            if (strlen($this->product_code) == 12) {
                // Get the first 7 characters of the barcode
                $firstPart = substr($this->product_code, 0, 7);

                // Get the last 5 characters and calculate the percentage
                $lastPart = substr($this->product_code, 7, 5);

                $kilogram = substr($lastPart, 0, 2);
                $grame = substr($lastPart, 2, 5);
                $percentage = $kilogram . '.' . $grame;

                // Format the message to display both parts
                if (!$firstPart) {
                    return session()->flash('error', 'Product not found');
                }
                $countCartProduct = Cart::where('barcode', $firstPart)->where('user_id', auth()->user()->id)->count();
                if ($countCartProduct > 0) {

                    // $this->IncrementQty($this->product_code);
                    $carts = Cart::where('barcode', $firstPart)->where('user_id', auth()->user()->id)->first();

                    $carts->increment('product_qty', $percentage);
                    $updatePrice = $carts->product_qty * $carts->product->special_price;
                    $updatediscount = $carts->product_qty * ($carts->product->price - $carts->product->special_price);
                    $carts->update(['product_price' => $updatePrice,'discount' => $updatediscount]);
                    $this->mount();
                    return session()->flash('success', 'Product ' . $carts->product->product_name . ' already exist in cart add quantity');
                } else {
                    $product = Product::where('barcode', $firstPart)->first();
                    if (!$product) {
                        return session()->flash('error', 'Product not found');
                    }
                    $add_to_cart = new Cart;
                    $add_to_cart->product_id = $product->id;
                    $add_to_cart->barcode = $firstPart;
                    $add_to_cart->product_qty = $percentage;
                    $add_to_cart->product_price = (($product->special_price) * $percentage);
                    $add_to_cart->user_id = auth()->user()->id;
                    $add_to_cart->discount = $product->price - $product->special_price;
                    $add_to_cart->save();
                    // $this->mount();




                    $this->productIncart->prepend($add_to_cart);
                    // $this->product_code = "";
                }
            } else {
                if (!$countProduct) {
                    return session()->flash('error', 'Product not found');
                    // return $this->massage ='Product not found';
                }
                $countCartProduct = Cart::where('barcode', $this->product_code)->where('user_id', auth()->user()->id)->count();
                if ($countCartProduct > 0) {
                    // $this->IncrementQty($this->product_code);
                    $carts = Cart::where("barcode", $this->product_code)->where('user_id', auth()->user()->id)->first();
                    $carts->increment('product_qty', 1);
                    $updatePrice = $carts->product_qty * $carts->product->special_price;
                    $updatediscount = $carts->product_qty * ($carts->product->price - $carts->product->special_price);
                    $carts->update(['product_price' => $updatePrice,'discount' => $updatediscount]);
                    $this->mount();
                    return session()->flash('success', 'Product ' . $carts->product->product_name . ' already exist in cart add quantity');
                } else {
                    $add_to_cart = new Cart;
                    $add_to_cart->product_id = $countProduct->id;
                    $add_to_cart->barcode = $countProduct->barcode;
                    $add_to_cart->product_qty = 1;
                    $add_to_cart->product_price = $countProduct->special_price;
                    $add_to_cart->user_id = auth()->user()->id;
                    $add_to_cart->discount = $countProduct->price - $countProduct->special_price;
                    $add_to_cart->save();
                    // $this->mount();

                    $this->productIncart->prepend($add_to_cart);
                    // $this->product_code = "";
                }
            }
        } else {
            if (strlen($this->product_code) == 12) {
                // Get the first 7 characters of the barcode
                $firstPart = substr($this->product_code, 0, 7);

                // Get the last 5 characters and calculate the percentage
                $lastPart = substr($this->product_code, 7, 5);

                $kilogram = substr($lastPart, 0, 2);
                $grame = substr($lastPart, 2, 5);
                $percentage = $kilogram . '.' . $grame;

                // Format the message to display both parts
                if (!$firstPart) {
                    return session()->flash('error', 'Product not found');
                }
                $countCartProduct = Cart::where('barcode', $firstPart)->where('user_id',auth()->user()->id)->count();
                if ($countCartProduct > 0) {

                    // $this->IncrementQty($this->product_code);
                    $carts = Cart::where('barcode', $firstPart)->where('user_id',auth()->user()->id)->first();

                    $carts->increment('product_qty', ($percentage * $qtyadd));
                    $updatePrice = $carts->product_qty * $carts->product->special_price;
                    $updatediscount = $carts->product_qty * ($carts->product->price - $carts->product->special_price);
                    $carts->update(['product_price' => $updatePrice,'discount' => $updatediscount]);
                    $this->mount();
                    return session()->flash('success', 'Product ' . $carts->product->product_name . ' already exist in cart add quantity');
                } else {
                    $product = Product::where('barcode', $firstPart)->first();
                    if (!$product) {
                        return session()->flash('error', 'Product not found');
                    }
                    $add_to_cart = new Cart;
                    $add_to_cart->product_id = $product->id;
                    $add_to_cart->barcode = $firstPart;
                    $add_to_cart->product_qty = ($percentage * $qtyadd);
                    $add_to_cart->product_price = (($product->special_price) * ($percentage * $qtyadd));
                    $add_to_cart->user_id = auth()->user()->id;
                    $add_to_cart->discount = ($product->price - $product->special_price)*$add_to_cart->product_qty;
                    $add_to_cart->save();

                    $this->productIncart->prepend($add_to_cart);
                    // $this->product_code = "";
                }
            } else {
                if (!$countProduct) {
                    return session()->flash('error', 'Product not found');
                    // return $this->massage ='Product not found';
                }
                $countCartProduct = Cart::where('barcode', $this->product_code)->where('user_id',auth()->user()->id)->count();
                if ($countCartProduct > 0) {
                    // $this->IncrementQty($this->product_code);
                    $carts = Cart::where("barcode", $this->product_code)->where('user_id',auth()->user()->id)->first();
                    $carts->increment('product_qty', $qtyadd);
                    $updatePrice = $carts->product_qty * $carts->product->special_price;
                    $updatediscount = $carts->product_qty * ($carts->product->price - $carts->product->special_price);
                    $carts->update(['product_price' => $updatePrice,'discount' => $updatediscount]);
                    $this->mount();
                    return session()->flash('success', 'Product ' . $carts->product->product_name . ' already exist in cart add quantity');
                } else {
                    $add_to_cart = new Cart;
                    $add_to_cart->product_id = $countProduct->id;
                    $add_to_cart->barcode = $countProduct->barcode;
                    $add_to_cart->product_qty = $qtyadd;
                    $add_to_cart->product_price = ($countProduct->special_price * $qtyadd);
                    $add_to_cart->user_id = auth()->user()->id;
                    $add_to_cart->discount = ($countProduct->price - $countProduct->special_price)*$qtyadd;
                    $add_to_cart->save();
                    // $this->mount();




                    $this->productIncart->prepend($add_to_cart);
                    // $this->product_code = "";
                }
            }
        }
        $this->mount();
        return session()->flash('success', 'Product Added succcessfully');
        // return $this->massage ="Product Added succcessfully";
        dd($countProduct);
    }
    public function IncrementQty($cartId)
    {
        
        $carts = Cart::find($cartId);
        $nowprice = $carts->product_price / $carts->product_qty;
        $carts->increment('product_qty', 1);
        $updatePrice = $carts->product_qty * $nowprice;
        $updatediscount = $carts->product_qty * ($carts->product->price - $nowprice);
        $carts->update(['product_price' => $updatePrice,'discount' => $updatediscount]);
        $this->mount();
    }

    public function DecrementQty($cartId)
    {
        $carts = Cart::find($cartId);
        $nowprice = $carts->product_price / $carts->product_qty;
        if ($carts->product_qty == 0) {
            return session()->flash('info', 'Product' . $carts->product->name . 'Quantity can be less than 1,add quantity or remove in cart.');
        }
        $carts->decrement('product_qty', 1);
        $updatePrice = $carts->product_qty * $nowprice;
        $updatediscount = $carts->product_qty * ($carts->product->price - $nowprice);
        $carts->update(['product_price' => $updatePrice,'discount' => $updatediscount]);
        $this->mount();
    }
    public function removeProduct($cartId)
    {
        $deleteCart = Cart::find($cartId);
        $deleteitem = new Deleteitem;
        $deleteitem->product_id = $deleteCart->product_id;
        $deleteitem->quantity = $deleteCart->product_qty;
        $deleteitem->user_id = auth()->user()->id;
        $deleteitem->price = $deleteCart->product_price;
        $deleteitem->save();






        $deleteCart->delete();
        // $this->massage = "Product removed from Cart";
        $this->mount();

        return session()->flash('success', 'Product' . $deleteCart->product->name . 'removed from cart');
        $this->productIncart = $this->productIncart->except($cartId);
    }
    public function changeqty($cartId)
    {
        $carts = Cart::find($cartId);
        $updateqty = $this->cc;
        $carts->update(['product_qty' => $updateqty]);

        $updatePrice = $carts->product_qty * $carts->product->price;
        $updatediscount = $carts->product_qty * $carts->discount;
        $carts->update(['product_price' => $updatePrice,'updatediscount' => $updatediscount]);
    }

    public function render()
    {
        // if($this->cashtxt !='' || $this->banktxt !='' || $this->credittxt !=''){
            $CashAmount = (Float) $this->cashtxt ;
            $BankAmount = (Float) $this->banktxt ;
            $CreditAmount = (Float) $this->credittxt ;
            $this->pay_money = $CashAmount + $BankAmount + $CreditAmount;

            // $this->pay_money = (Float) $this->cashtxt + (Float) $this->banktxt + (Float) $this->credittxt ;
            // return session()->flash('error', 'wada na bn');
            
        if ($this->pay_money > 0) {
            

            // $totalAmount = $CashAmount + $BankAmount + $CreditAmount;

            $totalAmount = $this->pay_money - $this->productIncart->sum('product_price');
            $this->balance = $totalAmount;
            
        }
    // }

        return view('livewire.order');
    }
}
