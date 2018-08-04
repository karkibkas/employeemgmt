<?php

namespace App\Http\Controllers\Admin\Reports\Traits;

trait OrdersReport{
    
    /**
     * Columns name to display on the report.
     * 
     * @return array
     */
    private function orderColumns(){
        return 
        [
            'ID'             => 'id',
            'Total'          => function($result) {
                return number_format($result->total,2);
            },
            'Address ID'     => 'address_id',
            'Address Line'   => function($result){
                return $result->address->address_1;
            },
            'Postal Code'    => function($result){
                return $result->address->postal_code;
            },
            'City'           => function($result){
                return $result->address->city;
            },
            'Transaction ID' => function($result){
                return $result->payment->transaction_id;
            },
            'Customer ID'    => 'user_id',
            'Customer Email' => function($result){
                return $result->user->email;
            },
            'Status'         => function($result){
                return $result->paid ? 'Paid' : 'Failed';
            },
            'Created at'     => function($result) {
                return $result->created_at->format('d M Y');
            },
            'Updated at'     => function($result) {
                return $result->updated_at->format('d M Y');
            },

        ];
    }

    /**
     * Report Title
     * 
     * @return string
     */
    private function reportTitle(){
        return "Customer Orders Report";
    }

}