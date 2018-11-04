<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    static public $statusText=[-1=>"已取消",0=>"代付款",1=>"代发货", 2 => "待确认", 3 => "完成"];
    protected $fillable=["user_id","shop_id","order_code","provence","city","area","detail_address","tel","name","total","status"];
    public function getOrderStatusAttribute(){
        return self::$statusText[$this->status];
    }
    public function shop(){
        return $this->belongsTo(Shops::class,'shop_id');
    }
    public function goods(){
        return $this->hasMany(OrderGood::class,"order_id");
    }

}
