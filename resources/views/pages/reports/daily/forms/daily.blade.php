@extends('layouts.app')

@section('page-title', 'Explosive Delivery Report')

@section('sidebar')
    @include('components.sidebar')
@endsection


@section('content')
<div class="space-y-6">

    <!-- Flash Messages -->
    @if(session('success'))
    <div class="bg-green-100 border border-brand-green/30 text-brand-green p-4 rounded-xl text-sm font-semibold flex items-center shadow-xs">
        <span class="mr-2">✓</span> {{ session('success') }}
    </div>
    @endif

    <div class="relative bg-white w-full rounded-2xl shadow-xl border border-slate-200 overflow-hidden flex flex-col">
        <!-- Header Section -->
        <div class="px-6 py-4 bg-slate-50 text-brand-navy flex justify-center items-center">
            <p class="px-4 w-full font-bold tracking-wide text-2xl border-0 border-b border-brand-green">Daily Report Form</p>
        </div>

        <!-- Form Container -->
        <form class="flex flex-col flex-1">
            @csrf

            <div class="p-6 space-y-6 flex-1">
                <!-- Date & Basic Info Card -->
                <div class="bg-white p-5 rounded-xl shadow-xs border border-slate-200 grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                    <div>
                        <label for="report_date" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1">
                            Select Date <span class="text-rose-500">*</span>
                        </label>
                        <input type="date" name="report_date" id="report_date" 
                            value="{{ old('report_date', date('Y-m-d')) }}" 
                            class="w-full text-sm rounded-lg border-slate-300 shadow-xs focus:border-indigo-500 focus:ring-indigo-500 p-2.5 border bg-slate-50 font-medium">
                    </div>
                    <div class="md:col-span-2 text-xs text-slate-500 flex items-center gap-2 bg-indigo-50/50 p-3 rounded-lg border border-indigo-100">
                        <svg class="w-5 h-5 text-indigo-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>Please enter the daily consumption values carefully according to the respective product codes and units.</span>
                    </div>
                </div>

                @for($i = 1; $i < 4; $i++)
                <!-- Shift Card -->
                <div class="bg-white p-5 rounded-xl shadow-xs border border-slate-200">
                    <div class="border-b border-slate-100 pb-3 mb-4 flex items-center justify-between space-x-4">
                        <div class="flex items-center justify-between w-full space-x-4">
                            <div class="flex items-center space-x-2">
                                <h3 class="text-sm font-black uppercase tracking-wider text-slate-800 flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-indigo-600"></span>
                                    SHIFT {{ $i }}
                                </h3>
                                <input type="checkbox" name="shift_{{ $i }}_no_blast" id="shift_{{ $i }}_no_blast" value="1" 
                                    class="w-4 h-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
                                <label for="shift_{{ $i }}_no_blast" class="text-sm font-bold uppercase tracking-wider text-slate-600 cursor-pointer">
                                    NO BLAST
                                </label>
                            </div>

                            <button id="shift-{{$i}}" type="button" class="px-4 py-2 rounded-lg bg-brand-green hover:bg-brand-green-hover active:translate-y-0.5 text-white text-sm font-bold transition cursor-pointer flex items-center gap-1.5">
                                <i class="fa-solid fa-circle-plus text-white"></i>
                                Add Row
                            </button>
                        </div>
                    </div> 

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        <!-- 200 - Neogel (Pcs) -->
                        <div class="space-y-1">
                            <label class="block text-xs font-semibold text-slate-600">Neogel 200 <span class="text-[10px] text-slate-400">(Code: 35245 - Pcs)</span></label>
                            <input type="number" step="1" name="neogel_200_pcs" placeholder="0" class="w-full text-sm rounded-lg border-slate-300 p-2 border focus:ring-2 focus:ring-indigo-500">
                        </div>
                        <!-- 200 - Neogel (Kls) -->
                        <div class="space-y-1">
                            <label class="block text-xs font-semibold text-slate-600">Neogel 200 <span class="text-[10px] text-slate-400">(Code: 35245 - Kls)</span></label>
                            <input type="number" step="0.1" name="neogel_200_kls" placeholder="0.0" class="w-full text-sm rounded-lg border-slate-300 p-2 border focus:ring-2 focus:ring-indigo-500">
                        </div>
                        <!-- 215 - Senatel/Pulsar (Pcs) -->
                        <div class="space-y-1">
                            <label class="block text-xs font-semibold text-slate-600">Senatel 215 <span class="text-[10px] text-slate-400">(Code: 11082 - Pcs)</span></label>
                            <input type="number" step="1" name="senatel_215_pcs" placeholder="0" class="w-full text-sm rounded-lg border-slate-300 p-2 border focus:ring-2 focus:ring-indigo-500">
                        </div>
                        <!-- 215 - Senatel/Pulsar (Kls) -->
                        <div class="space-y-1">
                            <label class="block text-xs font-semibold text-slate-600">Senatel 215 <span class="text-[10px] text-slate-400">(Code: 11082 - Kls)</span></label>
                            <input type="number" step="0.1" name="senatel_215_kls" placeholder="0.0" class="w-full text-sm rounded-lg border-slate-300 p-2 border focus:ring-2 focus:ring-indigo-500">
                        </div>
                    </div>
                </div>
                @endfor

                
            </div>

            <!-- Sticky Footer Action Bar -->
            <div class="bg-white border-t border-slate-200 px-6 py-4 flex items-center justify-end gap-3">
                <button type="reset" class="px-4 py-2 text-xs font-bold uppercase tracking-wider text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-lg transition">
                    Clear Form
                </button>
                <button type="submit" class="px-6 py-2 text-xs font-bold uppercase tracking-wider text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg shadow-sm transition">
                    Save Daily Consumption
                </button>
            </div>

        </form>
    </div>

</div>

@endsection


@push('scripts')
<script type="module">
    document.addEventListener('DOMContentLoaded', function() {

        const form = document.querySelector('form');
        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission

            // Collect form data
            const formData = new FormData(form);

            // Send the data using fetch
            // fetch("", {
            //     method: 'POST',
            //     headers: {
            //         'X-CSRF-TOKEN': '{{ csrf_token() }}',
            //     },
            //     body: formData,
            // })
            // .then(response => response.json())
            // .then(data => {
            //     if (data.success) {
            //         alert('Daily consumption saved successfully!');
            //         form.reset(); // Reset the form after successful submission
            //     } else {
            //         alert('Error saving daily consumption. Please try again.');
            //     }
            // })
            // .catch(error => {
            //     console.error('Error:', error);
            //     alert('An unexpected error occurred. Please try again.');
            // });
        });
    });
</script>
@endpush