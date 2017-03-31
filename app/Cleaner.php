<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

use App\Booking;
use App\City;

class Cleaner extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cleaners';

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
    protected $fillable = ['first_name', 'last_name', 'quality_score'];

    static function create(array $attributes = array()){
        $cleaner = parent::create($attributes);
        self::addCities($attributes, $cleaner->id);
        return $cleaner;
    }

    static function addCities($attributes, $id){
        $count = City::all()->count();

        for($i=1; $i<= $count; $i++){
            if(isset($attributes['city'.$i]))
                if($attributes['city'.$i] == 'on') CleanerCities::create(array('cleaner_id'=>$id,
                                                                                'city_id'=>$i));
        }
    }

    function update(array $attributes = array(), array $options = array()){
        CleanerCities::where('cleaner_id', $this->id)->delete(); 
        self::addCities($attributes, $this->id);
        return parent::update($attributes, $options);
    }

    static function destroy($id){
        CleanerCities::where('cleaner_id', $id)->delete();        
        return parent::destroy($id);
    }

    static function getValidationRules() {
        return array(
            'last_name' => 'required',
            'first_name' => 'required',
            'quality_score' => 'numeric|required|min:0|max:5'
        );
    }

    static function searchCleaner($requestData) {
        $bookings = Booking::where('date', $requestData['date'])->get();
        $filter_cleaners = collect();

        foreach($bookings as $booking){
            $boodate1 = Carbon::createFromFormat('H:i A', $booking->time);
            $reqdate1 = Carbon::createFromFormat('H:i A', $requestData['time']);
            $boodate2 = $boodate1->addHours($booking->hours);
            $reqdate2 = $reqdate1->addHours($requestData['hours']);

            $flag = ($reqdate1->gt($boodate1));
            $flag = $flag and ($reqdate1->gt($boodate2));
            $flag = $flag or ($reqdate2->lt($boodate1));

            if(!$flag) $filter_cleaners->push(self::find($booking->cleaner_id));
        }
        $cleaner = self::areFromCity($requestData['city'])
                        ->diff($filter_cleaners)
                        ->sortByDesc('quality_score')
                        ->first();

        return $cleaner;
    }

    static function areFromCity($city){
        $cc = City::find($city)->hasMany('App\CleanerCities', 'city_id', 'id')->get();
        $cleaners = collect();
        foreach($cc as $c){
            $cleaners->push(self::find($c->cleaner_id));
        }
        return $cleaners;
    }
}
