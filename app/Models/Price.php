<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\ModelsTrait;

class Price extends Model
{
	use SoftDeletes, ModelsTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'level_id',
        'subcategory_id',
        // 'category_text',
        // 'level_text',
        // 'subcategory_text',
        'price',
        'tournament_id',
    ];

    /**
     * Los atributos que deberían estar ocultos para las matrices.
     *
     * @var array
     */
    protected $hidden = [
    	'created_at', 'updated_at', 'deleted_at'
    ];

    public function inscriptions()
    {
        return $this->belongsToMany(Inscription::class);
    }

    public function subO()
    {
        return $this->belongsTo(Category_open::class, 'subcategory_id', 'id');
    }

    public function subL()
    {
        return $this->belongsTo(Subcategory_latino::class, 'subcategory_id', 'id');
    }

    public function subS()
    {
        return $this->belongsTo(Subcategory_standar::class, 'subcategory_id', 'id');
    }
}
