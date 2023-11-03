<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\OrderRepository;
use App\Repositories\OrderDetailRepository;
use App\Repositories\CustomerRepository;
use App\Repositories\ProvinceRepository;
use App\Repositories\DistrictRepository;
use App\Repositories\WardRepository;
use Carbon\Carbon;
use App\Mail\MyTestEmail;
use Illuminate\Support\Facades\Mail;
use DB;

class OrderController extends Controller
{
    protected $orderRepository;
    protected $customerRepository;
    protected $orderDetailRepository;
    protected $provinceRepository;
    protected $districtRepository;
    protected $wardRepository;
    public function __construct(OrderRepository $orderRepository,
                                CustomerRepository $customerRepository,
                                OrderDetailRepository $orderDetailRepository,
                                ProvinceRepository $provinceRepository,
                                DistrictRepository $districtRepository,
                                WardRepository $wardRepository){
        $this->orderRepository = $orderRepository;
        $this->customerRepository = $customerRepository;
        $this->orderDetailRepository = $orderDetailRepository;
        $this->provinceRepository = $provinceRepository;
        $this->districtRepository = $districtRepository;
        $this->wardRepository = $wardRepository;
    }

    public function orderProduct(Request $request){
        // $re = $request->data;
        DB::beginTransaction();
        try {
            $customer = [
                'customer_name' => $request->name,
                'phone' => $request->phone,
                'city' => $request->city,
                'district' => $request->district,
                'address' => $request->address,
                'email' => $request->email,
                'status' => 'Active',
            ];
            $customers = $this->customerRepository->findAll();
            if(!$this->checkCustomer($customer['phone'], $customers))
            {
                $customer_real = $this->customerRepository->create($customer);
            }
            else{
                $customer_real = $this->customerRepository->findCustomerByPhone($customer['phone']);
            }

            $order = [
                'customerid' => $customer_real->id,
                'order_date' => Carbon::now()->format('Y-m-d'),
                'status' => 'Ordered',
            ];
            $ordered = $this->orderRepository->create($order);
            $products = $request->data;
            // print_r($products);
            foreach($products as $product){
                $order_detail = [
                    'orderid' => $ordered->id,
                    'productid' => $product['id'],
                    'quantity' => floatval($product['amount']),
                    'price' => $product['price'] * (100 - $product['discount'])/100,
                    'total' => floatval($product['amount'])*($product['price'] * (100 - $product['discount'])/100),
                ];
                $this->orderDetailRepository->create($order_detail);
            }

            DB::commit();   
        }
        catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
        return response()->json('success', 200);

    }
    public function checkCustomer($cus, $customers):bool{
        foreach($customers as $customer){
            if($cus == $customer->phone){
                return true;
            }
        }
        return false;
    }

    public function sendMail(Request $request){
        Mail::to($request->email)->send(new MyTestEmail($request->name));
        return response()->json('success', 200);
    }
    public function getProvince(){
        $provinces = $this->provinceRepository->getAll();
        return response()->json($provinces, 200);
    }
    public function getDistrict(Request $request, $id){
        $districts = $this->districtRepository->getByProvinceId($id);
        return response()->json($districts, 200);
    }
    public function getWard(Request $request, $id){
        $wards = $this->wardRepository->getByDistrictId($id);
        return response()->json($wards, 200);
    }
}
