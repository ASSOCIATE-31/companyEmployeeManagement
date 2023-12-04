<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Company;

class Employee extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "employees";
    protected $fillable = [
        'companies_id',
        'first_name', 
        'last_name',
        'email',
        'phone',
        'status',
        'slug',
    ];
    public function company():BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}