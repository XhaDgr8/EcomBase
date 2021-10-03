<template>
    <Head title="Products"/>

    <BreezeAuthenticatedLayout>
        <template #header>
            Product
        </template>
        <div class="flex-between">
            <h1 class="mt-2 text-white">All Products</h1>
            <Link :href="route('Product.create')" class="btn btn-primary">
                Create New Product
            </Link>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import {Head} from '@inertiajs/inertia-vue3';
import { Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
        BreezeAuthenticatedLayout,
        Head, Link
    },
}
</script>
