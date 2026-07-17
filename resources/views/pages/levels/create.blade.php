<div id="createLevelModal" class="fixed inset-0 z-110 flex items-center justify-center p-4 opacity-0 pointer-events-none transition-opacity duration-200">

    <!-- Backdrop Layout Grid -->
    <div id="createLevelBackdrop" class="absolute z-100 inset-0 bg-brand-dark/10 backdrop-blur-xs"
    onclick="window.closeModal()"></div>

    <!-- Central Window Frame Area -->
    <div class="relative bg-white w-full max-w-lg rounded-2xl shadow-2xl border border-gray-100 overflow-hidden transform transition-all z-110 animate-fade-in">
        
        <!-- Header Strip -->
        <div class="px-6 py-4 bg-brand-green text-white flex justify-between items-center">
            <h3 class="font-bold tracking-wide text-lg">Establish New Level Tier</h3>
            <button onclick="window.closeModal()" class="text-white/70 hover:text-white font-bold text-xl cursor-pointer p-1">✕</button>
        </div>

        <!-- Master Insertion Submission Form Layout -->
        <form id="createLevelForm" action="" method="POST" class="p-6 space-y-4">
            @csrf
            
            <!-- 1. Level Name / Title -->
            <div>
                <label for="create-level-name" class="block text-xs font-bold text-brand-dark uppercase tracking-wider mb-1">Level Name / Descriptor</label>
                <input type="text" id="create-level-name" name="name" value="{{ old('name') }}" required placeholder="e.g., Tier 1 / Administrator"
                    class="w-full bg-gray-50 border @error('name') border-red-500 @else border-gray-300 @enderror rounded-lg px-3 py-2 text-sm focus:border-brand-gold focus:outline-none transition focus:ring-2 focus:ring-brand-gold/20">
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                
                <!-- 2. Code -->
                <div>
                    <label for="create-level-code" class="block text-xs font-bold text-brand-dark uppercase tracking-wider mb-1">Code</label>
                    <input type="number" id="create-level-code" name="code" value="{{ old('code') }}" required min="1" placeholder="e.g., L1"
                        class="w-full bg-gray-50 border @error('code') border-red-500 @else border-gray-300 @enderror rounded-lg px-3 py-2 text-sm focus:border-brand-gold focus:outline-none transition focus:ring-2 focus:ring-brand-gold/20">
                    @error('code') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                
                <!-- 3. Rank / Order Value -->
                <div>
                    <label for="create-level-order" class="block text-xs font-bold text-brand-dark uppercase tracking-wider mb-1">Rank / Priority Order</label>
                    <input type="number" id="create-level-order" name="level_order" value="{{ old('level_order') }}" required min="1" placeholder="e.g., 1"
                        class="w-full bg-gray-50 border @error('level_order') border-red-500 @else border-gray-300 @enderror rounded-lg px-3 py-2 text-sm focus:border-brand-gold focus:outline-none transition focus:ring-2 focus:ring-brand-gold/20">
                    @error('level_order') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- 4. Level Description / Details Area -->
            <div>
                <label for="create-level-desc" class="block text-xs font-bold text-brand-dark uppercase tracking-wider mb-1">Functional Responsibility / Scope</label>
                <textarea id="create-level-desc" name="description" placeholder="Summarize permissions or baseline privileges for this tier..." rows="3"
                    class="w-full bg-gray-50 border @error('description') border-red-500 @else border-gray-300 @enderror rounded-lg px-3 py-2 text-sm focus:border-brand-gold focus:outline-none transition focus:ring-2 focus:ring-brand-gold/20">{{ old('description') }}</textarea>
                @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Footer Bottom Section -->
            <div class="pt-4 flex justify-end space-x-3 border-t border-gray-100">
                <button type="button" onclick="window.closeModal()" class="px-4 py-2 text-sm font-semibold text-gray-500 hover:text-gray-700 transition cursor-pointer">
                    Cancel Process
                </button>
                <button type="submit" class="px-5 py-2 rounded-lg bg-brand-gold hover:bg-brand-gold-hover text-white text-sm font-bold shadow-xs transition cursor-pointer">
                    Commit Level Config
                </button>
            </div>
        </form>

    </div>
</div>