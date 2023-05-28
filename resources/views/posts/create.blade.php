<x-app-layout>
  <div class="py-12">

    <div class="container">
       <div class="col-md-12">
                @if (session('status'))
                        <div class="alert alert-success text-center" role="alert">
                            <h4>{{ session('status')}}</h4>
                        </div>
                 @endif

                            <h2>
                                <a style="color: blue; font-weight: 700; font-size: 20px;" href="{{ route('posts.index')}}">Все новости здесь</a>
                            </h2>

                             <br><hr><br>
                        @isset($post)
                            <h2>{{'Редактировать новость : '.$post->name}}</h2>
                            <br>
                            <h2>{{'№ : '.$post->id}}</h2>
                        @else
                        <h1>Добавить Категорию</h1>
                        @endisset

                        @isset($post)

                        <form method="POST" enctype="multipart/form-data"
                            action="{{route('posts.update',$post->id)}}">

                        @else

                         <form method="POST" enctype="multipart/form-data"
                             action="{{route('posts.store')}}">
                        @endisset

                              @isset($post)
                                 @method('PUT')
                              @endisset
                              @csrf
                     <div>
                        <br>
                        <div class="input-group row">
                            <label for="name" class="col-sm-2 col-form-label">Название: </label>
                            <div class="col-sm-6">
                             @error('name')
                               <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                               <input
                                 type="text"
                                 class="form-control"
                                 name="name"
                                 value="@isset($post){{$post->name}}@endisset"
                                 required>
                            </div>
                        </div>

                            <br>

                        <div class="input-group row">
                            <label for="description" class="col-sm-2 col-form-label">Описание: </label>
                            <div class="col-sm-6">
                            @error('description')
                            <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                            <textarea name="description" id="description" cols="72" rows="7" required >@isset($post){{$post->description}}@endisset</textarea>
                            </div>
                        </div>

                         <input type="hidden" name="status" value="0">
                                <br>
                                <hr>
                          <div class="input-group row">
                            <div class="col-sm-6">
                            @error('description')
                           <div class="alert alert-danger">{{$message}}</div>
                            @enderror

                            @isset($post)
                            <input type="hidden" class="form-control" name="photo" value="@isset($post){{$post->photo}}@endisset">

                            <img width="100px" src="{{$post->photo}}" alt="{{$post->phofo}}" title="{{$post->name}}">

                           <label class="col-sm-2 col-form-label">Change current photo: </label>
                             <input type="checkbox" name="img" value="111">
                            @endisset

                               </div>
                            </div>
                        </div>

                           <br><hr>
                        <button class="btn btn-success">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

