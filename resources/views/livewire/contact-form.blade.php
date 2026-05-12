<div>
    <form wire:submit.prevent="submit">
        <div class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-1">Name *</label>
                    <input type="text" wire:model="name" 
                           class="w-full px-4 py-2 rounded-xl border border-white/10 bg-slate-800/50 text-white placeholder-slate-400 focus:ring-2 focus:ring-emerald-500 focus:border-transparent" 
                           placeholder="Your name">
                    @error('name') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-1">Email *</label>
                    <input type="email" wire:model="email" 
                           class="w-full px-4 py-2 rounded-xl border border-white/10 bg-slate-800/50 text-white placeholder-slate-400 focus:ring-2 focus:ring-emerald-500 focus:border-transparent" 
                           placeholder="your@email.com">
                    @error('email') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-300 mb-1">Subject *</label>
                <input type="text" wire:model="subject" 
                       class="w-full px-4 py-2 rounded-xl border border-white/10 bg-slate-800/50 text-white placeholder-slate-400 focus:ring-2 focus:ring-emerald-500 focus:border-transparent" 
                       placeholder="How can we help?">
                @error('subject') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-300 mb-1">Message *</label>
                <textarea wire:model="message" rows="6" 
                          class="w-full px-4 py-2 rounded-xl border border-white/10 bg-slate-800/50 text-white placeholder-slate-400 focus:ring-2 focus:ring-emerald-500 focus:border-transparent" 
                          placeholder="Tell us more about your project..."></textarea>
                @error('message') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-300 mb-1">Attachment (Optional)</label>
                <input type="file" wire:model="media_id" 
                       class="w-full px-4 py-2 rounded-xl border border-white/10 bg-slate-800/50 text-slate-300 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-emerald-500 file:text-slate-950 file:font-semibold hover:file:bg-emerald-400 focus:ring-2 focus:ring-emerald-500 focus:border-transparent" 
                       accept="image/*,.pdf,.doc,.docx">
                @error('media_id') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                <p class="text-xs text-slate-400 mt-1">Upload images, PDFs, or documents (Max 2MB)</p>
            </div>

            <div>
                <button type="submit" 
                        class="w-full inline-flex items-center justify-center rounded-xl bg-emerald-500 py-3 px-6 font-semibold text-slate-950 hover:bg-emerald-400 transition"
                        wire:loading.attr="disabled">
                    <span wire:loading class="mr-2">
                        <i class="fas fa-spinner fa-spin"></i>
                    </span>
                    {{ __('Send Message') }}
                </button>
            </div>
        </div>
    </form>
</div>
