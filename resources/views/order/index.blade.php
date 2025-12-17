
@extends('layouts.app')

@section('content')
<div class="flex gap-6 p-6">

{{-- MENU --}}
<div class="w-3/4">
<h1 class="text-3xl font-bold mb-6">Coffee Menu</h1>

<div class="grid grid-cols-4 gap-4">
@foreach ($items as $item)
<div class="border rounded-xl p-4 shadow cursor-pointer"
     onclick="location.href='/add-to-cart/{{ $item->id }}'">
<img src="{{ $item->image }}" class="h-24 mx-auto mb-3">
<p class="font-semibold text-center">{{ $item->name }}</p>
<p class="text-center">Rp {{ number_format($item->price) }}</p>
</div>
@endforeach
</div>
</div>

{{-- CART --}}
<div class="w-1/4 bg-white rounded-xl shadow p-5">
<h2 class="text-xl font-bold mb-4">My Order</h2>

@foreach ($cart as $id => $item)
<div class="flex justify-between items-center mb-3">
<div>
<p class="font-semibold">{{ $item['name'] }}</p>
<p class="text-sm">Rp {{ number_format($item['price']) }}</p>
</div>

<div class="flex gap-2 items-center">
<form method="POST" action="/cart-decrease/{{ $id }}">@csrf
<button class="px-2 bg-gray-200">-</button>
</form>

<span>{{ $item['qty'] }}</span>

<form method="POST" action="/cart-increase/{{ $id }}">@csrf
<button class="px-2 bg-gray-200">+</button>
</form>
</div>
</div>
@endforeach

<hr class="my-4">

<p>Subtotal: Rp {{ number_format($subtotal) }}</p>
<p>Tax (10%): Rp {{ number_format($tax) }}</p>
<p class="font-bold text-lg">Total: Rp {{ number_format($total) }}</p>

<form method="POST" action="/pay">@csrf
<button class="w-full mt-4 bg-red-500 text-white py-2 rounded">
Print Bills
</button>
</form>

</div>
</div>
@endsection
