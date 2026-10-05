<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchemaPageMap extends Model
{
    protected $fillable = ['schema_id','page'];

   public function schema()
{
    return $this->belongsTo(Schema::class, 'schema_id');
}
}