<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Produk extends Model{
    protected $table = 'produk';
    protected $fillable = ['id', 'user_id', 'name'];
    protected $hidden   = ['created_at', 'updated_at'];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
