<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Subcategory extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'category_id',
    ];

    public function products(){
        return $this->hasMany(Product::class);
   }
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function my_store($request){
        self::create([
            'name' => $request->name,
            'description' => $request->description,
            'slug' => Str::slug($request->name,'_'),
            'category_id' => $request->category_id,
        ]);
    }

    public function my_update($request){
        $this->update([
            'name' => $request->name,
            'description' => $request->description,
            'slug' => Str::slug($request->name,'_'),
        ]);
    }
}
