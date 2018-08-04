<?php

namespace App\Http\Controllers\Admin\Reports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\Reports\Traits\Report;
use App\Http\Controllers\Admin\Reports\Traits\ProductsReport;
use App\Http\Controllers\Admin\Reports\Traits\CustomersReport;
use App\Http\Controllers\Admin\Reports\Traits\OrdersReport;
use App\Order;
use App\Product;
use App\User;
use Carbon\Carbon;
use CSVReport;

class CSVController extends Controller
{
    /**
     * This Controller uses OrderTrait
     * to provide reusable methods.
     */
    use Report,
        OrdersReport,
        CustomersReport,
        ProductsReport;

    /**
     * Download CSV report.
     * 
     * @return CSVReport
     */
    public function makeCSVReport(Request $request){
        $this->validateDates($request);

        $dateFrom = $request->date_from;
        $dateTo = $request->date_to;
        
        $dates = [
            new Carbon($dateFrom),
            new Carbon($dateTo)
        ];

        switch ($request->type) {
            case "products":
                $title = $this->productReportTitle();
        
                $queryBuilder = Product::whereBetween('created_at',$dates);
        
                $columns = $this->productColumns();
                break;
            
            case "customers":
                $title = $this->customerReportTitle();
        
                $queryBuilder = User::whereBetween('created_at',$dates);
        
                $columns = $this->customerColumns();
                break;
            case "orders":
            default:
                $title = $this->reportTitle();

                $queryBuilder = Order::whereBetween('created_at',$dates);
        
                $columns = $this->orderColumns();
                break;
        }

        $meta = $this->reportMeta(
            $dateFrom,
            $dateTo
        );

        $reportName = $title.' '.$this->fileName($dateFrom,$dateTo);

        return $this->CSVReport(
                $title,
                $meta,
                $queryBuilder,
                $columns,
                $reportName
            );
    }

    /**
     * Generate the actual CSV report
     * 
     * @param string $title
     * @param array $meta
     * @param \Illuminate\Datebase\Eloquent\Builder $queryBuilder
     * @param array $columns
     * @param string $reportName
     * @return CSVReport
     */
    private function CSVReport($title,$meta,$queryBuilder,$columns,$reportName){
        return CSVReport::of(
                $title,
                $meta,
                $queryBuilder,
                $columns
            )
            ->download($reportName);
    }
}
