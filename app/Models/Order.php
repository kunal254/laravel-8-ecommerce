<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'grand_total',
        'first_name',
        'last_name',
        'email',
        'address_line',
        'city',
        'postal_code',
        'country',
        'mobile'
    ];

    public function getFullNameAttribute()
    {
        return ucfirst("{$this->first_name} {$this->last_name}");
    }

    public function getShortNameAttribute()
    {
        return strtoupper($this->first_name[0]."".$this->last_name[0]);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
 
    public function products(){
        // learn $pivot
        return $this->belongsToMany(Product::class)->withPivot('price','quantity', 'discount')->withTimestamps();
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
