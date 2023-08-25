<?php

namespace App\Models;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UsedTag extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }
}
