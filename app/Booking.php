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

    public function getCustomer(){
        $customer = Customer::find($this->customer_id);
        return $customer->first_name . ' ' . $customer->last_name;
    }

    public function getCleaner(){
        $cleaner = Cleaner::find($this->cleaner_id);
        return $cleaner->first_name . ' ' . $cleaner->last_name;
    }

    public function getCity(){
        $city = City::find($this->city_id);
        return $city->name;
    }
}
