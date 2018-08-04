<?php

namespace App\Http\Controllers\Admin\Reports\Traits;

trait ProductsReport
{
    /**
     * Columns name/manipulated values to display on the report.
     * 
     * @return array
     */
    private function productColumns(){
        return 
        [
            'ID'          => 'id',
            'Name'        => 'title',
            'Description' => 'description',
            'Rating'      => function($result){
                return $result->reviews->avg('rating') ? : 'None';
            },
            'Category'    => 'category',
            'Quantity'    => 'quantity',
            'Created at'  => function($result) {
                return ($result->created_at->format('d M Y'));
            },
            'Updated at'  => function($result) {
                return $result->updated_at->format('d M Y');
            },

        ];
    }

    /**
     * Report Title
     * 
     * @return string
     */
    private function productReportTitle(){
        return "Products Report";
    }
}
