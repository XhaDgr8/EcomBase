<template>
    <div class="min-h-screen">
        <nav-bar />
        <!-- Page Heading
            <header class="bg-glass py-3 shadow" v-if="$slots.header">
                <h2 class="container"><slot name="header" /></h2>
            </header>
        -->
        <!-- Page Content -->
        <main class="container my-8">
            <slot />
        </main>
    </div>
</template>

<script>
import BreezeApplicationLogo from '@/Components/ApplicationLogo.vue'
import BreezeDropdown from '@/Components/Dropdown.vue'
import BreezeDropdownLink from '@/Components/DropdownLink.vue'
import BreezeNavLink from '@/Components/NavLink.vue'
import BreezeResponsiveNavLink from '@/Components/ResponsiveNavLink.vue'
import { Link } from '@inertiajs/inertia-vue3';
import NavBar from "@/Components/LayoutIncrements/NavBar";

export default {
    components: {
        NavBar,
    },
}
</script>
