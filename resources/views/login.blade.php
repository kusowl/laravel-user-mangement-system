<x-layout>
    <div class="flex items-center justify-center h-screen flex-col gap-10">
        @if ($errors->hasAny('credentials_mismatch'))
            <x-alert type="error" message="{{ implode($errors->get('credentials_mismatch')) }}"/>
        @endif
        <form enctype="multipart/form-data" method="post" action="{{ route('login') }}">
            <fieldset class="fieldset bg-base-200 border-base-300 rounded-box border p-4">
                <legend class="fieldset-legend text-lg">Login Now !</legend>
                @csrf

                <fieldset class="w-xs space-y-2">

                    <label class="label">Email</label>
                    <input type="email" class="input" placeholder="email@example.com" name="email"
                           value="{{ old('email') }}"/>
                    <span class="text-red-500">{{ implode($errors->get('email')) }}</span>

                    <label class="label">Password</label>
                    <input type="password" class="input" placeholder="* * * * * * * * *" name="password"/>
                    <span class="text-red-500">{{ implode($errors->get('password')) }}</span>

                </fieldset>
                <button class="btn btn-soft btn-accent" type="submit">Submit</button>
                <p class="text-md mt-2">Need an Account ? <a class="hover:text-accent font-bold "
                                                             href="{{ route('register') }}">Register Now !</a></p>
            </fieldset>
        </form>
    </div>
</x-layout>
