@extends('layouts.app')

@section('page-title', $movementType === 'receive' ? 'Receiving Records' : 'Issuance Records')
@section('sidebar') @include('components.sidebar') @endsection
@section('content')
<div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
    <div class="p-5 flex justify-between items-center border-b"><h2 class="text-xl font-bold text-brand-navy">{{ $movementType === 'receive' ? 'Receiving' : 'Issuance' }} Records</h2>
        <a href="{{ route($movementType === 'receive' ? 'surface.stock.receive' : 'surface.stock.issuance') }}" class="px-4 py-2 bg-brand-gold text-white rounded-lg text-sm font-bold">Create New</a></div>
    <div class="overflow-x-auto"><table class="w-full text-sm"><thead class="bg-gray-50 text-left"><tr><th class="p-4">Date</th><th class="p-4">Reference</th><th class="p-4">Items</th><th class="p-4">Status</th><th class="p-4">Actions</th></tr></thead>
    <tbody class="divide-y">@forelse($movements as $movement)<tr><td class="p-4">{{ $movement->movement_date }}</td><td class="p-4 font-semibold">{{ $movement->reference_no }}</td><td class="p-4">{{ $movement->items->count() }}</td><td class="p-4"><span class="px-2 py-1 rounded bg-gray-100">{{ str_replace('_', ' ', $movement->status) }}</span></td><td class="p-4 space-x-2"><button type="button" class="view-movement text-brand-navy underline" data-movement='@json($movement)'>View</button>@if($movement->status === 'pending_approval')<button type="button" class="edit-movement text-brand-gold underline" data-movement='@json($movement)'>Edit</button>@endif</td></tr>@empty<tr><td colspan="5" class="p-8 text-center text-gray-400">No records found.</td></tr>@endforelse</tbody></table></div>
    <div class="p-4">{{ $movements->links() }}</div>
</div>
<div id="movementModal" class="hidden fixed inset-0 z-50 bg-black/40 p-6"><div class="bg-white rounded-xl max-w-3xl mx-auto p-6"><div class="flex justify-between"><h3 id="modalTitle" class="font-bold text-lg"></h3><button type="button" onclick="closeMovementModal()">✕</button></div><div id="modalBody" class="mt-4"></div></div></div>
@endsection
@push('scripts')<script>
const modal=document.getElementById('movementModal'); const body=document.getElementById('modalBody');
function closeMovementModal(){modal.classList.add('hidden')}
document.querySelectorAll('.view-movement').forEach(b=>b.onclick=()=>{const m=JSON.parse(b.dataset.movement);document.getElementById('modalTitle').textContent=m.reference_no;body.innerHTML=`<p>Date: ${m.movement_date}</p><p>Status: ${m.status}</p><p class="mt-2">${m.notes??''}</p><ul class="mt-3 list-disc pl-5">${m.items.map(i=>`<li>${i.item?.name??''}: ${i.quantity}</li>`).join('')}</ul>`;modal.classList.remove('hidden')});
document.querySelectorAll('.edit-movement').forEach(b=>b.onclick=()=>{const m=JSON.parse(b.dataset.movement);document.getElementById('modalTitle').textContent='Edit '+m.reference_no;body.innerHTML=`<form method="POST" action="{{ url('/surface/stock/movements') }}/${m.id}">@csrf @method('PUT')<label>Date</label><input class="border p-2 w-full" type="date" name="movement_date" value="${m.movement_date}"><label>Notes</label><textarea class="border p-2 w-full" name="notes">${m.notes??''}</textarea>${m.items.map((i,n)=>`<input class="border p-2 w-full mt-2" type="number" min="1" name="items[${n}][quantity]" value="${i.quantity}"><input type="hidden" name="items[${n}][remarks]" value="${i.remarks??''}">`).join('')}<button class="mt-4 px-4 py-2 bg-brand-gold text-white rounded">Save</button></form>`;modal.classList.remove('hidden')});
</script>@endpush
