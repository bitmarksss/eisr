@extends('layouts.app')

@section('page-title', " Inventory")

@section('sidebar')
    @include('components.sidebar')
@endsection

@section('modals')
    @include('components.backdrop')

    @if(request()->routeIs('inventory.*'))
        @include('components.add-inventory-modal')
        @include('components.edit-inventory-modal')
        @include('components.inventory.item-modal')
    @endif

    @if(request()->routeIs('surface.inventory.*'))
        @include('components.inventory.receiving-modal')

        @include('components.inventory.stock-card-modal')
        @include('components.inventory.update-and-record-modal')
    @endif
@endsection

@section('content')
<div class="flex justify-center items-center h-full">
<h1 class="font-semi-bold text-6xl text-gray-400">404 Not Found</h1>
</div>
@endsection