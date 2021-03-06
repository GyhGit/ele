<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

/**
 * App\Models\Admin
 *
 * @property int $id
 * @property string|null $name 名称
 * @property string|null $email 邮箱
 * @property string|null $password 密码
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $remember_token
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Admin extends Authenticatable
{
    //
    use HasRoles;
    //使用admin管家
    protected $guard_name='admin';
    //设置可以修改的字段
    protected $fillable=["email","password","name"];





}
