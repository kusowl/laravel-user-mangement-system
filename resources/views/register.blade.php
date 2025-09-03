<x-layout>
    <div class="flex items-center justify-center h-screen">
        <form enctype="multipart/form-data" method="post" action="{{ route('register') }}">
            <fieldset class="fieldset bg-base-200 border-base-300 rounded-box border p-4">
                <legend class="fieldset-legend text-lg">Register an account !</legend>
                @csrf

                <fieldset class="w-xs space-y-2">
                    <label class="label">Name</label>
                    <input type="text" class="input" placeholder="Enter name here..." name="name"
                           value="{{ old('name') }}"/>
                    <span class="text-red-500">{{ implode($errors->get('name')) }}</span>

                    <label class="label">Email</label>
                    <input type="email" class="input" placeholder="email@example.com" name="email"
                           value="{{ old('email') }}"/>
                    <span class="text-red-500">{{ implode($errors->get('email')) }}</span>

                    <label class="label">Password</label>
                    <input type="password" class="input" placeholder="* * * * * * * * *" name="password"/>
                    <span class="text-red-500">{{ implode($errors->get('password')) }}</span>

                    <label class="label">Confirm password</label>
                    <input type="password" class="input" placeholder="* * * * * * * * *" name="password_confirmation"/>
                    <span class="text-red-500">{{ implode($errors->get('password_confirmation')) }}</span>


                    <label class="label block">Profile Image</label>
                    <input type="file" class="file-input" name="profile_image"/>
                    <label class="label text-xs">Max size 2MB</label>
                    <span class="text-red-500">{{ implode($errors->get('profile_image')) }}</span>
                </fieldset>
                <button class="btn btn-soft btn-accent" type="submit">Submit</button>
                <p class="text-md mt-2">Have an Account ? <a class="hover:text-accent font-bold "
                                                             href="{{ route('login') }}">Login Now !</a></p>
            </fieldset>
        </form>
    </div>
</x-layout>
