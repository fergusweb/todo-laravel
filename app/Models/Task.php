<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model
{
    use HasFactory;


    /**
     * Indicates if the model should be timestamped
     *
     * @var boolean
     */
    public $timestamps = true;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'name', 'description'];

    /**
     * Get the user associated with the Task
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function user(): belongsTo
    {
        return $this->belongsTo(User::class);
    }


    /**
     * Get all of the items for this Task
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items(): HasMany
    {
        return $this->hasMany(TaskItem::class);
    }


}
