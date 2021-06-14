<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPurchase extends Model
{
    use HasFactory;

    protected $table = 'users_purchase';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'purchase_date', 'exam_year', 'subscription_id', 'subscription_start_date', 'subscription_end_date', 'subscription_type', 'amount', 'transaction_id', 'order_id', 'order_status', 'transaction_status', 'payment_by', 'created_on'];


    public $timestamps = false;
}
