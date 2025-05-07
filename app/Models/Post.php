<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Если таблица не содержит временных меток created_at и updated_at
    // public $timestamps = false;

    protected $primaryKey = 'post_id'; // Указываем кастомный первичный ключ
    protected $table = 'posts'; // Явное указание таблицы
    public function getRouteKeyName()
    {
        return 'slug'; // Указываем, что binding делаем по slug. по умолчанию 'posts/{post}'  ищет по айди
    }
    // Отключаем автоматические временные метки, если они не нужны
    // public $timestamps = false;
    
    // Если у вас свои названия для created_at/updated_at
    // const CREATED_AT = 'creation_date';
    // const UPDATED_AT = 'last_update';
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        // 'rate'
    ];

    protected $casts = [
        'rate' => 'integer'
    ];

//     'id' => 'integer', // Преобразует в int
//     'is_published' => 'boolean', // Преобразует в true/false
//     'options' => 'array', // Автоматическая сериализация/десериализация JSON
//     'price' => 'float',
//     'published_at' => 'datetime', // Преобразует в объект Carbon


 
}
