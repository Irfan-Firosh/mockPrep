<?php

namespace App\Models\questions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class leetcodebank extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'topic_tags' => 'array',
    ];
}
