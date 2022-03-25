<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fair extends Model
{
    protected $table = 'fairs';
    protected $fillable = ['name', 'price', 'amount', 'barcode', 'user_id', 'total_value'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
