<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    protected $fillable = [
        'phone',
        'gender',
        'address',
        'is_active',
        'user_id',
    ];

    protected $appends = ['gender_label', 'is_active_label'];

    public function getGenderLabelAttribute()
    {
        switch ($this->gender) {
            case '1':
                $label = "Male";
                break;

            default:
                $label = "Female";
                break;
        }

        return $label;
    }

    public function getIsActiveLabelAttribute()
    {
        switch ($this->is_active) {
            case '1':
                $label = "Active";
                break;

            default:
                $label = "InActive";
                break;
        }

        return $label;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
}
