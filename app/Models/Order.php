<?php

namespace App\Models;

use App\Traits\Auditable;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Order extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, Auditable, HasFactory;

    public $table = 'orders';

    public const SHIPMENT_COMPANY_SELECT = [
        'aramex' => 'Aramex',
        'smsa'   => 'SmSa',
    ];

    protected $dates = [
        'pickup_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const DELIVERY_STATUS_SELECT = [
        'pending'   => 'Pending',
        'on_review' => 'On Review',
        'deliverd'  => 'Deliverd',
        'cancelled' => 'Cancelled',
    ];

    protected $fillable = [
        'client_id',
        'shipment_company',
        'order_code',
        'from',
        'to',
        'weight',
        'chargeable',
        'pieces',
        'pickup_date',
        'destination',
        'cash_on_delivery',
        'description',
        'custom_value',
        'delivery_status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function getPickupDateAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setPickupDateAttribute($value)
    {
        $this->attributes['pickup_date'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }
}
