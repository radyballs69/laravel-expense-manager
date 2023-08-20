<?php

namespace App\Traits;

trait ResponseTrait
{
    /**
     * Response for created
     * 
     * @return array
     */
    public function responseCreated()
    {
        return [
            'status' => config('global.status.success'),
            'message' => 'Record has been created!',
        ];
    }

    /**
     * Response for update
     * 
     * @return array
     */
    public function responseUpdated()
    {
        return [
            'status' => config('global.status.success'),
            'message' => 'Record has been updated!',
        ];
    }

    /**
     * Response for update
     * 
     * @return array
     */
    public function responseDeleted()
    {
        return [
            'status' => config('global.status.success'),
            'message' => 'Record has been deleted!',
        ];
    }
}
