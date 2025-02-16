@props(['disabled' => false])

<select {{ $disabled ? 'disabled' : '' }} {{ $attributes->merge([
    'class' => 'border-zinc-300 dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-300
                focus:border-customBlue dark:focus:border-customBlue
                focus:ring-customBlue dark:focus:ring-customBlue
                rounded-md shadow-sm'
]) }}>
    {{ $slot }}
</select>
