<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $fillable = [
        'name','description','slug','icon',];
       

       public function subcategories(){
        return $this->hasMany(Subcategory::class);
   }
    public function my_store($request){
        self::create([
            'name' => $request->name,
            'description' => $request->description,
            'slug' => Str::slug($request->name,'_'),
            'icon' => $request->icon,
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
