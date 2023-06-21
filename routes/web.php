<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Models\Post;
use Illuminate\Http\Request;
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
Route::get("/login",[AuthController::class,'login'])->name('auth.login');
Route::delete("/logout",[AuthController::class,'logout'])->name('auth.logout');
Route::post("/login",[AuthController::class,'doLogin']);


Route::prefix('/blog')->name('blog.')->group(function (){
    //appel à la class PostController function index
    Route::get('/', [PostController::class, 'index']
      
    // $post = new Post(); 
    // $post->title = "Mon second article";
    // $post->slug = "mon-second-slug";
    // $post->content = "Mon second contenu";
    // //méthod save permet de sauvgardé les information dans la bdd 
    // $post->save();
    
    //méthod all permet de récupèrer l'ensemble d'article 
    //return Post::all();

    // méthod qui me permet créer un objet à voir dans Post model
    // $post = Post::create([
    //     "title" => "Mon nouveau titre",
    //     "slug" => "mon-slug-test",
    //     "content" => "Nouveau contenu"
    // ]);

    // return $post;
       
        // return [
        //     "link" => \route('blog.show', ['slug' => "article", "id" => 13]),
        // ];
    // return Post::paginate(25);
    )->name("index");
    Route::get('/new', [PostController::class, 'create'])->name('create')->middleware('auth');
    Route::post('/new', [PostController::class, 'store']);
    Route::get('/{post}/edit', [PostController::class, 'edit'])->name('edit')->middleware('auth');
    Route::post('/{post}/edit', [PostController::class, 'update'])->middleware('auth');
    Route::get('/{slug}-{post}',[PostController::class,'show']
        // $post = Post::findOrFail($id);
        // // si le slug dans bdd n'est correspond pas avec le slug que j'ai reçu je suis redirigé vers le bon slug (slug bdd et l'id)
        // if($post->slug !== $slug){
        //     return to_route("blog.show", ["slug" => $post->slug, "id" => $post->id]);
        // }
        // return $post;
        // return [
        //     "slug" => $slug,
        //     "id" => $id,
        //     "name" => $request->input("name")
        // ];
    )->where([
        "slug" => "[a-z0-9\-]+",
        "post" => "[0-9]+"
    ])->name('show');

   
});

