<x-app-layout>
  <div class="py-12">
        @if(session()->has('danger'))
        <div class="container">
       <p class="alert alert-danger">{{session()->get('danger')}}</p>
        </div>
        @endif
    <div class="container">
        <div class="col-md-12">
        <h1>NEWS</h1>
        <hr>
        <table class="table">
            <tbody>
            <tr>
                <th>
                    №
                </th>
                <th>
                    Название
                </th>
                <th>
                    Текст
                </th>
                <th>
                    Фото
                </th>
                <th>
                    Действия
                </th>
            </tr>
            @foreach($posts as $post)
                    <tr>
                    <td>{{$post->id}}</td>
                    <td>{{$post->name}}</td>
                    <td>{{$post->description}}</td>
                    <td>
        <img width="150px" src="{{$post->photo}}" alt="">
                    </td>
                    <td>
                        <div class="btn-group" role="group">
                            <form action="{{route('posts.destroy',$post)}}" method="POST">

                                <button class="btn btn-success" >
                                    <a href="{{route('posts.show',$post)}}">Открыть</a>
                                </button>

                                <button class="btn btn-warning" >
                                    <a href="{{route('posts.edit',$post)}}">Редактировать</a>
                                </button>

                                <button class="btn btn-danger" >Удалить

                                @csrf
                                @method('DELETE')

                                </button>

                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
       {{ $posts->links() }}

            <hr>
            <button class="btn btn-success mt-3 mb-3" >
              <a href="{{route('posts.create')}}">
                Добавить категорию
              </a>
            </button>
           </div>
        </div>
    </div>
</x-app-layout>

