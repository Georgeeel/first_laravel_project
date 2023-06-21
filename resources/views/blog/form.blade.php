  <form action="" method="post" class="form-group col-8 ">
        @csrf
        <div class="form-group mb-3">
            <label for="title">Titre</label>
            <!-- helpers old affiche la derniere valeur, il prend 2 parametres la cle et message par default  -->
            <input type="text" name="title" id="title" class="form-control" value={{ old('title',$post->title) }}>
            <!-- message en cas d'erreur -->
            @error("title")
            <div class="alert alert-danger">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="slug">Slug</label>
            <input type="text" name="slug" id="slug" class="form-control" value={{ old('Slug',$post->slug) }}>
            @error("slug")
            <div class="alert alert-danger">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class=" form-group mb-3">
        <label for="content">Contenu</label>
            <textarea name="content" id="content" rows="3" class="form-control">{{ old('content',$post->content) }}</textarea>
            @error("content")
            <div class="alert alert-danger">
                {{ $message }}
            </div>
             @enderror
        </div>

        <div class="form-group mb-3">
            <label for="category">Catégorie</label>
            <select name="category_id" id="category" class="form-control">
                <option value="">Selectioner une catégorie</option>
                @foreach($categories as $category)
                <!-- select  automatiqment celle que correspond la valeur qui est déjà present-->
                    <option @selected(old('category_id', $post->category_id) == $category->id)value="{{ $category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
            @error("category_id")
            <div class="alert alert-danger">
                {{ $message }}
            </div>
            @enderror
        </div>
        @php 
            $tagIds = $post->tags()->pluck("id");
        @endphp
        <div class="form-group mb-3">
            <label for="tag">Tag</label>
            <select name="tags[]" id="tag" class="form-control" multiple>
                @foreach($tags as $tag)
                    <option @selected($tagIds->contains($tag->id)) value="{{ $tag->id}}">{{$tag->name}}</option>
                @endforeach
            </select>
            @error("tags")
            <div class="alert alert-danger">
                {{ $message }}
            </div>
            @enderror
        </div>
            <button type="submit" class="btn btn-success">
                <!-- nom button en function d'un creation ou modification -->
                @if($post->id)
                    Modifier
                @else
                    Créer
                @endif
            </button>
    </form>