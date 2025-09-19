<x-layout class="bg-gradient-to-b from-[#0d0d16] to-[#222831] text-white" data-theme='night'>
    <div class="max-w-9/12 flex flex-col items-center">
        <header
            class="hidden sm:flex justify-between w-full items-center fixed max-w-9/12 z-1 bg-[#22283143] backdrop-blur-sm px-6 py-3 rounded-lg">
            <div class="first-half">
                <div class="logo">
                </div>
                <div class="nav-links">
                    <ul class="flex space-x-3">
                        <li>
                            <a href="/">Home</a>
                        </li>
                        <li>
                            <a href="#features">Features</a>
                        </li>
                        <li>
                            <a href="#techstack">Tech Stack</a>
                        </li>
                        <li>
                            <a href="#contact">Contact</a>
                        </li>
                    </ul>
                </div>
            </div>
            @guest
                <div class="last-half">
                    <x-button><a href="{{ route('login') }}">Login</a></x-button>
                    <x-button class="btn-accent"><a href="{{ route('register') }}">Register</a></x-button>
                </div>
            @endguest
        </header>
        <header class="flex justify-start w-screen ml-6">
            <div class="dropdown sm:hidden">
                <div tabindex="0" role="button" class="btn btn-ghost btn-circle">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h7" />
                    </svg>
                </div>
                <ul tabindex="0"
                    class="menu menu-sm dropdown-content bg-base-100 rounded-box z-1 mt-3 py-2 px-1 w-24 shadow ">
                    <li>
                        <a href="/">Home</a>
                    </li>
                    <li>
                        <a href="#features">Features</a>
                    </li>
                    <li>
                        <a href="#techstack">Tech Stack</a>
                    </li>
                    <li>
                        <a href="#contact">Contact</a>
                    </li>
                    @guest

                        <li>
                            <a href="{{ route('register') }}">Register</a>
                        </li>
                        <li>
                            <a href="{{ route('login') }}">Login</a>
                        </li>

                    @endguest
                </ul>
            </div>
        </header>
        <main class="mt-6">
            {{-- <div class="absolute top-28 z-1 left-1/4 size-72 bg-accent blur-[600px]"></div> --}}
            <hero class="flex flex-col space-y-6 items-center text-center sm:pt-36 pb-24">
                <img src="https://raw.githubusercontent.com/prebuiltui/prebuiltui/main/assets/hero/gridPatternBg.svg"
                    alt="hero-bg" class="absolute top-0 left-0 pointer-events-none w-full ">
                <h1 class="text-4xl sm:text-5xl text-white font-black"><span class="hidden sm:block">User Management
                        System </span><span class="sm:hidden block text-5xl">UMS</span> using Laravel</h1>
                <p class="text-md sm:w-7/12 lg:w-5/12">
                    A scalable User Management System (toy) built with Laravel, designed to simplify user administration
                    and
                    role-based access control.
                </p>
                <div class=""><x-button class="btn-primary"><a href="{{ route('user.show') }}">Explore the
                            Project</a></x-button></div>
            </hero>
            <section class="mb-24">
                <img src="{{ url('images/hero.webp?t-90') }}" alt="">
            </section>
            <section id="features" class="flex flex-col space-y-6 text-center mb-24">
                <h2 class="text-4xl text-white font-black">Features</h2>
                <p class="text-md">
                    Features designed to steamline user management easy, flexible and scalable.
                </p>
                <div class="cards grid md:grid-cols-3 md:grid-rows-2 gap-6">
                    <x-card title="Admin Dashboard" body="Admins can view, edit, and manage all users." />
                    <x-card title="Authentication" body="anual authentication using Laravel's Auth Facade." />
                    <x-card title="Authorization"
                        body="Admins have separate permission for user management, implemented using Laravel's Policy and Gate." />
                    <x-card title="Filter and Sort " body="Search, Soft and Filter user records in dashboad." />
                    <x-card title="Profile Management"
                        body="Users can update their profiles, change passwords, and upload avatars." />
                    <x-card title="Role-Based Access Control"
                        body="Assign roles (Admin, User) and customize permissions to admins." />
                </div>
            </section>

            <section id="techstack" class="flex flex-col space-y-6 text-center mb-24">
                <h2 class="text-4xl text-white font-black">Built on Modern Foundation</h2>
                <p class="text-md">
                    This project is built using industry leading and popular technologies.
                </p>
                <div class="cards grid md:grid-cols-3 md:grid-rows-1 gap-6">
                    <x-card title="Laravel 12"
                        body="The powerful PHP framework providing elegant development and a rich ecosystem." />
                    <x-card title="SQLite"
                        body="SQLite is a lightweight, serverless, self-contained, and highly reliable." />
                    <x-card title="daisyUI"
                        body="A component library for Tailwind CSS, offering ready-made UI components with a clean dim theme." />
                </div>
            </section>

            <section id="contact" class="flex flex-col space-y-6 text-center mb-24">
                <h2 class="text-4xl text-white font-black">Ready to Build Something Great ?</h2>
                <p class="text-md">
                    I can help you to solve your buisness priorities .
                </p>
                <div class="">
                    <x-button class="btn-info"><a href="mailto:kushal.saha@outlook.com">Lets get in touch
                            !</a></x-button>
                </div>
            </section>
        </main>
        <footer>
            <ul class="flex space-x-3">
                <li>
                    <a href="https://github.com/kusowl/laravel-user-mangement-system">Github</a>
                </li>

                <li>
                    <a href="https://www.linkedin.com/in/kusowl/">LinkedIn</a>
                </li>
                <li>
                    <a href="https://www.youtube.com/@kusowl">Youtube</a>
                </li>
            </ul>
        </footer>
    </div>
</x-layout>
