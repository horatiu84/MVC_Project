<?php

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
        require 'src/models/product.php';

        $model = new Product();

        $products = $model->getData();

        require 'views/products_index.php';
    }

    /**
     * Method that will send data in the show view
     * @return void
     */
    public function show()
    {
        require 'views/products_show.php';
    }
}

// those methods inside the controller are called actions