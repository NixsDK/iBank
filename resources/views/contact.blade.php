<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Contact Us') }}
        </h2>
    </x-slot>

    <style>
        .dashboard-wrapper {
            padding: 2rem;
        }

        .dashboard-heading {
            font-size: 2rem;
            font-weight: bold;
        }

        .dashboard-text {
            margin-top: 2rem;
            font-size: 1.2rem;
            margin-bottom: 1rem;
        }

        .dashboard-contact {
            font-size: 1.2rem;
            font-weight: bold;
            margin-top: 2rem;
        }

        .dashboard-contact ul {
            margin-top: 1rem;
            list-style-type: disc;
            margin-left: 2rem;
            margin-bottom: 2rem;
        }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg dashboard-wrapper">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="dashboard-heading">Contact Us</h3>
                    <p class="dashboard-text">
                        If you have any questions or concerns, please feel free to reach out to us. Our dedicated
                        support team is available to assist you.
                    </p>
                    <div class="dashboard-contact">
                        <h4 class="dashboard-heading">Contact Information</h4>
                        <ul>
                            <li><i class="fas fa-envelope"></i> Email: support@ibank.com</li>
                            <li><i class="fas fa-phone"></i> Phone: 1-800-123-4567</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
