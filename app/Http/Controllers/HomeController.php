<?php

namespace App\Http\Controllers;

use App\Models\LoaiVanBan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\Statistical;
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
      

        return view('home');
    }
     // lọc ngày tháng năm
     public function filter_by_date(Request $request)
     {
        $data = $request->all();
        $from_date = $data['from_date'];
        $to_date = $data['to_date'];
        
        $data = Statistical::with(['loaivanban', 'group'])->whereBetween('date',[$from_date,$to_date])->orderby('date','ASC')
             ->select('id_LVB', 'id_Gr', 'total_LVB', 'total_Gr', 'date')
             ->get()
             ->map(function ($item) {
                 return [
                     'loaivanban_name' => $item->loaivanban->TenLVB ?? 'Không xác định',
                     'group_name' => $item->group->TenGroup ?? 'Không xác định',
                     'total_LVB' => $item->total_LVB,
                     'total_Gr' => $item->total_Gr,
                  
                 ];
             });
        
        echo $data = json_encode($data);
 
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
           
            $datas = Statistical::with(['loaivanban', 'group'])->whereBetween('date',[$sub7ngay,$now])->orderby('date','ASC')
             ->select('id_LVB', 'id_Gr', 'total_LVB', 'total_Gr', 'date')
             ->get()
             ->map(function ($item) {
                 return [
                     'loaivanban_name' => $item->loaivanban->TenLVB ?? 'Không xác định',
                     'group_name' => $item->group->TenGroup ?? 'Không xác định',
                     'total_LVB' => $item->total_LVB,
                     'total_Gr' => $item->total_Gr,
                  
                 ];
             });
         }elseif($data['dashboard_value']=='thangtruoc'){
             
             $datas = Statistical::with(['loaivanban', 'group'])->whereBetween('date',[$dau_thang_truoc,$cuoi_thang_truoc])->orderby('date','ASC')
             ->select('id_LVB', 'id_Gr', 'total_LVB', 'total_Gr', 'date')
             ->get()
             ->map(function ($item) {
                 return [
                     'loaivanban_name' => $item->loaivanban->TenLVB ?? 'Không xác định',
                     'group_name' => $item->group->TenGroup ?? 'Không xác định',
                     'total_LVB' => $item->total_LVB,
                     'total_Gr' => $item->total_Gr,
                  
                 ];
             });
         }elseif($data['dashboard_value']=='thangnay'){
             
             $datas = Statistical::with(['loaivanban', 'group'])->whereBetween('date',[$dau_thang_nay,$now])->orderby('date','ASC')
             ->select('id_LVB', 'id_Gr', 'total_LVB', 'total_Gr', 'date')
             ->get()
             ->map(function ($item) {
                 return [
                     'loaivanban_name' => $item->loaivanban->TenLVB ?? 'Không xác định',
                     'group_name' => $item->group->TenGroup ?? 'Không xác định',
                     'total_LVB' => $item->total_LVB,
                     'total_Gr' => $item->total_Gr,
                  
                 ];
             });
         }else{
          
             $datas = Statistical::with(['loaivanban', 'group'])->whereBetween('date',[$sub365ngay,$now])->orderby('date','ASC')
             ->select('id_LVB', 'id_Gr', 'total_LVB', 'total_Gr', 'date')
             ->get()
             ->map(function ($item) {
                 return [
                     'loaivanban_name' => $item->loaivanban->TenLVB ?? 'Không xác định',
                     'group_name' => $item->group->TenGroup ?? 'Không xác định',
                     'total_LVB' => $item->total_LVB,
                     'total_Gr' => $item->total_Gr,
                  
                 ];
             });
         }
 
        
         echo $data = json_encode($datas);
     }
  
     /**
      * Display the specified resource.
      */
     public function days_order(Request $request)
     {
         
         $sub60days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(60)->toDateString();
         $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
         // Truy vấn dữ liệu và lấy tên liên quan từ các bảng
        $data = Statistical::with(['loaivanban', 'group'])->whereBetween('date',[$sub60days,$now])->orderby('date','ASC')
        ->select('id_LVB', 'id_Gr', 'total_LVB', 'total_Gr', 'date')
        ->get()
        ->map(function ($item) {
            return [
                'loaivanban_name' => $item->loaivanban->TenLVB ?? 'Không xác định',
                'group_name' => $item->group->TenGroup ?? 'Không xác định',
                'total_LVB' => $item->total_LVB,
                'total_Gr' => $item->total_Gr,
             
            ];
        });
       
         echo $data = json_encode($data);
     }

     //don vi ban hanh 
      // lọc ngày tháng năm
      public function filter_by_date_dvbh(Request $request)
      {
         $data = $request->all();
         $from_date = $data['from_date'];
         $to_date = $data['to_date'];
         
         $data = Statistical::with(['loaivanban', 'group'])->whereBetween('date',[$from_date,$to_date])->orderby('date','ASC')
              ->select('id_LVB', 'id_Gr', 'total_LVB', 'total_Gr', 'date')
              ->get()
              ->map(function ($item) {
                  return [
                      'loaivanban_name' => $item->loaivanban->TenLVB ?? 'Không xác định',
                      'group_name' => $item->group->TenGroup ?? 'Không xác định',
                      'total_LVB' => $item->total_LVB,
                      'total_Gr' => $item->total_Gr,
                   
                  ];
              });
         
         echo $data = json_encode($data);
  
      }
  
      /**
       * Store a newly created resource in storage.
       */
      public function dashboard_filter1(Request $request)
      {
          $data = $request->all();
          $dau_thang_nay = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
          $dau_thang_truoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
          $cuoi_thang_truoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();
          $sub7ngay = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString();
          $sub365ngay = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();
          $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
  
          if($data['dashboard_value']=='7ngay'){
            
             $datas = Statistical::with(['loaivanban', 'group'])->whereBetween('date',[$sub7ngay,$now])->orderby('date','ASC')
              ->select('id_LVB', 'id_Gr', 'total_LVB', 'total_Gr', 'date')
              ->get()
              ->map(function ($item) {
                  return [
                      'loaivanban_name' => $item->loaivanban->TenLVB ?? 'Không xác định',
                      'group_name' => $item->group->TenGroup ?? 'Không xác định',
                      'total_LVB' => $item->total_LVB,
                      'total_Gr' => $item->total_Gr,
                   
                  ];
              });
          }elseif($data['dashboard_value']=='thangtruoc'){
              
              $datas = Statistical::with(['loaivanban', 'group'])->whereBetween('date',[$dau_thang_truoc,$cuoi_thang_truoc])->orderby('date','ASC')
              ->select('id_LVB', 'id_Gr', 'total_LVB', 'total_Gr', 'date')
              ->get()
              ->map(function ($item) {
                  return [
                      'loaivanban_name' => $item->loaivanban->TenLVB ?? 'Không xác định',
                      'group_name' => $item->group->TenGroup ?? 'Không xác định',
                      'total_LVB' => $item->total_LVB,
                      'total_Gr' => $item->total_Gr,
                   
                  ];
              });
          }elseif($data['dashboard_value']=='thangnay'){
              
              $datas = Statistical::with(['loaivanban', 'group'])->whereBetween('date',[$dau_thang_nay,$now])->orderby('date','ASC')
              ->select('id_LVB', 'id_Gr', 'total_LVB', 'total_Gr', 'date')
              ->get()
              ->map(function ($item) {
                  return [
                      'loaivanban_name' => $item->loaivanban->TenLVB ?? 'Không xác định',
                      'group_name' => $item->group->TenGroup ?? 'Không xác định',
                      'total_LVB' => $item->total_LVB,
                      'total_Gr' => $item->total_Gr,
                   
                  ];
              });
          }else{
           
              $datas = Statistical::with(['loaivanban', 'group'])->whereBetween('date',[$sub365ngay,$now])->orderby('date','ASC')
              ->select('id_LVB', 'id_Gr', 'total_LVB', 'total_Gr', 'date')
              ->get()
              ->map(function ($item) {
                  return [
                      'loaivanban_name' => $item->loaivanban->TenLVB ?? 'Không xác định',
                      'group_name' => $item->group->TenGroup ?? 'Không xác định',
                      'total_LVB' => $item->total_LVB,
                      'total_Gr' => $item->total_Gr,
                   
                  ];
              });
          }
  
         
          echo $data = json_encode($datas);
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
