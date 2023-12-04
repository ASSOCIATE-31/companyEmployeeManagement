<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Company extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "companies";
    protected $fillable = [
        'company_name',
        'email',
        'logo',
        'status',
        'slug',
    ];
    public function employee():hasMany
    {
        return $this->hasMany(Employee::class,'companies_id');
    }
}
