<?php

namespace Roshangara\Webservice\Models;


use Illuminate\Database\Eloquent\Model;

class Request extends Model
{

    protected $table = 'webservice_requests';

    protected $fillable = ['class', 'function', 'method', 'protocol', 'content_type', 'url', 'group', 'sender', 'updated_at'];

    /**
     * Responses.
     * @return mixed
     */
    public function responses()
    {
        return $this->hasMany(Response::class)->orderBy('id', 'desc');
    }
}