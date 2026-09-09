<div class="group relative inline-block" data-tooltip-wrapper>
    {{ $slot }}

    <!-- Tooltip Box -->
    <div data-tooltip
        class="pointer-events-none fixed z-[99] whitespace-nowrap rounded px-3 py-1.5 text-xs font-medium opacity-0 transition-opacity group-hover:opacity-100
        -translate-x-1/2 -translate-y-full {{ str_replace(' ', '-', $bg_color) }} {{ $text_color }}">
        {{ $text }}
        <!-- Tooltip Arrow -->
        <div class="absolute top-full left-1/2 -mt-1 h-2 w-2 -translate-x-1/2 rotate-45 bg-brand-navy"></div>
    </div>
</div>

@once
    @push('scripts')
        <script>
            (() => {
                const positionTooltip = (wrapper) => {
                    const trigger = wrapper.querySelector('button, a, [role="button"]');
                    const tooltip = wrapper.querySelector('[data-tooltip]');

                    if (!trigger || !tooltip) return;

                    const bounds = trigger.getBoundingClientRect();
                    tooltip.style.left = `${bounds.left + (bounds.width / 2)}px`;
                    tooltip.style.top = `${bounds.top - 12}px`;
                };

                document.querySelectorAll('[data-tooltip-wrapper]').forEach((wrapper) => {
                    wrapper.addEventListener('mouseenter', () => positionTooltip(wrapper));
                    wrapper.addEventListener('mousemove', () => positionTooltip(wrapper));
                    window.addEventListener('scroll', () => positionTooltip(wrapper), true);
                    window.addEventListener('resize', () => positionTooltip(wrapper));
                });
            })();
        </script>
    @endpush
@endonce
