<x-app-layout>
  <div class="py-12">

    <div class="container">

        <div class="col-md-12">

        <h2>
           <a style="color: blue; font-weight: 600; font-size: 20px;" href="{{ route('posts.index')}}">Все новости здесь</a>
        </h2>

        <br><hr><br>

        <h1>{{$post->name}}</h1>
        <table class="table">
            <tbody>
            <tr>
                <th>
                    Поле
                </th>
                <th>
                    Значение
                </th>
            </tr>
            <tr>
                <td>ID</td>
                <td>{{$post->id}}</td>
            </tr>
            <tr>
                <td>Название</td>
                <td>{{$post->name}}</td>
            </tr>

            <tr>
                <td>Описание</td>
                <td>{{$post->description}}</td>
            </tr>

            <tr>
                <td>Картинка</td>
                <td>
                    <img width="150px" src="{{$post->photo}}">
                </td>
            </tr>

            </tbody>
        </table>
    </div>

    </div>

    </div>

</x-app-layout>

