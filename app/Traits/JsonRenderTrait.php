<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait JsonRenderTrait
{
    public function render(): JsonResponse
    {
        return response()->json([
            'code'    => str_replace("Exception", "", class_basename(get_class($this))),
            'message' => str_replace('exception.', '', __('exception.' . $this->getMessage()))
        ], $this->getCode());
    }
}
