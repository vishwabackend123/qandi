<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestSeries extends Model
{
    use HasFactory;

    protected $table = 'test_series';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['test_series_id', 'test_series_name', 'category', 'subject_id', 'class_exam_id', 'series_type', 'test_series_date', 'series_end_date', 'result_date', 'time_allowed', 'time_unit', 'subscription_type', 'questions_count', 'autoselect_manual', 'series_question_ids', 'status', 'result_schedule_ran_yn'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;
}
