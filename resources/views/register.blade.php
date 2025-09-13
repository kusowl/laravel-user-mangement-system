<x-layout>
    <div class="flex h-screen items-center justify-center">
        <form enctype="multipart/form-data" method="post" action="{{ route('register') }}">
            <fieldset class="fieldset bg-base-200 border-base-300 rounded-box border p-4">
                <legend class="fieldset-legend text-lg">Register an account !</legend>
                @csrf

                <fieldset class="w-xs space-y-2">
                    <x-input type="text" label="Name" placeholder="Enter name here..." name="name" />
                    <x-input type="email" placeholder="email@example.com" label="Email" name="email" />
                    <x-input type="password" label="Password" placeholder="* * * * * * * * *" name="password" />
                    <x-input type="password" label="Confirm Password" placeholder="* * * * * * * * *"
                        name="password_confirmed" />
                    <x-input type="file" label="Profile Picture" class="file-input" name="profile_photo" />
                    <label class="label block text-xs">Max size 2MB</label>
                </fieldset>
                <button class="btn btn-soft btn-accent" type="submit">Submit</button>
                <p class="text-md mt-2">Have an Account ? <a class="hover:text-accent font-bold"
                        href="{{ route('login') }}">Login Now !</a></p>
            </fieldset>
        </form>
    </div>
</x-layout>
