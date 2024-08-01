<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class TaskItem extends Model
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
    protected $fillable = ['task_id', 'name', 'description'];



    /**
     * Get the task this item belongs to
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function isCompleted() {
        return $this->completed_at ? true : false;
    }

    /**
     * Mark this item as Complete by setting the completed_at
     *
     * @param string $date
     * @return void
     */
    public function complete($date) {
      $this->completed_at = '';
    }


}
