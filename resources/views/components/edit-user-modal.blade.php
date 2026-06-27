<div id="editUserModal" class="fixed inset-0 z-110 flex items-center justify-center p-4 opacity-0 pointer-events-none transition-opacity duration-200">
    <!-- Backdrop Layout Grid -->
    <div class="absolute z-100 inset-0 bg-brand-dark/10 backdrop-blur-xs" onclick="window.closeModal()"></div>

    <!-- Central Window Frame Area -->
    <div class="relative bg-white w-full max-w-xl rounded-2xl shadow-2xl border border-gray-100 overflow-hidden transform transition-all z-110 animate-fade-in">
        
        <!-- Header Strip -->
        <div class="px-6 py-4 bg-brand-green text-white flex justify-between items-center">
            <h3 class="font-bold tracking-wide text-lg">Modify Account Details</h3>
            <button onclick="window.closeModal()" class="text-white/70 hover:text-white font-bold text-xl cursor-pointer p-1">✕</button>
        </div>

        <!-- Master Update Form Layout -->
        <form id="editUserForm" action="" method="POST" class="p-6 space-y-4">
            @csrf
            @method('PUT')
            
            <!-- Name Block (Split Inputs) -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label for="edit_first_name" class="block text-xs font-bold text-brand-dark uppercase tracking-wider mb-1">First Name</label>
                    <input type="text" id="edit_first_name" name="first_name" required
                        class="w-full bg-gray-50 border @error('first_name') border-red-500 @else border-gray-300 @enderror rounded-lg px-3 py-2 text-sm focus:border-brand-gold focus:outline-none transition">
                    @error('first_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="edit_middle_name" class="block text-xs font-bold text-brand-dark uppercase tracking-wider mb-1">Middle Name</label>
                    <input type="text" id="edit_middle_name" name="middle_name" placeholder="(Optional)"
                        class="w-full bg-gray-50 border @error('middle_name') border-red-500 @else border-gray-300 @enderror rounded-lg px-3 py-2 text-sm focus:border-brand-gold focus:outline-none transition">
                    @error('middle_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="edit_last_name" class="block text-xs font-bold text-brand-dark uppercase tracking-wider mb-1">Last Name</label>
                    <input type="text" id="edit_last_name" name="last_name" required
                        class="w-full bg-gray-50 border @error('last_name') border-red-500 @else border-gray-300 @enderror rounded-lg px-3 py-2 text-sm focus:border-brand-gold focus:outline-none transition">
                    @error('last_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Credentials Block -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="edit_username" class="block text-xs font-bold text-brand-dark uppercase tracking-wider mb-1">Username</label>
                    <input type="text" id="edit_username" name="username" required
                        class="w-full bg-gray-50 border @error('username') border-red-500 @else border-gray-300 @enderror rounded-lg px-3 py-2 text-sm focus:border-brand-gold focus:outline-none transition">
                    @error('username') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="edit_email" class="block text-xs font-bold text-brand-dark uppercase tracking-wider mb-1">Email Address</label>
                    <input type="email" id="edit_email" name="email" required
                        class="w-full bg-gray-50 border @error('email') border-red-500 @else border-gray-300 @enderror rounded-lg px-3 py-2 text-sm focus:border-brand-gold focus:outline-none transition">
                    @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Role Mapping Selection -->
            <div>
                <label for="edit_role_id" class="block text-xs font-bold text-brand-dark uppercase tracking-wider mb-1">System Permissions Role</label>
                <select id="edit_role_id" name="role_id" required
                    class="w-full bg-gray-50 border @error('role_id') border-red-500 @else border-gray-300 @enderror rounded-lg p-2.5 text-sm focus:border-brand-gold focus:outline-none transition">
                    <option value="1">Administrator</option>
                    <option value="2">Staff / Inventory Clerk</option>
                    <option value="3">Viewer</option>
                </select>
                @error('role_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Optional Password Block -->
            <div class="bg-gray-50 p-4 rounded-xl border border-gray-200 space-y-3">
                <span class="text-xs font-bold text-brand-navy block uppercase tracking-wider">Change Password (Leave blank to keep current)</span>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <input type="password" id="edit_password" name="password" placeholder="New Password"
                            class="w-full bg-white border @error('password') border-red-500 @else border-gray-300 @enderror rounded-lg px-3 py-2 text-sm focus:border-brand-gold focus:outline-none transition">
                        @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <input type="password" id="edit_password_confirmation" name="password_confirmation" placeholder="Confirm New Password"
                            class="w-full bg-white border border-gray-300 rounded-lg px-3 py-2 text-sm focus:border-brand-gold focus:outline-none transition">
                    </div>
                </div>
            </div>

            <!-- Footer Bottom Section -->
            <div class="pt-4 flex justify-end space-x-3 border-t border-gray-100">
                <button type="button" onclick="window.closeModal()" class="px-4 py-2 text-sm font-semibold text-gray-500 hover:text-gray-700 transition cursor-pointer">
                    Cancel
                </button>
                <button type="submit" class="px-5 py-2 rounded-lg bg-brand-gold hover:bg-brand-gold-hover text-white text-sm font-bold shadow-xs transition cursor-pointer">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>