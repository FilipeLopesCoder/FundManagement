<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FundManagers extends Model
{
    use HasFactory;

    protected $table = 'FundManagers';

    protected $primaryKey = 'fundmanager_id';

    protected $fillable = ['company_id','fund_id'];
}
