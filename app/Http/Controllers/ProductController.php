<?php

namespace App\Http\Controllers;
use App\Repositories\ProductRepository;
use App\Repositories\NotificationRepository;
use App\Repositories\StreamNotificationRepository;
use App\Repositories\MessageRepository;
use App\Repositories\StreamMessageRepository;
use App\Repositories\UserRepository;
use App\Repositories\AuthorizationRepository;
use App\Repositories\PositionRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\SupplierRepository;
use App\Repositories\GroupSpecificationRepository;
use App\Repositories\SpecificationDetailRepository;
use App\Repositories\SpecificationRepository;
use App\Repositories\ImagesRepository;
use App\Repositories\ColorRepository;
use DB;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productRepository;
    protected $notificationRepository;
    protected $streamNotificationRepository;
    protected $messageRepository;
    protected $streamMessageRepository;
    protected $userRepository;
    protected $authorizationRepository;
    protected $positionRepository;
    protected $categoryRepository;
    protected $supplierRepository;
    protected $groupSpecificationRepository;
    protected $specificationDetailRepository;
    protected $specificationRepository;
    protected $imagesRepository;
    protected $colorRepository;
    public function __construct(ProductRepository $productRepository,
                                NotificationRepository $notificationRepository,
                                StreamNotificationRepository $streamNotificationRepository,
                                MessageRepository $messageRepository,
                                StreamMessageRepository $streamMessageRepository,
                                UserRepository $userRepository,
                                AuthorizationRepository $authorizationRepository,
                                PositionRepository $positionRepository,
                                CategoryRepository $categoryRepository,
                                SupplierRepository $supplierRepository,
                                GroupSpecificationRepository $groupSpecificationRepository,
                                SpecificationDetailRepository $specificationDetailRepository,
                                ImagesRepository $imagesRepository,
                                SpecificationRepository $specificationRepository,
                                ColorRepository $colorRepository)
    {
        $this->productRepository = $productRepository;
        $this->notificationRepository = $notificationRepository;
        $this->streamNotificationRepository = $streamNotificationRepository;
        $this->messageRepository = $messageRepository;
        $this->streamMessageRepository = $streamMessageRepository;
        $this->userRepository = $userRepository;
        $this->authorizationRepository = $authorizationRepository;
        $this->positionRepository = $positionRepository;
        $this->categoryRepository = $categoryRepository;
        $this->supplierRepository = $supplierRepository;
        $this->groupSpecificationRepository = $groupSpecificationRepository;
        $this->specificationDetailRepository = $specificationDetailRepository;
        $this->specificationRepository = $specificationRepository;
        $this->imagesRepository = $imagesRepository;
        $this->colorRepository = $colorRepository;
    }

    public function getProducts(Request $request){
        $positions = $this->positionRepository->findByUserId($request->user()->id);
        foreach($positions as $position){
            if($request->user()->can('viewPageProducts', $position)){
                $this->checkNotification($request);
                $notifications = $this->getNotifications($request);
                $messages = $this->getMessages($request);
                $products = $this->productRepository->findAll();
                foreach($products as $product){
                    $thumbnail = $this->imagesRepository->getThumbnailByProductID($product->id);
                    $product['thumbnail'] = $thumbnail;
                }
                return view('Dashboard.Products.Products')->with('notifications', $notifications)
                                                            ->with('messages', $messages)
                                                            ->with('products', $products);
            }
        }
        toast('Bạn không có quyền cho trang sản phẩm','error', 'top-right')->showCloseButton();
        return back();
    }
    public function getAddProduct(Request $request){
        $authorizations = $this->authorizationRepository->findByUserId($request->user()->id);
        foreach($authorizations as $authorization){
            if($request->user()->can('viewAddProduct', $authorization)){
                $notifications = $this->getNotifications($request);
                $messages = $this->getMessages($request);
                $categories = $this->categoryRepository->getSubCategoryAll();
                $suppliers = $this->supplierRepository->findAll();
                $groupSpecificationParents = $this->groupSpecificationRepository->getGroupSpecificationParent();
                foreach($groupSpecificationParents as $groupSpecificationParent)
                {
                    $subGroupSpecifications = $this->groupSpecificationRepository->getSubGroupSpecification($groupSpecificationParent->id);
                    foreach($subGroupSpecifications as $subGroupSpecification)
                    {
                        $specificationDetails = $this->specificationDetailRepository->findByGroupId($subGroupSpecification->id);
                        $subGroupSpecification['specificationDetails'] = $specificationDetails;
                    }
                    $groupSpecificationParent['subGroupSpecifications'] = $subGroupSpecifications;
                }
                return view('Dashboard.Products.AddProducts')->with('notifications', $notifications)
                                                            ->with('messages', $messages)
                                                            ->with('categories', $categories)
                                                            ->with('suppliers', $suppliers)
                                                            ->with('groupSpecificationParents', $groupSpecificationParents);
            }
        }
        toast('Bạn không có quyền thêm sản phẩm','error', 'top-right')->showCloseButton();
        return back();
    }

    public function getManageProducts(Request $request){
        $authorizations = $this->authorizationRepository->findByUserId($request->user()->id);
        foreach($authorizations as $authorization){
            if($request->user()->can('viewAddProduct', $authorization)){
                $notifications = $this->getNotifications($request);
                $messages = $this->getMessages($request);
                $categories = $this->categoryRepository->getCategory();
                foreach($categories as $category){
                    $subcategories = $this->categoryRepository->getSubCategory($category->id);
                    $category['subcategories'] = $subcategories;
                }
                $suppliers = $this->supplierRepository->findAll();
                $groupSpecificationParents = $this->groupSpecificationRepository->getGroupSpecificationParent();
                foreach($groupSpecificationParents as $groupSpecificationParent)
                {
                    $subGroupSpecifications = $this->groupSpecificationRepository->getSubGroupSpecification($groupSpecificationParent->id);
                    foreach($subGroupSpecifications as $subGroupSpecification)
                    {
                        $specificationDetails = $this->specificationDetailRepository->findByGroupId($subGroupSpecification->id);
                        $subGroupSpecification['specificationDetails'] = $specificationDetails;
                    }
                    $groupSpecificationParent['subGroupSpecifications'] = $subGroupSpecifications;
                }
                return view('Dashboard.Products.ManageProducts')->with('notifications', $notifications)
                                                            ->with('messages', $messages)
                                                            ->with('categories', $categories)
                                                            ->with('suppliers', $suppliers)
                                                            ->with('groupSpecificationParents', $groupSpecificationParents);
            }
        }
        toast('Bạn không có quyền thêm sản phẩm','error', 'top-right')->showCloseButton();
        return back();
    }

    public function postAddProduct(Request $request){
        DB::beginTransaction();
        try {
            $prod = [
                'product_name' => $request->name_product,
                'product_description' => $request->description,
                'version' => $request->version,
                'price' => $request->price,
                'discount' => $request->radio_2 == "on" ? $request->discount : 0,
                'categoryid' => $request->category,
                'supplierid' => $request->supplier,
                'quantity' => $request->quantity,
                'product_available' => $request->status,
            ];
            $product = $this->productRepository->create($prod);

            $thumbnail = $request->file('file_thumbnail');
            $imageName = $thumbnail->getClientOriginalName();
            $path = $thumbnail->move(public_path('storage'), $imageName);
            $thumb = [
                'productid' => $product->id,
                'file_name' => $imageName,
                'type' => 'thumbnail',
            ];
            $this->imagesRepository->create($thumb);

            $images = $request->file('images');
            foreach($images as $image){
                $imageName = $image->getClientOriginalName();
                $path = $image->move(public_path('storage'), $imageName);
                $img = [
                    'productid' => $product->id,
                    'file_name' => $imageName,
                    'type' => 'image',
                ];
                $this->imagesRepository->create($img);
            }

            $specifications = $request->input('group_specification');
            foreach($specifications as $specification){
                $specificationDetail = $this->specificationDetailRepository->findById($specification);
                $spec = [
                    'productid' => $product->id,
                    'spec_name' => $specificationDetail->name,
                    'spec_detail_id' => $specification,
                ];
                $this->specificationRepository->create($spec);
            }

            $color = [
                'productid' => $product->id,
                'name_color' => $request->namecolor,
                'code_color' => $request->codecolor,
            ];
            $this->colorRepository->create($color);

            $notification = [
                'userid' => $request->user()->id,
                'position_detail_id' => 2,
                'content' => $request->user()->firstname.' '.$request->user()->lastname.' '.'đã thêm sản phẩm'.' '.'"'.$product->product_description.'"',
                'URL' => 'getProducts',
            ];
            $notification_created = $this->notificationRepository->create($notification);
            $admins = $this->userRepository->findAdmins();
            foreach($admins as $admin){
                $streamNotification = [
                    'notificationid' => $notification_created->id,
                    'userid_src' => $request->user()->id,
                    'userid_dest' => $admin->id,
                    'status' => 0,
                ];
                $this->streamNotificationRepository->create($streamNotification);
            }
            DB::commit();
            toast('Thêm sản phẩm thành công','success','top-right')->showCloseButton();
            return back();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }
    public function getUpdateProduct(Request $request, $id){
        $authorizations = $this->authorizationRepository->findByUserId($request->user()->id);
        foreach($authorizations as $authorization){
            if($request->user()->can('viewUpdateProduct', $authorization)){
                $notifications = $this->getNotifications($request);
                $messages = $this->getMessages($request);
                $categories = $this->categoryRepository->getSubCategoryAll();
                $suppliers = $this->supplierRepository->findAll();
                $groupSpecificationParents = $this->groupSpecificationRepository->getGroupSpecificationOfProduct($id);

                foreach($groupSpecificationParents as $groupSpecificationParent)
                {
                    $subGroupSpecifications = $this->groupSpecificationRepository->getSubGroupSpecificationByGroupIdAndProductId($id, $groupSpecificationParent->id);
                    foreach($subGroupSpecifications as $subGroupSpecification)
                    {
                        $specificationDetails = $this->specificationDetailRepository->findByGroupId($subGroupSpecification->groupid);
                        $specificationOfProduct = $this->specificationRepository->findByGroupIdAndProductId($id, $subGroupSpecification->groupid);
                        $subGroupSpecification->specificationDetails = $specificationDetails;
                        $subGroupSpecification->specificationDetailOfProduct = $specificationOfProduct;
                    }
                    $groupSpecificationParent->subGroupSpecifications = $subGroupSpecifications;
                }
                $product = $this->productRepository->findById($id);
                $thumbnail = $this->imagesRepository->getThumbnailByProductID($id);
                $images = $this->imagesRepository->getImagesByProductID($id);
                $color = $this->colorRepository->findByProductId($id);
                return view('Dashboard.Products.UpdateProducts')->with('notifications', $notifications)
                                                                ->with('messages', $messages)
                                                                ->with('categories', $categories)
                                                                ->with('suppliers', $suppliers)
                                                                ->with('groupSpecificationParents', $groupSpecificationParents)
                                                                ->with('product', $product)
                                                                ->with('thumbnail', $thumbnail)
                                                                ->with('images', $images)
                                                                ->with('color', $color);
            }
        }
        toast('Bạn không có quyền thêm sản phẩm','error', 'top-right')->showCloseButton();
        return back();
    }
    public function postUpdateProduct(Request $request, $id){
        DB::beginTransaction();
        try {
            $product_old = $this->productRepository->findById($id);
            $product_new = [
                'product_name' => $request->name_product,
                'product_description' => $request->description,
                'version' => $request->version,
                'price' => str_replace(".", "", $request->price),
                'discount' => $request->radio_2 == "on" ? $request->discount : 0,
                'categoryid' => $request->category,
                'supplierid' => $request->supplier,
                'quantity' => $request->quantity,
                'product_available' => $request->status,
            ];
            $this->productRepository->update($product_old, $product_new);

            $color_old = $this->colorRepository->findByProductId($id);
            $color_new = [
                'productid' => $id,
                'name_color' => $request->namecolor,
                'codecolor' => $request->codecolor,
            ];
            $this->colorRepository->update($color_old, $color_new);

            $images_old = $this->imagesRepository->getImagesByProductID($id);
            $images_old_input = $request->images_old;
            // dd($images_old_input);
            foreach($images_old as $img){
                if(!$this->ImageOldIsExist($img, $images_old_input)){
                    $this->imagesRepository->delete($img);
                    $filePathOld = public_path('storage/' . $img->file_name);
                    if (file_exists($filePathOld)) {
                        unlink($filePathOld);
                    }
                }
            }
            if($request->hasFile('images')){
                $images_new = $request->file('images');
                foreach($images_new as $image){
                    $imageName = $image->getClientOriginalName();
                    $path = $image->move(public_path('storage'), $imageName);
                    $img = [
                        'productid' => $id,
                        'file_name' => $imageName,
                        'type' => 'image',
                    ];
                    $this->imagesRepository->create($img);
                }
            }
            if($request->hasFile('file_thumbnail')){
                $thumbnail_old = $this->imagesRepository->getThumbnailByProductID($id);
                $this->imagesRepository->delete($thumbnail_old);
                $filePathOld = public_path('storage/' . $thumbnail_old->file_name);
                if (file_exists($filePathOld)) {
                    unlink($filePathOld);
                }

                $thumbnail = $request->file('file_thumbnail');
                $imageName = $thumbnail->getClientOriginalName();
                $path = $thumbnail->move(public_path('storage'), $imageName);
                $img = [
                    'productid' => $id,
                    'file_name' => $imageName,
                    'type' => 'thumbnail',
                ];
                $this->imagesRepository->create($img);
            }

            $specifications_old = $this->specificationRepository->findByProductId($id);
            $specifications_new = $request->input('group_specification');
            foreach($specifications_old as $specification_old){
                if(!$this->SpecificationOldIsExist($specification_old, $specifications_new)){
                    $this->specificationRepository->delete($specification_old);
                }
            }
            
            foreach($specifications_new as $specification_new){
                if(!$this->SpecificaionNewIsExist($specification_new, $specifications_old)){
                    $spec = $this->specificationDetailRepository->findById($specification_new);
                    $specification = [
                        'productid' => $id,
                        'spec_name' => $spec->name,
                        'spec_detail_id' => $spec->id,
                    ];
                    $this->specificationRepository->create($specification);
                }
            }
            $notification = [
                'userid' => $request->user()->id,
                'position_detail_id' => 2,
                'content' => $request->user()->firstname.' '.$request->user()->lastname.' '.'đã cập nhật sản phẩm'.' '.'"'.$product_old->product_description.'"',
                'URL' => 'getProducts',
            ];
            $notification_created = $this->notificationRepository->create($notification);
            $admins = $this->userRepository->findAdmins();
            foreach($admins as $admin){
                $streamNotification = [
                    'notificationid' => $notification_created->id,
                    'userid_src' => $request->user()->id,
                    'userid_dest' => $admin->id,
                    'status' => 0,
                ];
                $this->streamNotificationRepository->create($streamNotification);
            }

            DB::commit();
            toast('Cập nhật sản phẩm thành công','success','top-right')->showCloseButton();
            return back();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }

    public function SpecificationOldIsExist($old, $news){
        foreach($news as $new){
            if($old->spec_detail_id == $new)
            {
                return true;
            }
        }
        return false;
    }
    public function SpecificaionNewIsExist($new, $olds){
        foreach($olds as $old){
            if($new == $old->spec_detail_id){
                return true;
            }
        }
        return false;
    }

    public function ImageOldIsExist($img, $lists):bool{
        foreach($lists as $list){
            if($img->file_name == $list){
                return true;
            }
        }
        return false;
    }

    public function deleteProduct(Request $request, $id){
        $authorizations = $this->authorizationRepository->findByUserId($request->user()->id);
        foreach($authorizations as $authorization){
            if($request->user()->can('deleteProduct', $authorization)){
                DB::beginTransaction();
                try {
                    $product = $this->productRepository->findById($id);
                    $this->productRepository->delete($product);

                    $images = $this->imagesRepository->getImagesProduct($id);
                    foreach($images as $image){
                        $this->imagesRepository->delete($image);
                        $filePathOld = public_path('storage/' . $image->file_name);
                        if (file_exists($filePathOld)) {
                            unlink($filePathOld);
                        }
                    }
                    $specifications = $this->specificationRepository->findByProductId($id);
                    foreach($specifications as $specification){
                        $this->specificationRepository->delete($specification);
                    }
                    $color = $this->colorRepository->findByProductId($id);
                    $this->colorRepository->delete($color);

                    $notification = [
                        'userid' => $request->user()->id,
                        'position_detail_id' => 2,
                        'content' => $request->user()->firstname.' '.$request->user()->lastname.' '.'đã xóa sản phẩm'.' '.'"'.$product->product_description.'"',
                        'URL' => 'getProducts',
                    ];
                    $notification_created = $this->notificationRepository->create($notification);
                    $admins = $this->userRepository->findAdmins();
                    foreach($admins as $admin){
                        $streamNotification = [
                            'notificationid' => $notification_created->id,
                            'userid_src' => $request->user()->id,
                            'userid_dest' => $admin->id,
                            'status' => 0,
                        ];
                        $this->streamNotificationRepository->create($streamNotification);
                    }
                    DB::commit();
                    toast('Xóa sản phẩm thành công','success','top-right')->showCloseButton();
                    return back();
                } catch (Exception $e) {
                    DB::rollBack();
                    throw new Exception($e->getMessage());
                }

            }
        }
        toast('Bạn không có quyền xóa sản phẩm','error', 'top-right')->showCloseButton();
        return back();
    }
}

