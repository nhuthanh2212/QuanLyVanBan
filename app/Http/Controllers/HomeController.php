<?php

namespace App\Http\Controllers;

use App\Models\LoaiVanBan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

use App\Models\VanBanDi;
use Carbon\Carbon;
class HomeController extends Controller
{

    public function session_login(){
        $id = Session::get('id');
        if($id){
            return redirect::to('/home');
        }
        else{
            return redirect::to('/login-manager')->send();
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->session_login();
        // Get counts of documents by type
            $counts = VanBanDi::select('id_LVB', DB::raw('count(*) as count'))
            ->groupBy('id_LVB')
            ->pluck('count', 'id_LVB'); // Plucking count with id_LVB as keys

        // Get all document types
        $documentTypes = LoaiVanBan::all();

        // Prepare data for the chart
        $data = [];
        foreach ($documentTypes as $type) {
            // Check if there is a count for this type
            if ($counts->has($type->id_LVB)) {
                $data[] = [
                    'label' => $type->name, // Assuming 'name' is the column for the document type name
                    'value' => $counts[$type->id_LVB] // Only include types with counts
                ];
            }
        }

        return view('home', compact('data'));
    }
     // lọc ngày tháng năm
     public function filter_by_date(Request $request)
     {
        $data = $request->all();
        $from_date = $data['from_date'];
        $to_date = $data['to_date'];
        
        $get = VanBanDi::selectRaw('DATE(NgayGui) as date, id_LVB, COUNT(*) as count')
            ->whereBetween('NgayGui', [$from_date, $to_date])
            ->groupBy('id_LVB')
            ->orderBy('NgayGui', 'ASC')
            ->with('loaivanban') // Eager load to get the type name of the document
            ->get();
        
        $chart_data = []; // Initialize the variable
        
        foreach ($get as $key => $val) {
            $chart_data[] = array(
                'period' => $val->NgayGui,
                'type' => $val->loaivanban->TenLVB, // Ensure this property exists
                'quantity' => $val->count,
            );
        }
        
        echo json_encode($chart_data);
 
     }
 
     /**
      * Store a newly created resource in storage.
      */
     public function dashboard_filter(Request $request)
     {
         $data = $request->all();
         $dau_thang_nay = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
         $dau_thang_truoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
         $cuoi_thang_truoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();
         $sub7ngay = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString();
         $sub365ngay = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();
         $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
 
         if($data['dashboard_value']=='7ngay'){
             $get = VanBanDi::whereBetween('NgayGui',[$sub7ngay,$now])->orderby('NgayGui','ASC')->get();
         }elseif($data['dashboard_value']=='thangtruoc'){
             $get = VanBanDi::whereBetween('NgayGui',[$dau_thang_truoc,$cuoi_thang_truoc])->orderby('NgayGui','ASC')->get();
         }elseif($data['dashboard_value']=='thangnay'){
             $get = VanBanDi::whereBetween('NgayGui',[$dau_thang_nay,$now])->orderby('NgayGui','ASC')->get();
         }else{
             $get = VanBanDi::whereBetween('NgayGui',[$sub365ngay,$now])->orderby('NgayGui','ASC')->get();
         }
 
         foreach($get as $key => $val){
             $chart_data[] = array(
                 'period' => $val->NgayGui,
                 'order' => $val->total_order,
                 'sales' => $val->sales,
 
                 'profit' => $val->profit,
                 'quantity' => $val->quantity,
             );
         }
         echo $data = json_encode($chart_data);
     }
  
     /**
      * Display the specified resource.
      */
     public function days_order(Request $request)
     {
         
         $sub60days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(60)->toDateString();
         $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
         $get = VanBanDi::whereBetween('NgayGui',[$sub60days,$now])->orderby('NgayGui','ASC')->get();
         foreach($get as $key => $val){
             $chart_data[] = array(
                 'period' => $val->NgayGui,
                 'order' => $val->total_order,
                 'sales' => $val->sales,
 
                 'profit' => $val->profit,
                 'quantity' => $val->quantity,
             );
         }
         echo $data = json_encode($chart_data);
     }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
