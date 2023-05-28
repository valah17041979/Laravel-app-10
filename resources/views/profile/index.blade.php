<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

 <div class="container mt-5 mb-5">
        <div class="col-md-12">
        <h1>NEWS</h1>
        <br><hr><br>
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

            </tr>
            @foreach($posts as $post)
                    <tr>
                    <td>{{$post->id}}</td>
                    <td>{{$post->name}}</td>
                    <td>{{$post->description}}</td>
                    <td>
        <img width="150px" src="{{$post->photo}}" alt="">
                    </td>

                </tr>
                @endforeach
               </tbody>
          </table>

           {{ $posts->links() }}
    </div>
  </div>
</x-app-layout>
