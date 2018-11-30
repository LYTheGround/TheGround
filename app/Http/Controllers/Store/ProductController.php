<?php

namespace App\Http\Controllers\Store;

//use App\Notifications\ProductNotification;
use App\Http\Requests\Store\ProductRequest;
use App\Product;
use App\Product_img;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function index()
    {
        $this->authorize('view',auth()->user()->member);
        $products = auth()->user()->member->company->products;
        return view('store.product.index',compact('products'));
    }

    public function create()
    {
        $this->authorize('view',auth()->user()->member);
        return view('store.product.create');
    }

    public function store(ProductRequest $request)
    {
        $this->authorize('view',auth()->user()->member);
        $product = auth()->user()->member->company->products()->create($request->all());
        $product->slug = str_slug($request->name . ' ' .$product->id, '-');
        $product->ref = 'PROD-' . $product->id;
        $product->save();
        if(request()->img){
            foreach ($request->img as $file){
                $product->imgs()->create([
                    'img'   => $file->store('store/products')
                ]);
            }
        }
        session()->flash('status',__('pages.product.add_success'));
        return redirect()->route('product.show',compact('product'));
    }

    public function show(Product $product)
    {
        //$notifiable = User::all();
        //Notification::send($notifiable,new ProductNotification($product));
        $this->authorize('view',auth()->user()->member);
        return view('store.product.show',compact('product'));
    }

    public function edit(Product $product)
    {
        $this->authorize('view',auth()->user()->member);
        return view('store.product.edit',compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $this->authorize('view',auth()->user()->member);
        if($product->update($request->all())){
            if(request()->img){
                foreach (request()->img as $file){
                    $product->imgs()->create([
                        'img'   => $file->store('store/products')
                    ]);
                }
            }
        }
        session()->flash('status',__('pages.product.update_success'));
        return redirect()->route('product.show',compact('product'));
    }

    public function destroy(Product $product,User $user)
    {
        $this->authorize('view',auth()->user()->member);
        $user = $user->where('id',auth()->user()->id)->first();
        if($user->cant('delete',$product)){
            session()->flash('status', 'vous ne pouvez pas supprimé ce produit il est encore dans votre cour de travaille');
            return back();
        }
        $product->delete();
        if(isset($product->imgs)){
            foreach ($product->imgs as $file){
                if(file_exists('storage/'.$file->img)){
                    @unlink('storage/'.$file->img);
                }
                $file->delete();
            }
        }
        session()->flash('status',__('pages.product.delete_success'));
        return redirect()->route('product.index');
    }

    public function destroyImg($img)
    {
        $this->authorize('view',auth()->user()->member);
        $product_img = Product_img::findOrFail($img);
        if(file_exists('storage/'.$product_img->img)){
            @unlink('storage/'.$product_img->img);
        }
        $product_img->delete();
        return redirect()->back();
    }
}
