<x-layout>
  @include('partials._hero')
  @include('partials._search')



  <div class="mx-4">
    <div class="bg-gray-50 border border-gray-200 p-10 rounded">
      <header>
        @if (!$listings->count())
        <h1 class="text-3xl text-center font-bold my-6 uppercase">
          You have no gigs
        </h1>
        @endif
      </header>

      <table class="w-full table-auto rounded-sm">
        <tbody>
          @foreach ($listings as $listing)
            
          <tr class="border-gray-300">
            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
              <a href="/listings/{{$listing->id}}">
               {{$listing->title}}
              </a>
            </td>
            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
              <a href="/listings/{{$listing->id}}/edit" class="text-blue-400 px-6 py-2 rounded-xl"><i class="fa-solid fa-pen-to-square"></i>
                Edit</a>
            </td>
            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
              <form action="/listings/{{$listing->id}}/delete" method="post">
                @csrf
                @method("DELETE")
                <button class="text-red-500"><i class="fa-solid fa-trash"></i> Delete</button>
                </form>
            </td>
          </tr>
          @endforeach

         
        </tbody>
      </table>
    </div>
  </div>

  <div class="mt-6 p-4">
    {{ $listings->links() }}
  </div>
</x-layout>