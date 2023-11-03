<?php

namespace App\Http\Controllers;
use App\Repositories\PositionRepository;
use App\Repositories\SupplierRepository;

use Illuminate\Http\Request;

class SupplierController extends Controller
{
    protected $supplierRepository;
    protected $positionRepository;
    public function __construct(PositionRepository $positionRepository,
                                SupplierRepository $supplierRepository)
    {
        $this->positionRepository = $positionRepository;
        $this->supplierRepository = $supplierRepository;
    }

    public function postUpdateSupplier(Request $request){
        $positions = $this->positionRepository->findByUserId($request->user()->id);
        foreach($positions as $position){
            if($request->user()->can('addSupplier', $position)){
                $suppliers_new = $request->input('suppliers');
                $suppliers_old = $this->supplierRepository->findAll();
                foreach($suppliers_old as $supplier_old){
                    if(!$this->SupplierOldIsExist($supplier_old, $suppliers_new)){
                        $this->supplierRepository->delete($supplier_old);
                    }
                }

                foreach($suppliers_new as $supplier_new){
                    if(!$this->SupplierNewIsExist($supplier_new, $suppliers_old)){
                        $str = str_replace('"', '', $supplier_new);
                        $supplier_add = [
                            'name' => $str,
                        ];
                        $this->supplierRepository->create($supplier_add);
                    }
                }
                toast('Cập nhật nhà cung cấp thành công','success', 'top-right')->showCloseButton();
                return response()->json(['success'], 200);
            }
        }
        toast('Bạn không có quyền thêm nhà cung cấp','error', 'top-right')->showCloseButton();
        return response()->json([], 200);
    }

    public function SupplierNewIsExist($name, $array):bool{
        $str = str_replace('"', '', $name);
        foreach($array as $arr){
            if($str == $arr->name){
                return true;
            }
        }
        return false;
    }

    public function SupplierOldIsExist($name, $array):bool{
        foreach($array as $arr){
            $str = str_replace('"', '', $arr);
            if($name->name == $str){
                return true;
            }
        }
        return false;
    }
}
