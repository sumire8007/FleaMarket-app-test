<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = [
                            'user_id',
                            'category_id',
                            'condition_id',
                            'item_name',
                            'price',
                            'detail',
                            'brand',
                            'item_img',
                        ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function category(){
        return $this->belongsToMany(Category::class);
    }
    public function condition(){
        return $this->belongsTo(Condition::class);
    }

}
