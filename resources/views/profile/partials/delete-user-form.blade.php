<section class="space-y-6">
    <header>
        <h2 class="text-4xl font-black uppercase text-black">
            Delete Account
        </h2>

        <p class="mt-2 text-black font-bold text-sm max-w-xl">
            Once deleted, all your account data and resources will be permanently removed.
        </p>
    </header>

    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="bg-red-600 text-white border-[4px] border-black px-8 py-3 font-black uppercase shadow-[5px_5px_0px_#000] hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all"
    >
        Delete Account
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-8 bg-[#fff5f5] border-[5px] border-black">
            @csrf
            @method('delete')

            <h2 class="text-3xl font-black uppercase text-black">
                Are You Absolutely Sure?
            </h2>

            <p class="mt-4 text-black font-bold">
                This action cannot be undone. Enter your password to confirm account deletion.
            </p>

            <div class="mt-6">
                <input
                    id="password"
                    name="password"
                    type="password"
                    placeholder="Enter Password"
                    class="w-full border-[4px] border-black bg-white px-5 py-4 text-lg font-bold"
                >

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 font-bold" />
            </div>

            <div class="mt-8 flex justify-end gap-4">
                <button
                    type="button"
                    x-on:click="$dispatch('close')"
                    class="bg-white border-[4px] border-black px-6 py-3 font-black uppercase"
                >
                    Cancel
                </button>

                <button
                    type="submit"
                    class="bg-red-600 text-white border-[4px] border-black px-6 py-3 font-black uppercase shadow-[5px_5px_0px_#000]"
                >
                    Permanently Delete
                </button>
            </div>
        </form>
    </x-modal>
</section>