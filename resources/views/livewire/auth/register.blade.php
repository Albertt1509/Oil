<div class="bg-[#dcdcdc]">
    <div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
        <div class="flex h-full items-center">
            <main class="w-full max-w-md mx-auto p-6">
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm text-dark">
                    <div class="p-4 sm:p-7">
                        <div class="text-center">
                            <h1 class="block text-2xl font-bold text-gray-800 ">Sign up</h1>
                            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                                Already have an account?
                                <a class="text-blue-600 decoration-2 hover:underline font-medium dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                                    href="/login">
                                    Sign in here
                                </a>
                            </p>
                        </div>
                        <hr class="my-5 border-slate-300">
                        <!-- Form -->
                        <form wire:submit.prevent="save">
                            <div class="grid gap-y-4">
                                <div>
                                    <label for="name" class="block text-sm mb-2 ">Name</label>
                                    <div class="relative">
                                        <input type="text" id="name" wire:model='name'
                                            class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600">
                                        @error('name')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div>
                                    <label for="email" class="block text-sm mb-2 ">Email address</label>
                                    <div class="relative">
                                        <input type="email" id="email" wire:model='email'
                                            class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600"
                                            required>
                                        @error('email')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div>
                                    <div class="flex justify-between items-center">
                                        <label for="password" class="block text-sm mb-2 ">Password</label>
                                    </div>
                                    <div class="relative">
                                        <input type="password" id="password" wire:model='password'
                                            class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600"
                                            required>
                                        @error('password')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <button type="submit"
                                    class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">Sign
                                    up</button>
                            </div>
                        </form>
                        <!-- End Form -->
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>
