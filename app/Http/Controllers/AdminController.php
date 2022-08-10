<?php

namespace App\Http\Controllers;

// use App\Http\Resources\CustomerResource;
// use App\Http\Resources\MechanicResource;
use App\Http\Resources\ProductResource;
// use App\Http\Resources\QueueResource;
use App\Http\Resources\TopCategoriesResource;
use App\Http\Resources\TransactionListResource;
use App\Http\Resources\TransactionResource;
use App\Models\Product;
use App\Models\Sablon;
// use App\Http\Resources\VehicleResource;
// use App\Models\Customer;
// use App\Models\Mechanic;
// use App\Models\Product;
// use App\Models\Queue;
use App\Models\Transaction;
use App\Models\TransactionDetail;
// use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sablon = Sablon::select('category')->distinct()->get();
        // get sablon ID each category
        $sablonId = [];
        foreach ($sablon as $key => $value) {
            $sablonId[$value->category] = Sablon::where('category', $value->category)->select('name', 'id')->distinct()->get();
        }
        // count transaction each sablonId
        $sablonCount = [];
        foreach ($sablonId as $key => $value) {
            $sablonCount[] = [
                'name' => $key,
                'total' => TransactionDetail::whereIn('sablon_type', $value->pluck('id'))->count(),
            ];
        }

        // get most payment in transaction
        $mostPayment = Transaction::select('payment')->distinct()->get();
        $mostPaymentCount = [];
        foreach ($mostPayment as $key => $value) {
            $mostPaymentCount[] = [
                'name' => $value->payment,
                'total' => Transaction::where('payment', $value->payment)->count(),
            ];
        }

        // count transaction this day
        $today = Carbon::now()->format('Y-m-d');
        $todayCount = Transaction::whereDate('created_at', $today)->count();

        // count all transaction
        $allCount = Transaction::count();

        // count all product
        $productCount = Product::count();

        $data = [
            "category" => TopCategoriesResource::collection(Product::select('category')->distinct()->get()),
            "color" => TopCategoriesResource::collection(Product::select('color', 'category')->distinct()->get()),
            "grade" => TopCategoriesResource::collection(Product::select('grade')->distinct()->get()),
            "payment" => $mostPaymentCount,
            "sablon" =>  $sablonCount,
            "curentTransaction" => $todayCount,
            "allTransaction" => $allCount,
            "allProduct" => $productCount,
        ];
        // $sablonType = Sablon::where('category',$sablon->category)->get();
        // $trans = TransactionDetail::whereIn('sablon_type', $sablonType->pluck('id'));


        return json_encode($data);
    }

    public function kaostory()
    {
        $product = Product::all();
        // count transaction each product
        $transaction = [];
        foreach ($product as $key => $value) {
            $transaction[] = [
                'product' => $value,
                'total' => TransactionDetail::where('product_id', $value->id)->count(),
            ];
        }
        $data = [];
        $data['product'] = $transaction;

        return json_encode($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
