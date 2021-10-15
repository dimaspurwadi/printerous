<?php
namespace App\Lib\Service;

use App\Model\Product;
use App\Model\ProductWarna;
use App\Model\ProductGambar;
use App\Model\ProductUkuran;
use DB;

class StoreProduct
{
    public function __construct($params, $product = null, $action = 'add')
    {
        $this->action = $action;
        $this->params = $params;
        $this->product = $product;
        $this->productWarna = new ProductWarna;
        $this->productGambar = new ProductGambar;
        $this->productUkuran = new ProductUkuran;
    }

    public function run()
    {
        $error = null;
        try {
            DB::beginTransaction();
            /**add product */
            $product = $this->getProduct();
            $product->fill($this->params);
            $product->save();

            if ($this->action == 'add') {
                /**add product gambar */
                foreach ($this->params['gambar'] as $row) {
                    $productGambar = new ProductGambar;
                    $productGambar->product_id = $product->id;
                    $productGambar->name = $row;
                    $productGambar->save();
                }

                /**add product warna */
                foreach ($this->params['warna'] as $row) {
                    $productWarna = new ProductWarna;
                    $productWarna->product_id = $product->id;
                    $productWarna->name = $row;
                    $productWarna->save();
                }

                /**add product ukuran */
                foreach ($this->params['ukuran'] as $row) {
                    $productUkuran = new ProductUkuran;
                    $productUkuran->product_id = $product->id;
                    $productUkuran->name = $row['size'];
                    $productUkuran->price = $row['harga'];
                    $productUkuran->save();
                }
            }

            DB::commit();
            return [$error, $product];
        } catch(\Exception $e) {
            DB::rollback();
            return [$e->getMessage(), null];
        }
    }

    private function getProduct()
    {
        return is_null($this->product) ? new Product(): $this->product;
    }
    
}