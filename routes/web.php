<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// static route

Route::get('greeting',fn()=>"min ga lar par");
// Route::get('say-my-name',function(){
//     $firstName = "hein";
//     $lastName = "htet";
//     return $firstName." ".$lastName;
// });

Route::get('say-my-name/{name?}',function($name = "abc"){
    return "My name is" . $name;
});

Route::get("fruits",fn()=>["apple","mango","banana","orange"]);

// dynamic route

// Route::get('area/{width}/{height}',function($width,$height){
//     return  "Area is " . ( $width * $height ) . " sqft";
// });


Route::get('area/{width}/{height}',fn($width,$height) => $width * $height);

Route::get('/products',function(){
    $products = file_get_contents('https://fakestoreapi.com/products');
    // dd(json_decode($products));

    return $products;
});

Route::get('/products/price-max/{amount}',function($amount){
    // $products = file_get_contents('https://fakestoreapi.com/products');
    // $productsArray = json_decode($products);
    // // dd($productsArray);
    // $filterProducts = array_filter($productsArray,fn($products)=> $products->price > $amount);
    // // dd($filterProducts);
    // return $filterProducts;


    // cURL error 60: SSL certificate problem: unable to get local issuer certificate
    // $res = Http::get('https://fakestoreapi.com/products');
    // dd($res->collect()->where("price","<",$amount));
    // return $res;

});

Route::get('/products/price-min/{amount}',function($amount){
    $products = file_get_contents('https://fakestoreapi.com/products');
    $productsArray = json_decode($products);
    // dd($productsArray);
    $filterProducts = array_filter($productsArray,fn($products)=> $products->price < $amount);
    // dd($filterProducts);
    return $filterProducts;

    // return Http::get('https://fakestoreapi.com/products')->collect()->where("price","<",$amount);

});

Route::get('/products/price-between/{min}/and/{max}',function($min,$max){
    $products = file_get_contents('https://fakestoreapi.com/products');
    $productsArray = json_decode($products);
    // dd($productsArray);
    $filterProducts = array_filter($productsArray,fn($products)=> $products->price > $min && $products->price < $max);
    // dd($filterProducts);
    return $filterProducts;

    // return Http::get("https://fakestoreapi.com/products")->collect()->whereBetween("price",[$min,$max]);
});
