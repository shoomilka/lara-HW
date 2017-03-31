<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'customers';

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
    protected $fillable = ['first_name', 'last_name', 'phone_number'];

    static function getValidationRules() {
        return array(
            'last_name' => 'required',
            'first_name' => 'required',
            'phone_number' => 'regex:/(\d\d)-(\d\d\d)-(\d\d\d\d)/'
        );
    }
}
