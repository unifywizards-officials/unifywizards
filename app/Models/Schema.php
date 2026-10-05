<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schema extends Model
{
    protected $fillable = ['type','page','json_data','status'];

  public function pages()
{
    return $this->hasMany(SchemaPageMap::class, 'schema_id');
}
}
