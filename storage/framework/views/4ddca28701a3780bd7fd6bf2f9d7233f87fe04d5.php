<div
    x-transition:enter="transition"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    x-show="isSidebarOpen"
    x-on:click="isSidebarOpen = false"
    class="fixed inset-0 z-20 bg-black/50 lg:hidden"
 ></div>
<?php /**PATH /Applications/MAMP/htdocs/prix-catel-online/resources/views/components/sidebar/overlay.blade.php ENDPATH**/ ?>