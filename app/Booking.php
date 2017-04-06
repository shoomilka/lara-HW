<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Customer;

class Booking extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'bookings';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['date', 'customer_id', 'cleaner_id', 'time', 'hours', 'city_id'];

    static function getValidationRules() {
        return array(
            'customer_id' => 'required|exists:customers,id',
            'cleaner_id' => 'required|exists:cleaners,id',
            'date' => 'required|date_format:Y-m-d|after:yesterday',
            'time' => 'required|date_format:H:i A',
            'hours' => 'numeric|min:1|max:12',
            'city_id' => 'required'
        );
    }
}
