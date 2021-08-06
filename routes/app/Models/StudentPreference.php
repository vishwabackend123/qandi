<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentPreference extends Model
{
    use HasFactory;

    protected $table = 'student_preferences';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['student_stage_at_sgnup', 'prof_asst_test', 'prof_test_date', 'prof_test_marks', 'share_progress_rpt_yn', 'email_id_share_rpt', 'rpt_share_freq', 'parent_module_access_yn', 'parent_protal_frreq', 'parent_portal_access_fee', 'parent_last_login_date', 'daily_study_hours', 'student_dob', 'no_of_attempts_taken', 'student_time_per_ques', 'question_bank_exhausted_flag', 'ques_exhausted_date', 'scholar_test_date', 'scholar_test_status', 'scholarship_test_marks', 'subscription_yn', 'subscription_expiry_date', 'create_by_user_id', 'created_on', 'subjects_rating', 'language_id', 'assessment_taken_cnt'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
