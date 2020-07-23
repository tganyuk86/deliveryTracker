<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;



class User extends \TCG\Voyager\Models\User
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'lat', 'lon', 'car',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function isAdmin()
    {
        return $this->role_id == 1 ? true : false;
    }

    public function ordersBy($column)
    {
        $orders = $this->orders();
        $out = [];
        foreach ($orders as $order) 
        {
            $out[$order[$column]][] = $order;
        }
// dd($out);
        return $out;
    }
    

    public function orders($status = false)
    {
        $orders = Order::where('driverID', $this->id);
        if($status)
        {
            $orders = $orders->where('status', $status);
        }
        $orders = $orders->get()->sortBy('priority');

        return $orders;
    }

    public static function drivers()
    {
        return User::where('role_id', 2)->get();
    }

    public function stock()
    {
        return ProductStock::where('driverID', $this->id)->get();
    }
}
