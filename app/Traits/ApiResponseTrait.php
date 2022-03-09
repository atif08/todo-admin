<?php namespace App\Traits;

trait ApiResponseTrait
{

   protected function successResponse( $data, $message = 'OK', $code = 200 ) {
        return response()->json(
            [
                'status'  => true,
                'message' => $message,
                'meta'    => ( isset( $data[ 'meta' ] ) ) ? $data[ 'meta' ] : null,
                'data'    => ( isset( $data[ 'data' ] ) ) ? $data[ 'data' ] : $data,
            ],
            $code
        );
    }

    protected function successResponseWordpress( $data,$expireDate, $message = 'OK', $code = 200 ) {
        return response()->json(
            [
                'status'  => true,
                'message' => $message,
                'expire_date' => $expireDate,
                'meta'    => ( isset( $data[ 'meta' ] ) ) ? $data[ 'meta' ] : null,
                'data'    => ( isset( $data[ 'data' ] ) ) ? $data[ 'data' ] : $data,
            ],
            $code
        );
    }



    protected function failureResponse( $message, $code = 400,$errors='' ) {
        return response()->json(
            [
                'code'    => $code,
                'status'  => false,
                'message' => $message,
                'errors'=>$errors,
            ],
            $code
        );
    }
}
