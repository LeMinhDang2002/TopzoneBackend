<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\GroupSpecificationRepository;
use App\Repositories\SpecificationDetailRepository;

class SpecificationController extends Controller
{
    protected $groupSpecificationRepository;
    protected $specificationDetailRepository;
    public function __construct(GroupSpecificationRepository $groupSpecificationRepository,
                                SpecificationDetailRepository $specificationDetailRepository)
    {
        $this->groupSpecificationRepository = $groupSpecificationRepository;
        $this->specificationDetailRepository = $specificationDetailRepository;
    }
    public function postAddSubGroupSpecification(Request $request){
        $SubGroupSpecification = [
            'name' => $request->name,
            'parentid' => $request->parentid,
        ];
        $this->groupSpecificationRepository->create($SubGroupSpecification);
        toast('Thêm nhóm thông số kỹ thuật thành công','success', 'top-right')->showCloseButton();
        return redirect()->back();
    }

    public function postUpdateSpecification(Request $request){
        $groupid = str_replace('"', '', $request->input('groupid'));
        $name = str_replace('"', '', $request->input('name'));
        $specifications_new = $request->input('specifications');
        $specifications_old = $this->specificationDetailRepository->findByGroupId($groupid);

        foreach($specifications_old as $specification_old){
            if(!$this->SpecificationOldIsExist($specification_old, $specifications_new)){
                $this->specificationDetailRepository->delete($specification_old);
            }
        }

        foreach($specifications_new as $specification_new){
            if(!$this->SpecificationNewIsExist($specification_new, $specifications_old)){
                $str = str_replace('"', '', $specification_new);
                $specification_add = [
                    'name' => $name,
                    'description' => $str,
                    'groupid' => $groupid,
                ];
                $this->specificationDetailRepository->create($specification_add);
            }
        }
        toast('Cập nhật thành công','success', 'top-right')->showCloseButton();
        return response()->json(['success'], 200);
    }
    public function SpecificationNewIsExist($name, $array):bool{
        $str = str_replace('"', '', $name);
        foreach($array as $arr){
            if($str == $arr->description){
                return true;
            }
        }
        return false;
    }

    public function SpecificationOldIsExist($name, $array):bool{
        foreach($array as $arr){
            $str = str_replace('"', '', $arr);
            if($name->description == $str){
                return true;
            }
        }
        return false;
    }
}
