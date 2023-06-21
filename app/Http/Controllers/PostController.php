<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\BlogFilterRequest;
use App\Http\Requests\CreatePostRequest;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\Hash;

class PostController extends Controller
{
    //
    public function index(BlogFilterRequest $request):View
    {   

        // VALIDATION DES DONNEES A VOIR DANS REQUEST
        //méthode make : 2 parametres sous forme des tableau associatif, un avec le données et le 2éme avec reglé de validation
        // $validator = Validator::make([
        //     'title' => '',
        //     'content' => 'contenu'
        // ],[
        //     // clé proprietes que je souhaite validé et reglé
        //     'title' => ['required', 'min:4']
        // ]);
        // // méthod validated = renvoie que le valeur qui ont été validé par regle des validation
        //dd($request->validated());
            // Creation 2 categories
        // Category::create([
        //     "name" => "Catégorie 1"
        // ]);
        // Category::create([
        //     "name" => "Catégorie 2"
        // ]);
        //charger la relation avec les categories et récupèrer tout les registrement 
         $posts = Post::with('category')->get();
        //    $posts = Post::find(1);
        // $post->category_id = 1;
        // $post->save();
        //dd($post->category->name);

        //asscocié l'article à la category numéro 2
        // $post->category_id = 2;
        // $post->save();
        //parcourir le categories par le nom
        // foreach($posts as $post){
        //     $category = $post->category?->name;
        // }

        //creation de tag
        // $posts->tags()->createMany([[
        //     "name" => "Tag 1"
        // ],[
        //     "name" => "Tag 2"
        // ]]);
        // créer un user
        // User::create([
        //     "name" => "John",
        //     "email" => "john@gmail.fr",
        //     "password" => Hash::make('1234')
        // ]);

        return view("blog.index", [
            // afficher le premier 10 article avec tags et categories
            "posts" => Post::with('tags','category')->paginate(10)

        ]);
    }

    public function show(string $slug, Post $post):RedirectResponse | View
    {
        //$post = Post::findOrFail($post);
        // si le slug dans bdd n'est correspond pas avec le slug que j'ai reçu je suis redirigé vers le bon slug (slug bdd et l'id)
        if($post->slug !== $slug){
            return to_route("blog.show", ["slug" => $post->slug, "post" => $post->id]);
        }
        return view("blog.show", [
            "post" => $post
        ]);
    }

    public function create()
    {
        $post = new Post;
        return view('blog.create', [
            'post' => $post,
            'categories' => Category::select('id','name')->get(),
            'tags' => Tag::select('id','name')->get()

        ]);
    }

    public function store(CreatePostRequest $request)
    {
        // recuperer les information qui on été validé
        $post = Post::create($request->validated());
        return redirect()->route('blog.show', ["slug" => $post->slug, "post" => $post->id])->with("success", "L'article a été bien sauvgarde");
    }
    public function edit(Post $post)
    {
        return view('blog.edit', [
            'post' => $post,
            'categories' => Category::select('id','name')->get(),
            'tags' => Tag::select('id','name')->get()

        ]);
    }
    public function update(Post $post,CreatePostRequest $request)
    {
        $post->update($request->validated());
        $post->tags()->sync($request->validated('tags'));
        return redirect()->route('blog.show', ["slug" => $post->slug, "post" => $post->id])->with("success", "L'article a été bien modifier");

    }
}
