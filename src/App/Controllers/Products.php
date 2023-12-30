<?php

namespace App\Controllers;

use App\Models\Product;
use Framework\Viewer;
/**
 * Class that will make the connection between the user and the app data(database)
 * in our case it will take the request from the user,send it to the model,take the
 * data that came from there and send it to the view so that the user can see it
 */
class Products
{
    /**
     * A method that will send data in the index view
     * @return void
     */
    public function index(): void
    {

        $model = new Product();

        $products = $model->getData();

        $viewer = new Viewer();

        $viewer->render("products_index.php",[
            "products"=>$products
        ]);
    }

    /**
     * Method that will send data in the show view
     * @return void
     */
    public function show(string $id=NULL)
    {
        var_dump($id);
        require 'views/products_show.php';
    }

    public function showPage(string $title, string $id,string $page)
    {
        echo $title, " ", $id, " ", $page;
    }
}

// those methods inside the controller are called actions