<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;

class Articles extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'content',
        'image',
        'user_id',
    ];
    protected $appends = ['src'];

    public function users()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    
    public function scopeFilter(Builder $query, array $filters): Builder
    {
        if($filters['sort'] ?? false){
            $query->orderBy('updated_at', $filters['sort']);
        }else{
            $query->orderBy('updated_at', 'desc');
        }

        return $query->when(
            $filters['search'] ?? false,
            fn ($query, $value) => $query->where('title', 'like', '%' . $value.'%')
        );
    }

    public function getSrcAttribute()
    {
        if(!$this->image){
            return asset("storage/default.jpg");
        }
        return asset("storage/articles/{$this->image}");
    }

    public function getUpdatedAtAttribute($value)
    {
        return date('d M Y', strtotime($value));
    }
}
