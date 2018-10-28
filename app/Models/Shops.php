<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Shops
 *
 * @property int $id
 * @property int|null $shop_category_id 店铺分类id
 * @property string|null $shop_name 店铺名称
 * @property string|null $shop_img 图片
 * @property float|null $shop_rating 评分
 * @property int|null $brand 是否是品牌
 * @property int|null $on_time 是否准时送达
 * @property int|null $fengniao 是否蜂鸟配送
 * @property int|null $bao 是否保标记
 * @property int|null $piao 是否票标记
 * @property int|null $zhun 是否准标记
 * @property float|null $start_send 起送金额
 * @property float|null $send_cost 配送费
 * @property string|null $notice 店公告
 * @property string|null $discount 优惠信息
 * @property int|null $status 状态：1正常 0待审核 -1禁用
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $user_id 用户id
 * @property-read \App\Models\ShopCategory|null $shop_category
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shops whereBao($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shops whereBrand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shops whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shops whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shops whereFengniao($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shops whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shops whereNotice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shops whereOnTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shops wherePiao($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shops whereSendCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shops whereShopCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shops whereShopImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shops whereShopName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shops whereShopRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shops whereStartSend($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shops whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shops whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shops whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shops whereZhun($value)
 * @mixin \Eloquent
 */
class Shops extends Model
{
    protected $fillable = [
        'shop_name', 'shop_img', 'shop_rating','brand','on_time','fengniao','bao','piao','zhun','start_send','send_cost','notice','discount','status','shop_category_id','user_id'
    ];

    //读取分类的名字
    public function shop_category(){
        return $this->belongsTo(ShopCategory::class,"shop_category_id");
    }

//读取分类的名字
    public function user(){
        return $this->belongsTo(User::class,"user_id");
    }


}
