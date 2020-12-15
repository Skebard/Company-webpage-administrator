<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Category extends Model
{
    // https://laravel.com/docs/8.x/eloquent#soft-deleting
    // When models are soft deleted, they are not actually removed from your database. Instead, a deleted_at attribute is set on the model indicating the date and time at which the model was "deleted"
    use SoftDeletes;
        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'category_name',
    ];

}

