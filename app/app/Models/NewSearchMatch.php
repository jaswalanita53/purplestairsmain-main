<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewSearchMatch extends Model
{
    use HasFactory;
    public function search()
    {
        return $this->belongsTo(Search::class);
    }
}
