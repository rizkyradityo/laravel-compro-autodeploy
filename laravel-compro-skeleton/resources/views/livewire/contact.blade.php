<div>
    <div class="text-center mb-12">
        <h1 class="text-4xl md:text-5xl font-bold tracking-tight text-white">Contact Us</h1>
        <p class="mt-4 max-w-2xl mx-auto text-slate-300">
            Have a question or want to work together? We'd love to hear from you. Get in touch with us today.
        </p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
        <div>
            <div class="rounded-2xl border border-white/10 bg-white/5 p-8 mb-8">
                <h2 class="text-2xl font-bold text-white mb-6">Get In Touch</h2>
                
                <div class="space-y-6">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 rounded-xl bg-emerald-500/15 flex items-center justify-center">
                                <i class="fas fa-map-marker-alt text-emerald-400"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-white">Visit Us</h3>
                            <p class="text-slate-300">123 Business Street<br>City, State 12345</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 rounded-xl bg-emerald-500/15 flex items-center justify-center">
                                <i class="fas fa-phone text-emerald-400"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-white">Call Us</h3>
                            <p class="text-slate-300">+1 (555) 123-4567</p>
                            <p class="text-slate-400 text-sm">Mon-Fri, 9am-6pm</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 rounded-xl bg-emerald-500/15 flex items-center justify-center">
                                <i class="fas fa-envelope text-emerald-400"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-white">Email Us</h3>
                            <p class="text-slate-300">info@company.com</p>
                            <p class="text-slate-400 text-sm">support@company.com</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="rounded-2xl border border-white/10 bg-white/5 p-8">
                <h2 class="text-xl font-bold text-white mb-4">Follow Us</h2>
                <div class="flex space-x-4">
                    <a href="#" class="w-12 h-12 rounded-xl bg-slate-700 flex items-center justify-center text-slate-200 hover:bg-emerald-500 hover:text-white transition">
                        <i class="fab fa-facebook-f text-xl"></i>
                    </a>
                    <a href="#" class="w-12 h-12 rounded-xl bg-slate-700 flex items-center justify-center text-slate-200 hover:bg-emerald-500 hover:text-white transition">
                        <i class="fab fa-twitter text-xl"></i>
                    </a>
                    <a href="#" class="w-12 h-12 rounded-xl bg-slate-700 flex items-center justify-center text-slate-200 hover:bg-emerald-500 hover:text-white transition">
                        <i class="fab fa-linkedin-in text-xl"></i>
                    </a>
                    <a href="#" class="w-12 h-12 rounded-xl bg-slate-700 flex items-center justify-center text-slate-200 hover:bg-emerald-500 hover:text-white transition">
                        <i class="fab fa-instagram text-xl"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="rounded-2xl border border-white/10 bg-white/5 p-8">
            <h2 class="text-2xl font-bold text-white mb-6">Send a Message</h2>
            
            @if(session('message'))
                <div class="mb-6 rounded-xl border border-emerald-400/20 bg-emerald-500/10 px-4 py-3 text-emerald-200">
                    {{ session('message') }}
                </div>
            @endif

            <livewire:contact-form />
        </div>
    </div>
</div>
