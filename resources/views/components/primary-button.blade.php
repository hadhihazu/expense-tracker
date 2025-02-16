<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-customBlue dark:bg-customBlue border border-transparent rounded-md font-semibold text-xs text-customDarkBlue dark:text-zinc-200 uppercase tracking-widest hover:bg-zinc-700 dark:hover:bg-customDarkBlue focus:bg-zinc-700 dark:focus:bg-customDarkBlue active:bg-zinc-900 dark:active:bg-zinc-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-zinc-200 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
