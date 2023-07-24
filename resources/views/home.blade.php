<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <style>
        .dashboard-wrapper {
            padding: 2rem;
        }

        .dashboard-heading {
            font-size: 2rem;
            font-weight: bold;
            color: #333;
        }

        .dashboard-text {
            margin-top: 2rem;
            font-size: 1.2rem;
            margin-bottom: 1rem;
        }

        .dashboard-images {
            display: flex;
            justify-content: space-between;
            margin-top: 2rem;
        }

        .dashboard-image {
            width: 48%;
            margin-bottom: 1rem;
            border-radius: 0.5rem;
        }

        .dashboard-services {
            font-size: 1.2rem;
            font-weight: bold;
            color: #333;
        }

        .dashboard-services ul {
            margin-top: 1rem;
            list-style-type: disc;
            margin-left: 2rem;
            margin-bottom: 2rem;
        }

        .dashboard-contact {
            font-size: 1.2rem;
            font-weight: bold;
            margin-top: 2rem;
            color: #333;
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
                    @if($showWelcomePopup)
                        <div class="alert-div">
                            <div>
                                <p>Welcome, {{auth()->user()->name}}!</p>
                            </div>
                            <div>
                                <p>Please before anything else enable Google 2FA for security reasons.</p>
                            </div>
                            <div>
                                <a href="/security">Press here!</a>
                            </div>
                        </div>
                    @endif
                    <h3 class="dashboard-heading">Welcome to iBank, {{auth()->user()->name}}!</h3>
                    <p class="dashboard-text">
                        Thank you for choosing iBank as your trusted banking partner. We provide a range of financial
                        services to meet your banking needs.
                    </p>
                    <p class="dashboard-text">
                        With iBank, you can easily manage your accounts, make transactions, view statements, and much
                        more, all in one secure and convenient platform.
                    </p>
                    <div class="dashboard-images">
                        <img
                            src="https://fastly.picsum.photos/id/5/5000/3334.jpg?hmac=R_jZuyT1jbcfBlpKFxAb0Q3lof9oJ0kREaxsYV3MgCc"
                            alt="iBank Image 1" class="dashboard-image">
                        <img
                            src="https://c.pxhere.com/photos/56/81/house_construction_home_money_expensive_finazierung_loan_interest_cost-680069.jpg!d"
                            alt="iBank Image 2" class="dashboard-image">
                    </div>
                    <p class="dashboard-text">
                        At iBank, we pride ourselves on offering a comprehensive range of banking services that are
                        designed to cater to your financial needs. Our online banking platform provides you with
                        seamless access to your accounts, allowing you to manage your finances conveniently from
                        anywhere, at any time. With our mobile banking app, you can stay connected on the go, making
                        transactions, checking balances, and even depositing checks with just a few taps. Our payment
                        services are fast, secure, and efficient, ensuring that your transactions are processed
                        smoothly.
                    </p>
                    <p class="dashboard-text">
                        We understand the importance of efficient account management, which is why we provide intuitive
                        tools and features to help you stay on top of your finances effortlessly. Our money transfer
                        services offer competitive rates and quick processing times, making it easy for you to send and
                        receive funds both domestically and internationally. At iBank, we prioritize the security of
                        your financial information, employing advanced encryption and authentication measures to
                        safeguard your data. Experience the convenience, reliability, and security that make iBank the
                        preferred choice for banking services.
                    </p>
                    <div class="dashboard-services">
                        <h4 class="dashboard-heading">Our Services</h4>
                        <ul>
                            <li>Online Banking</li>
                            <li>Mobile Banking</li>
                            <li>Payment Services</li>
                            <li>Account Management</li>
                            <li>Money Transfers</li>
                            <li>Investments</li>
                            <li>Buy/Sell crypto assets</li>
                        </ul>
                    </div>
                    <p class="dashboard-text">
                        We are committed to providing you with the best banking experience. If you have any questions or
                        concerns, please contact us.
                    </p>
                    <div class="dashboard-contact">
                        <h4 class="dashboard-heading">Contact Us</h4>
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
