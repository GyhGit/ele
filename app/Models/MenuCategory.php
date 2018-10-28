<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuCategory extends Model
{
    protected $fillable = [
        'name', 'type_accumulation', 'shop_id','description','is_selected',
    ];

    //读取菜品
    public function menu_category()
    {
     return  $this->belongsTo(Shops::class,"shop_id") ;
    }

}
