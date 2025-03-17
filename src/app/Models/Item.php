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
                            'condition',
                            'item_name',
                            'price',
                            'detail',
                            'brand',
                            'item_img',
                        ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function categories(){
        return $this->belongsToMany(Category::class);
    }

//検索機能
    public function scopeKeywordSearch($query, $keyword)
    {
        if(!empty($keyword)) {
            $query->where('item_name', 'like','%' . $keyword . '%');
        }
    }


//いいね機能
    public function likes()
    {
        return $this->hasMany(ItemLike::class);
    }
    public function isLikedByAuthUser() :bool
    {
        $authUserId = \Auth::id();
        $likersArr = array();
        foreach($this->likes as $itemLike){
            array_push($likersArr,$itemLike->user_id);

        }
        if (in_array($authUserId,$likersArr)){
            return true;
        }else{
            return false;
        }
    }

}
