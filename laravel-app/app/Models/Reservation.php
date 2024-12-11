<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

        DB::transaction(function () use ($data) {
            $this->create([
                'childs' => $data['childs'],
                'adults' => $data['adults'],
                'price' => $data['price'],
                'status' => 'awaiting_payment',
                'payment_date' => '',
                'trip_package_id' => $data['trip_package_id'],
                'trip_user_id' => $data['user_id']
            ]);


            if(isset($data['accommodations'])) {
                foreach ($data['accommodations'] as $accommodation) {
                    $this->accommodations()->updateOrCreate(
                        ['id' => $accommodation['id'] ?? null],
                        $accommodation
                    );
                }
            }

            if(isset($data['tours'])) {
                foreach ($data['tour'] as $tour) {
                    $this->tours()->updateOrCreate(
                        ['id' => $tour['id'] ?? null],$tour);
                }
            }

            foreach ($data['passengers'] as $passenger) {
                $this->passengers()->updateOrCreate(
                    ['id' => $passenger['id'] ?? null],
                    $passenger
                );
            }
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
        return $this->hasMany(ReservationAccommodation::class);
    }

    public function passengers()
    {
        return $this->hasMany(ReservationPassenger::class);
    }

    public function tours()
    {
        return $this->hasMany(ReservationTour::class);
    }
}
