<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address.php extends Model
{
    use HasFactory;
    protected $fillable = ['user_name',
                            'user_img',
                            'post_code',
                            'address',
                            'building'
                        ];
}
