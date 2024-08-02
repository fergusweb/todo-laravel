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

    /**
     * Count how many items this Task holds
     *
     * @return int
     */
    public function countItems() {
        return count($this->items);
    }

    /**
     * Count how many of the items are completed
     *
     * @return int
     */
    public function countCompletedItems() {
        $count = 0;
        foreach ($this->items as $item) {
            if ($item->isCompleted()) {
                $count++;
            }
        }
        return $count;
    }

    /**
     * Calculate the percentage of items that are complete
     *
     * @return double
     */
    public function percentComplete() {
        if (!$this->countCompletedItems() || !$this->countItems()) {
            return 0;
        }
        return ($this->countCompletedItems() / $this->countItems()) * 100;
    }



}
