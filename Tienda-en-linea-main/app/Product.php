<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $fillable=[
        'name','slug','stock','code','sell_price','cred_price','short_description','long_description','status','subcategory_id',
    ];

    public function subcategory(){
        return $this->belongsTo(Subcategory::class);
    }

    public function images(){
        return $this->morphMany('App\Image','imageable');
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function my_store($request){
       $product= self::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name,'_'),
            'stock' => $request->stock,
            'code' => $request->code,
            'sell_price' => $request->sell_price,
            'cred_price' => $request->cred_price,
            'short_description' =>$request->short_description,
            'long_description' =>$request->long_description,
            'subcategory_id' => $request->subcategory_id,
        ]);
        $product->tags()->attach($request->get('tags'));  
        $this->upload_files($request,$product);     
    } 

    public function my_update($request){
            $this->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name,'_'),
            'stock' => $request->stock,
            'code' => $request->code,
            'sell_price' => $request->sell_price,
            'cred_price' => $request->cred_price,
            'short_description' =>$request->short_description,
            'long_description' =>$request->long_description,
            'subcategory_id' => $request->subcategory_id,
        ]);
        $this->tags()->sync($request->get('tags'));
    }

    public function generate_code($product){
     
            $numero = $product->id;
            $numeroConCeros = str_pad($numero, 8, "0", STR_PAD_LEFT);
            $product->update(['code'=>$numeroConCeros]);
        
    }

    public function upload_files($request,$product){
        $urlimages=[];
        if($request->hasFile('images')){
            $images=$request->file('images');
            foreach($images as $image){
                $nombre=time().$image->getClientOriginalName();
                $ruta=public_path().'/image';
                $image->move($ruta,$nombre);
                $urlimages[]['url']='/image/'.$nombre;
            }
        }
        $product->images()->createMany($urlimages);
    }

    public function status(){
        switch ($this->status) {
            case 'ACTIVE':
                return 'ACTIVO';
            case 'DEACTIVATED':
                    return 'INACTIVO';
            
            default:
                # code...
                break;
        }
    }

    static function get_active_products()
    {
        return self::where('status','ACTIVE');
    }
}
