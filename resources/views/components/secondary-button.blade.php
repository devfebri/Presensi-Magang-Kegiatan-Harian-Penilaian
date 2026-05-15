<button
    {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 bg-white border border-gov-primary rounded-lg font-semibold text-xs text-gov-primary uppercase tracking-widest shadow-md hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-gov-primary focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150 hover:shadow-lg']) }}>
    {{ $slot }}
</button>
