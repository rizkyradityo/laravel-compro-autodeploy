-- Contact form component

<form wire:submit.prevent="submit">
    <div class="space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Name *</label>
                <input type="text" wire:model="name" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" 
                       placeholder="Your name">
                @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                <input type="email" wire:model="email" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" 
                       placeholder="your@email.com">
                @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Subject *</label>
            <input type="text" wire:model="subject" 
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" 
                   placeholder="How can we help?">
            @error('subject') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Message *</label>
            <textarea wire:model="message" rows="6" 
                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" 
                      placeholder="Tell us more about your project..."></textarea>
            @error('message') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Attachment (Optional)</label>
            <input type="file" wire:model="media_id" 
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" 
                   accept="image/*,.pdf,.doc,.docx">
            @error('media_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            <p class="text-xs text-gray-500 mt-1">Upload images, PDFs, or documents (Max 2MB)</p>
        </div>

        <div>
            <button type="submit" 
                    class="w-full bg-indigo-600 text-white py-3 px-6 rounded-lg font-semibold hover:bg-indigo-700 transition-colors flex items-center justify-center"
                    wire:loading.attr="disabled">
                <span wire:loading="" class="mr-2">
                    <i class="fas fa-spinner fa-spin"></i>
                </span>
                {{ __('Send Message') }}
            </button>
        </div>
    </div>
</form>