<?php

namespace Roshangara\Webservice\Models;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{

    protected $table = 'webservice_requests';

    protected $fillable = ['class', 'function', 'method', 'protocol', 'contentType', 'url', 'group', 'sender', 'updated_at'];

    /**
     * Responses
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function responses()
    {
        return $this->hasMany(Response::class)->orderBy('id', 'desc');
    }
}