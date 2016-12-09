<?php namespace SublimeArts\SublimeStripe\Models;

use Model;
use SublimeArts\SublimeStripe\Models\Settings;

/**
 * SingleCharge Model
 */
class SingleCharge extends Model
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'sublimearts_sublimestripe_single_charges';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [
        'user_id',
        'product_id',
        'ip_address',
        'amount_in_cents',
        'stripe_charge_id',
        'stripe_invoice',
    ];

    /**
     * @var array Relations
     */
    public $belongsTo = [
        'user' => [
            'SublimeArts\SublimeStripe\Models\User'
        ],
        'product' => [
            'SublimeArts\DemoShop\Models\Product'
        ]
    ];

    public function getProductNameAttribute()
    {
        if ($this->product) {
            return $this->product->{Settings::get('name_attribute')};
        } else {
            return 'Product not available';
        }
    }

    public function getUserNameAttribute()
    {
        if ($this->user && $this->user->baseUser) {
            return $this->user->baseUser->name . ' ' . $this->user->baseUser->surname;
        } else {
            return 'User data not available';
        }
    }

    public function getUserEmailAttribute()
    {
        if ($this->user && $this->user->baseUser) {
            return $this->user->baseUser->email;
        } else {
            return 'User data not available';
        }
    }

}