<?php

namespace App\Controller;

use App\Config\App; 
use App\Model\ProductsModel;
use Core\Auth;

class ProductController extends Controller {

    
    public function getAll() {

        $productModel = new ProductsModel();

      ///  if(Auth::isLogin($this->params["token"]))
       // {
            $products = $productModel->getWithOffset($this->params["start"], $this->params["count"]);
            header("Content-type:application/json");
            echo json_encode($products);
//        }
//        else 
//        {
//            echo json_encode(["status"=>"error", "msg"=>"token is invalid"]);
//        }
//     

    }

    public function getProduct() {
        
        $productModel = new ProductsModel();
        $product = $productModel->getByID($this->params["product_id"]);
        if (count($product) != 0) {
            header("Content-type:application/json");
            echo json_encode($product);
        } else {
            header("Content-type:application/json");
            $msg = "product by id " . $this->params["product_id"] . " not found";
            echo json_encode(["status" => "error", "msg" => $msg]);
        }
    }

    public function create() {
        
         if (Auth::isManager())
         {
            $name = $this->params["name"];
            $description = $this->params["description"];
            $short_description = $this->params["short_description"];
            $cat_id = $this->params["cat_id"];
            $price = $this->params["price"];
            $discount = $this->params["discount"];
            
            $url_image = $this->saveImage();
            //echo $url;
            if(!empty($url_image) && $url_image !== null)
            {
                $productModel = new ProductsModel();
                $id = $productModel->save($name, $description, $short_description, $cat_id, $url_image, $price, $discount);
                $this->response->json(["status"=>"succes", "id"=>$id]);
            }
            else 
            {
                $this->response->json(["status" => "error", "msg" => "image upload error"]);
            }
        }
        else 
        {
            $this->response->json(["status" => "error", "msg" => "Login as manager"]);
        }
    }
    
    public function update() {
        
       if(Auth::isManager())
       {
            $id = !empty($this->params["id"]) ? $this->params["id"] : -1;
            $name = $this->params["name"];
            $description = $this->params["description"];
            $short_description = $this->params["short_description"];
            $cat_id = $this->params["cat_id"];
            $price = $this->params["price"];
            $discount = $this->params["discount"];
            $url_image = '';

            if(isset($_FILES["image"]) && !empty($_FILES["image"]["name"]))
            {
                 //$productModel = new ProductsModel();
                $url_image = $this->saveImage();
            }
            
            $productModel = new ProductsModel();
            $id = $productModel->update($id, $name, $description, $short_description, $cat_id, $price, $discount, $url_image);
            $this->response->json(["status" => "succes", "updated_count" => $id]);
        }
       else
       {
           $this->response->json(["status" => "error", "msg" => "Login as manager"]);
       }
    }

    private function saveImage()
    {
        $uploaddir = APP::PATH_TO_UPLOADS . '/';
        $uploadfile = uniqid().basename($_FILES['image']['name']);
   
        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploaddir . $uploadfile))
        {
          $url = APP::siteURL()  . $uploaddir . $uploadfile;   
          //echo $url;
            return $url;
        } 
        else
        {
            return false;
        }
    }

}
