@extends('layouts.app')

@section('page-title', $movementType === 'receive' ? 'Receiving Records' : 'Issuance Records')
@section('sidebar') @include('components.sidebar') @endsection
@section('content')
<div class="space-y-6">
    @if(session('success'))
        <div class="bg-green-100 border border-brand-green/30 text-brand-green p-4 rounded-xl text-sm font-semibold flex items-center shadow-xs">
            <span class="mr-2">✓</span>{{ session('success') }}
        </div>
    @endif

    <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Surface Magazine</p>
            <h2 class="text-xl font-bold text-brand-navy mt-1">
            {{ $movementType === 'receive' ? 'Receiving' : 'Issuance' }} Records
            </h2>
        </div>
        <a href="{{ route($movementType === 'receive' ? 'surface.stock.receive.form' : 'surface.stock.issuance.form') }}"
            class="bg-brand-gold hover:bg-brand-gold-hover text-white font-semibold px-4 py-2 rounded-lg shadow transition text-sm cursor-pointer">
            <i class="fa-solid fa-plus mr-1"></i> Create New
        </a>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr>
                    <th class="px-6 py-4 bg-gray-50 text-xs font-bold text-brand-navy uppercase tracking-wider border-b border-gray-200">Date</th>
                    <th class="px-6 py-4 bg-gray-50 text-xs font-bold text-brand-navy uppercase tracking-wider border-b border-gray-200">Reference</th>
                    <th class="px-6 py-4 bg-gray-50 text-xs font-bold text-brand-navy uppercase tracking-wider border-b border-gray-200">Items</th>
                    <th class="px-6 py-4 bg-gray-50 text-xs font-bold text-brand-navy uppercase tracking-wider border-b border-gray-200">Status</th>
                    <th class="px-6 py-4 bg-gray-50 text-xs font-bold text-brand-navy uppercase tracking-wider border-b border-gray-200 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                @forelse($movements as $movement)
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="px-6 py-4 font-medium">{{ $movement->movement_date }}</td>
                        <td class="px-6 py-4 font-semibold text-brand-dark">{{ $movement->reference_no }}</td>
                        <td class="px-6 py-4">{{ $movement->items->count() }} item(s)</td>
                        <td class="px-6 py-4">
                            <span class="px-2.5 py-1 rounded-full text-xs font-bold border {{ $movement->status === 'approved' ? 'bg-green-50 text-brand-green border-brand-green/20' : ($movement->status === 'rejected' ? 'bg-red-50 text-red-700 border-red-200' : 'bg-amber-50 text-brand-gold border-brand-gold/20') }}">
                                {{ str_replace('_', ' ', $movement->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right whitespace-nowrap space-x-2">
                            <button type="button" class="view-movement py-2 px-2.5 bg-brand-navy text-white rounded-lg hover:underline text-xs font-bold cursor-pointer" data-movement='@json($movement)'><i class="fa-solid fa-eye"></i></button>
                            @if($movement->status === 'pending_approval')
                                <button type="button" class="edit-movement py-2 px-2.5 bg-amber-400 text-white rounded-lg hover:underline text-xs font-bold cursor-pointer" data-movement='@json($movement)'><i class="fa-solid fa-pen-to-square"></i></button>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-400 font-medium">No records found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
        </div>
        @if($movements->hasPages())
            <div class="p-4 bg-gray-50 border-t border-gray-100">{{ $movements->links() }}</div>
        @endif
    </div>
</div>
<div id="movementModal" 
    class="hidden fixed inset-0 z-50 bg-black/40 p-6">
    <div class="bg-white rounded-xl max-w-3xl mx-auto p-6">
        <div class="flex justify-between">
            <h3 id="modalTitle" class="font-bold text-lg"></h3>
            <button type="button" onclick="closeMovementModal()">✕</button>
        </div>
        <div id="modalBody" class="mt-4">

        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    const modal=document.getElementById('movementModal'); 
    const body=document.getElementById('modalBody');

    function closeMovementModal() {
        modal.classList.add('hidden')
    }
    document.querySelectorAll('.view-movement')
        .forEach(b => b.onclick=() => {
            const m = JSON.parse(b.dataset.movement);
            
            document.getElementById('modalTitle')
                .textContent = m.reference_no;
            
            body.innerHTML = `<p>Date: ${m.movement_date}</p><p>Status: ${m.status}</p><p class="mt-2">${m.notes??''}</p><ul class="mt-3 list-disc pl-5">${m.items.map(i=>`<li>${i.item?.name??''}: ${i.quantity}</li>`).join('')}</ul>`;modal.classList.remove('hidden')});
    
    document.querySelectorAll('.edit-movement').forEach(b=>b.onclick=()=>{const m=JSON.parse(b.dataset.movement);document.getElementById('modalTitle').textContent='Edit '+m.reference_no;body.innerHTML=`<form method="POST" action="{{ url('/surface/stock/movements') }}/${m.id}">@csrf @method('PUT')<label>Date</label><input class="border p-2 w-full" type="date" name="movement_date" value="${m.movement_date}"><label>Notes</label><textarea class="border p-2 w-full" name="notes">${m.notes??''}</textarea>${m.items.map((i,n)=>`<input class="border p-2 w-full mt-2" type="number" min="1" name="items[${n}][quantity]" value="${i.quantity}"><input type="hidden" name="items[${n}][remarks]" value="${i.remarks??''}">`).join('')}<button class="mt-4 px-4 py-2 bg-brand-gold text-white rounded">Save</button></form>`;modal.classList.remove('hidden')});
</script>@endpush
