<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyInvestment extends Model
{
    use HasFactory;

    protected $table = 'CompanyInvestment';

    protected $primaryKey = 'companyinvestment_id';

    protected $fillable = ['company_id','fund_id'];
}
