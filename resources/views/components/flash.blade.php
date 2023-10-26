@if(session()->has('message'))
<div class="fixed top-0 left-1/2 bg-laravel text-white px-48 py-3 transform -translate-x-1/2"
x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)"
  x-show="show">
<p class="text-3xl">
  {{session('message')}}
  </p>
  </div>
  @endif