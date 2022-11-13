<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class actionLog extends Model
{
    use HasFactory;

    protected $fillable = ['actionLog_id','user_id','post_id'];
}
