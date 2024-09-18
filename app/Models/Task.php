<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model
{
    use HasFactory;

    public const NOT_STARTED='not-started';
    public const STARTED='started';
    public const PENDING='pending';


    protected $fillable=['title','todo_list_id','status'];

    public function todo_list(): BelongsTo
    {
        return $this->belongsTo(TodoList::class);
    }

}
