<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory,HasRoles;
    protected $fillable = ['name'];
}
