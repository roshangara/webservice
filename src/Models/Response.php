<?php

namespace Roshangara\Webservice\Models;


use Illuminate\Database\Eloquent\Model;

class Response extends Model
{

    protected $table = 'webservice_responses';

    protected $fillable = ['status', 'params', 'response', 'store', 'total_time', 'parsed_response',
                           'info', 'headers', 'related_id', 'user_id', 'updated_at', 'errors'];

    protected $casts = [
        'params'          => 'json',
        'errors' => 'json',
        'parsed_response' => 'json',
        'info'            => 'json',
        'headers'         => 'json',
        'total_time' => 'float',
    ];

    /**
     * Request
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function request()
    {
        return $this->belongsTo(Request::class)->orderBy('id', 'desc');
    }
}