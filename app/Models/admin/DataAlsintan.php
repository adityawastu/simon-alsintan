<?php

namespace App\Models\Admin;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataAlsintan extends Model
{
    use HasFactory;

    protected $table = 'data_alsintans';

    protected $fillable = [
        'name',
        // 'slug',
        'category_id',
        'merk_id',
        'stock',
        'sensor_id',
        'description',
        'image',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function merk()
    {
        return $this->belongsTo(Merk::class);
    }

    public function serviceHistories()
    {
        return $this->hasMany(ServiceHistory::class, 'data_alsintan_id');
    }

    public function sensor()
    {
        return $this->belongsTo(SensorData::class, 'sensor_id', 'sensor_id');
    }

    // protected static function boot()
    // {
    //     parent::boot();

    //     static::saving(function ($model) {
    //         // Kalau slug kosong atau name berubah, buat slug baru
    //         if (empty($model->slug) || $model->isDirty('name')) {
    //             $model->slug = Str::slug($model->name);
    //         }
    //     });
    // }
}
