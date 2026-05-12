-- Contact page content

<div class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900">Contact Us</h1>
            <p class="text-gray-600 mt-4 max-w-2xl mx-auto">
                Have a question or want to work together? We'd love to hear from you. Get in touch with us today.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Contact Information -->
            <div>
                <div class="bg-white rounded-lg shadow-md p-8 mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Get In Touch</h2>
                    
                    <div class="space-y-6">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-indigo-600 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-map-marker-alt text-white"></i>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-900">Visit Us</h3>
                                <p class="text-gray-600">123 Business Street<br>City, State 12345</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-indigo-600 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-phone text-white"></i>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-900">Call Us</h3>
                                <p class="text-gray-600">+1 (555) 123-4567</p>
                                <p class="text-gray-500 text-sm">Mon-Fri, 9am-6pm</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-indigo-600 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-envelope text-white"></i>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-900">Email Us</h3>
                                <p class="text-gray-600">info@company.com</p>
                                <p class="text-gray-500 text-sm">support@company.com</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Social Media -->
                <div class="bg-white rounded-lg shadow-md p-8">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Follow Us</h2>
                    <div class="flex space-x-4">
                        <a href="#" class="w-12 h-12 bg-blue-600 rounded-lg flex items-center justify-center text-white hover:bg-blue-700 transition-colors">
                            <i class="fab fa-facebook-f text-xl"></i>
                        </a>
                        <a href="#" class="w-12 h-12 bg-blue-400 rounded-lg flex items-center justify-center text-white hover:bg-blue-500 transition-colors">
                            <i class="fab fa-twitter text-xl"></i>
                        </a>
                        <a href="#" class="w-12 h-12 bg-blue-700 rounded-lg flex items-center justify-center text-white hover:bg-blue-800 transition-colors">
                            <i class="fab fa-linkedin-in text-xl"></i>
                        </a>
                        <a href="#" class="w-12 h-12 bg-pink-500 rounded-lg flex items-center justify-center text-white hover:bg-pink-600 transition-colors">
                            <i class="fab fa-instagram text-xl"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="bg-white rounded-lg shadow-md p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Send a Message</h2>
                
                @if(session('message'))
                    <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                        {{ session('message') }}
                    </div>
                @endif

                <livewire:contact-form />
            </div>
        </div>
    </div>
</div>