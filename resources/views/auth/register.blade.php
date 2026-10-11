<x-layout>
    <div class="mx-auto mt-10 w-full max-w-xl px-4 pb-12 sm:mt-14">
        <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm sm:p-8">

            <h1 class="text-3xl font-bold tracking-tight text-[#2d2d2d]">
                Create your job seeker account
            </h1>

            <p class="mt-2 mb-8 text-sm leading-6 text-gray-600">
                Create your profile to discover jobs and connect with employers.
            </p>

            <form
                method="POST"
                action="{{ url('/users') }}"
                enctype="multipart/form-data"
            >
                @csrf

                {{-- Personal information --}}
                <x-inputs.text
                    id="name"
                    name="name"
                    label="First name"
                    placeholder="Enter your first name"
                    :required="true"
                />

                <x-inputs.text
                    id="last_name"
                    name="last_name"
                    label="Last name"
                    placeholder="Enter your last name"
                    :required="true"
                />

                <x-inputs.text
                    id="phone"
                    name="phone"
                    type="tel"
                    label="Phone number"
                    placeholder="Enter your phone number"
                    :required="true"
                />

                <x-inputs.text
                    id="city"
                    name="city"
                    label="City"
                    placeholder="Enter your city"
                    :required="true"
                />

                {{-- Account credentials --}}
                <div class="mb-5 border-t border-gray-200 pt-6">
                    <h2 class="mb-1 text-lg font-bold text-[#2d2d2d]">
                        Login credentials
                    </h2>
                    <p class="text-sm text-gray-600">
                        Use these details to sign in to your account.
                    </p>
                </div>

                <x-inputs.text
                    id="email"
                    name="email"
                    type="email"
                    label="Email address"
                    placeholder="Enter your email address"
                    :required="true"
                />

                <x-inputs.text
                    id="password"
                    name="password"
                    type="password"
                    label="Password"
                    placeholder="Create a password"
                    :required="true"
                />

                <x-inputs.text
                    id="password_confirmation"
                    name="password_confirmation"
                    type="password"
                    label="Confirm password"
                    placeholder="Re-enter your password"
                    :required="true"
                />

                {{-- Resume --}}
                <x-inputs.file
                    id="resume"
                    name="resume"
                    label="Resume (PDF or DOC)"
                    :required="true"
                />

                {{-- Optional profile picture --}}
                <x-inputs.file
                    id="photo"
                    name="photo"
                    label="Profile picture (optional)"
                />

                {{-- Optional bio --}}
                <div class="mb-5">
                    <label
                        for="bio"
                        class="mb-2 block text-sm font-semibold text-[#2d2d2d]"
                    >
                        About you
                        <span class="font-normal text-gray-500">(optional)</span>
                    </label>

                    <textarea
                        id="bio"
                        name="bio"
                        rows="4"
                        placeholder="Introduce yourself, your experience, and your career goals"
                        class="w-full rounded-lg border border-[#767676] bg-white px-3 py-3 text-base text-[#2d2d2d] placeholder:text-[#767676] transition-colors hover:border-[#2d2d2d] focus:border-[#2557a7] focus:outline-none focus:ring-2 focus:ring-[#2557a7] focus:ring-offset-1"
                    >{{ old('bio') }}</textarea>

                    @error('bio')
                        <p class="mt-2 text-sm font-medium text-red-700">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Submit --}}
                <button
                    type="submit"
                    class="mt-2 flex h-12 w-full items-center justify-center rounded-lg bg-[#2557a7] px-5 text-base font-bold text-white transition-colors duration-200 hover:bg-[#164081] focus:outline-none focus:ring-2 focus:ring-[#2557a7] focus:ring-offset-2"
                >
                    Create account
                </button>

                <p class="mt-6 text-center text-sm text-gray-600">
                    Already have an account?
                    <a
                        href="{{ url('/login') }}"
                        class="font-semibold text-[#2557a7] hover:underline"
                    >
                        Sign in
                    </a>
                </p>
            </form>
        </div>
    </div>
</x-layout>
