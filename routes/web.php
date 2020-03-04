<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',"HomeController@View")->name('home');




// Products
Route::get('/category/{category_name}','CategoryController@ViewCategory')->name('viewcategory');
Route::get('/product/{category_name}/{product_name}','ProductController@ViewProduct')->name('viewproduct');

// Cart
Route::get("/cart",function(){return view('cart');})->name("cart");
Route::get("/deletefromcart/{product_code}","CartController@DeleteFromCart")->name("cartdelete");
Route::post("/addtocart/product/variant/","CartController@VariantCart")->name("addtocart.variant");


// Login  / Register routes
Route::get("/login",function(){return view('authenticate.login');})->name("login");
Route::post("/login","LoginController@Login")->name("login.form");

Route::get("/logout",function(){\Session::flush(); return back();})->name('logout');

Route::get("/register",function(){return view('authenticate.register');})->name("register");
Route::post("/register","RegisterController@Register")->name("register.form");


Route::get("/page/{page_name}","PageController@GetPage")->name('page');


// Auth routes
Route::middleware(['auth'])->group(function () {
    Route::get("/checkout",'CheckoutController@View')->name("checkout");
    
    // Stripe Payment
    Route::post("/handlepayment","CheckoutController@HandlePayment")->name("handlepayment");

    //Paypal
    Route::post("/paypal-transaction-completed","PaypalController@ConfirmOrder")->name("paypal.confirmorder");

});



// Admin non authed
    Route::get('/admin', function () {return view('admin.login');})->name('admin.login');
    Route::post("/admin/login","AdminController@Login")->name("admin.login.post");
    Route::get("/admin/credentials","AdminController@ChangeCredentials")->name("admin.credentials");
    Route::post("/admin/credentials/change","AdminController@ChangeCredentialsHandle")->name("admin.changecredentials");
    
// Admin auth routes
Route::middleware(['auth.admin'])->group(function () {
    Route::get("/admin/dashboard","AdminController@Dashboard")->name("admin.dashboard");

    // Menu items
   Route::post("/getmenuitems","APIController@MenuItems")->name("api.getmenuitems");
   Route::post("/postmenuitem","APIController@PostMenuItem")->name("api.postmenuitem");
   Route::post("/updatemenuitems","APIController@UpdateMenuItems")->name("api.updatemenuitems");


    // Categories
   Route::post("/getcategories","APIController@GetCategories")->name("api.getcategories");
   Route::post("/postcategory","APIController@PostCategory")->name("api.postcategory");
   Route::delete("/postcategory/{id}","APIController@DeleteCategory")->name("api.deletecategory");
   Route::patch("/updatecategory","APIController@UpdateCategory")->name("api.updatecategory");

   // Products
   Route::post("/getproducts","APIController@GetProducts")->name("api.getproducts");
   Route::post("/postproduct","APIController@PostProduct")->name("api.postproduct");
   Route::delete("/postproduct/{id}","APIController@DeleteProduct")->name("api.deleteproduct");
   Route::patch("/updateproduct","APIController@UpdateProduct")->name("api.updateproduct");

   // Variants
   Route::post("/getvariants","APIController@GetVariants")->name("api.getvariants");
   Route::post("/postvariants","APIController@PostVariants")->name("api.postvariants");
   Route::delete("/postvariant/{id}","APIController@DeleteVariant")->name("api.deletevariant");
   Route::patch("/updatevariant","APIController@UpdateVariant")->name("api.updatevariant");

   // Pages
   Route::post("/getpages","APIController@GetPages")->name('api.getpages');
   Route::post("/postpage","APIController@PostPage")->name('api.postpage');
   Route::post("/addpage","APIController@AddPage")->name('api.addpage');
   Route::delete("/postpage/{id}","APIController@DeletePage")->name("api.deleteproduct");



});