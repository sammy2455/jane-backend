<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'categories';
    protected $primaryKey = 'category_id';
    protected $keyType = 'integer';

    public $incrementing = true;

    public const UPDATED_AT = 'updated_at';
    public const CREATED_AT = 'created_at';
}
