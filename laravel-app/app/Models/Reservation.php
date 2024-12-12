<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Reservation extends Model
{
    use HasFactory;

    // Define o nome da tabela, caso a tabela não siga a convenção do plural
    protected $table = 'reservation';

    // Define os campos que podem ser preenchidos em massa
    protected $fillable = [
        'childs',
        'adults',
        'price',
        'status',
        'payment_date',
        'trip_package_id',
        'user_id',
    ];

    public static function createReservationData($data)
    {
        return DB::transaction(function () use ($data) {
            $packageModel = TripPackage::find($data['trip_package_id']);
            $childValue = $data['childs'] * $packageModel->child_value;
            $adultValue = $data['adults'] * $packageModel->adult_value;
            $reservation = Reservation::create([
                'childs' => $data['childs'],
                'adults' => $data['adults'],
                'price' => $childValue + $adultValue,
                'trip_package_id' => $data['trip_package_id'],
                'user_id' => $data['user_id']
            ]);

            if(isset($data['accommodations'])) {
                foreach ($data['accommodations'] as $accommodation) {
                    $accommodationModel = Accommodation::find($accommodation['id']);

                    if ($accommodationModel) {
                        $reservation->accommodations()->attach($accommodationModel->id, [
                            'accommodation_price' => $accommodationModel->price,
                        ]);

                    }
                }
            }
            if(isset($data['tours'])) {
                foreach ($data['tours'] as $tour) {
                    $tourModel = Tour::find($tour['id']);
                    if($tourModel) {
                        $reservation->tours()->attach($tourModel->id, [
                            'tour_child_value' =>   $tourModel->child_value * $tour['quantity_child'],
                            'tour_adult_value' =>   $tourModel->adult_value * $tour['quantity_adult'],

                        ]);
                    }
                }
            }

            foreach ($data['passengers'] as $passenger) {
                if ($passenger['age'] >= 8) {
                    $passenger['reservation_price'] = $packageModel->child_value;
                } else {
                    $passenger['reservation_price'] = $packageModel->adult_value;
                }

                $reservation->passengers()->create([
                    'name' => $passenger['name'],
                    'age' => $passenger['age'],
                    'rg' => $passenger['rg'],
                    'cpf' => $passenger['cpf'],
                    'reservation_price' => $passenger['reservation_price'], // Pass the correct value
                ]);
            }

            return $reservation;
        });
    }

    public function tripPackage()
    {
        return $this->belongsTo(TripPackage::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function accommodations()
    {
        return $this->belongsToMany(
            Accommodation::class,
            'reservationAccommodation',
            'reservation_id',
            'accommodation_id'
        )->withPivot('accommodation_price');
    }


    public function passengers()
    {
        return $this->hasMany(ReservationPassenger::class, 'reservation_id');
    }

    public function tours()
    {
        return $this->belongsToMany(
            Tour::class,
            'reservationTour',
            'reservation_id',
            'tour_id'
        )->withPivot('tour_child_value', 'tour_adult_value');
    }
}
