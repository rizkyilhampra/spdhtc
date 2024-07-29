<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EmptyRajaOngkirAPIException extends Exception
{
    protected $message = 'RajaOngkir API Key is empty. Please set the RAJAONGKIR_API_KEY in your .env file.';
}
