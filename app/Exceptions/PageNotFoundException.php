<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class PageNotFoundException extends Exception
{
  public function render($request)
  {
    return response()->view('errors.page-not-found', [], Response::HTTP_NOT_FOUND);
  }
}
