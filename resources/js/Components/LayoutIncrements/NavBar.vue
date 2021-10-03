<template>
    <nav id="nav-bar-primary" class="relative z-50">
        <!-- Primary Navigation Menu -->
        <div class="container flex-between h-12">
            <div class="flex">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <Link :href="route('dashboard')">
                        <BreezeApplicationLogo class="block h-9 w-auto" />
                    </Link>
                </div>

                <!-- Navigation Links -->
                <div class="nav-list">
                    <Link :href="route('dashboard')" class="nav-link"
                          :class="[route().current('dashboard') ? 'nav-primary' : 'nav-link-active']">
                        <p>Dashboard</p>
                    </Link>
                    <Link :href="route('Product.index')" class="nav-link"
                          :class="[route().current('Product.index') ? 'nav-primary' : 'nav-link-active']">
                        <p>Product</p>
                    </Link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="ml-3 relative hidden sm:flex sm:items-center sm:ml-6">
                <BreezeDropdown align="right" width="48">
                    <template #trigger>
                        <span class="inline-flex rounded-md">
                            <button type="button" class="inline-flex items-center btn btn-primary">
                                {{ $page.props.auth.user.name }}

                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </span>
                    </template>

                    <template #content>
                        <Link :href="route('logout')" method="post" as="button" class="drop-down-link rounded-md">
                            <h2>Log Out</h2>
                        </Link>
                    </template>
                </BreezeDropdown>
            </div>

            <!-- Hamburger -->
            <div class="relative z-50 -mr-2 flex items-center sm:hidden">
                <BreezeDropdown align="right" width="48">
                    <template #content>
                        <Link :href="route('dashboard')" class="nav-link block py-2"
                              :class="[route().current('dashboard') ? 'nav-primary' : 'nav-link-active']">
                            <p>Dashboard</p>
                        </Link>

                        <Link :href="route('Product.index')" class="nav-link block py-2"
                              :class="[route().current('Product.index') ? 'nav-primary' : 'nav-link-active']">
                            <p>Product</p>
                        </Link>
                        <!-- Responsive Settings Options -->
                        <div class="pt-2 pb-0 border-t border-gray-200 text-center">
                            <h1>{{ $page.props.auth.user.name }}</h1>
                            <Link :href="route('logout')" method="post" as="button" class="drop-down-link">
                                Log Out
                            </Link>
                        </div>

                    </template>
                </BreezeDropdown>
            </div>
        </div>
    </nav>
</template>

<script>
import BreezeApplicationLogo from '@/Components/ApplicationLogo.vue'
import BreezeDropdown from '@/Components/Dropdown.vue'
import { Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
        BreezeApplicationLogo,
        BreezeDropdown,
        Link,
    },
}
</script>
