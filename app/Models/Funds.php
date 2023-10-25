<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funds extends Model
{
    use HasFactory;

    protected $table = 'Funds';

    protected $primaryKey = 'fund_id';

    protected $fillable = ['name','startYear','alias'];
}
