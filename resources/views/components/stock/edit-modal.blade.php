<div id="editStockRequestModal" class="fixed inset-0 z-110 flex items-center justify-center p-4 opacity-0 pointer-events-none transition-opacity duration-200">

    <!-- Backdrop -->
    <div class="absolute z-100 inset-0 bg-brand-dark/10 backdrop-blur-xs" onclick="window.closeModal()"></div>

    <!-- Central Window Frame Area -->
    <div class="relative bg-white w-full max-w-lg rounded-2xl shadow-2xl border border-gray-100 overflow-hidden transform transition-all z-110 animate-fade-in">
        
        <!-- Header Strip -->
        <div class="px-6 py-4 bg-brand-green text-white flex justify-between items-center">
            <h3 class="font-bold tracking-wide text-lg">Modify / Evaluate Stock Request</h3>
            <button onclick="window.closeModal()" class="text-white/70 hover:text-white font-bold text-xl cursor-pointer p-1">✕</button>
        </div>

        <!-- Form Layout -->
        <form id="editStockRequestForm" action="" method="POST" class="p-6 space-y-4">
            @csrf
            @method('PUT')
            
            <!-- Item Name (Type) -->
            <div>
                <label for="edit_type" class="block text-xs font-bold text-brand-dark uppercase tracking-wider mb-1">Item Title / Descriptor</label>
                <input type="text" id="edit_type" name="type" required
                    class="w-full bg-gray-50 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:border-brand-gold focus:outline-none transition">
            </div>

            <!-- Kind Field -->
            <div>
                <label for="edit_kind" class="block text-xs font-bold text-brand-dark uppercase tracking-wider mb-1">Category Group</label>
                <select id="edit_kind" name="kind" required class="w-full bg-gray-50 border border-gray-300 rounded-lg p-2 text-sm focus:border-brand-gold focus:outline-none transition">
                    @foreach($kinds as $kindOption)
                        <option value="{{ $kindOption }}">{{ $kindOption }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Status Controls for Signatures -->
            <div>
                <label for="edit_status" class="block text-xs font-bold text-brand-dark uppercase tracking-wider mb-1">Request Review Status</label>
                <select id="edit_status" name="status" required class="w-full bg-gray-50 border border-gray-300 rounded-lg p-2 text-sm focus:border-brand-gold focus:outline-none transition">
                    <option value="pending">Pending Review</option>
                    <option value="approved">Approved & Signed</option>
                    <option value="rejected">Rejected / Cancelled</option>
                </select>
            </div>

            <!-- Footer Bottom Section -->
            <div class="pt-4 flex justify-end space-x-3 border-t border-gray-100">
                <button type="button" onclick="window.closeModal()" class="px-4 py-2 text-sm font-semibold text-gray-500 hover:text-gray-700 transition cursor-pointer">
                    Cancel Process
                </button>
                <button type="submit" class="px-5 py-2 rounded-lg bg-brand-gold hover:bg-brand-gold-hover text-white text-sm font-bold shadow-xs transition cursor-pointer">
                    Apply Modifications
                </button>
            </div>
        </form>

    </div>
</div>