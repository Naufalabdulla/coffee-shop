
@extends('layouts.app')

@section('content')
<h2 class="text-2xl font-bold p-6">Transaction History</h2>

@foreach ($transactions as $t)
<div class="p-4 border m-4 rounded">
<p>Date: {{ $t->created_at }}</p>
<p>Total: Rp {{ number_format($t->total) }}</p>
</div>
@endforeach
@endsection
