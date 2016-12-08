<?php namespace SublimeArts\SublimeStripe\Models;

use Model;

/**
 * Subscription Model
 */
class Subscription extends Model
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'sublimearts_sublimestripe_subscriptions';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    /**
     * @var array Relations
     */
    public $morphMany = [
        'payments' => [
            'SublimeArts\SublimeStripe\Models\Payment',
            'name' => 'billable'
        ]
    ];
    
}